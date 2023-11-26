<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $response = Http::post(getenv("API_TASKPRO_URL") . 'usuario/alta', $request->all());

        if ($response->successful()) {
            return redirect("/login")->with("creado", true);
        }
        $errors = $response->json();
        return back()->withInput()->withErrors($errors);
    }

    public function login(Request $request)
    {
        $tokenData = $this->getTokenData($request);

        $tokenResponse = $this->requestAccessToken($tokenData);
        if ($tokenResponse->successful()) {
            $accessToken = $tokenResponse->json()['access_token'];
            session(['access_token' => $accessToken]);
            $validationResponse = $this->validateAccessToken($accessToken);

            if ($validationResponse->successful()) {
                $validationResponseJson = $validationResponse->json();
                $userResponse = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                ])->get(getenv("API_TASKPRO_URL") . "usuario/" . $validationResponseJson['name']);
                if ($userResponse->successful()) {
                    $userArray = $userResponse->json()['user'];
                    foreach ($userArray as $key => $value) {
                        if (is_array($value)) {
                            $value = json_encode($value);
                        }
                        $cookies[] = cookie()->forever($key, $value);
                    }

                    return redirect('project')->withCookies($cookies);
                } else {
                    return redirect('/login')->with('error', 'The user could not be recovered.');
                }
            } else {
                return redirect('/login')->with('error', 'The access token is invalid.');
            }
        } else {
            return redirect('/login')->with('error', 'The username or password is not valid.');
        }
    }

    protected function getTokenData(Request $request)
    {
        return [
            'grant_type' => 'password',
            'client_id' => getenv("CLIENT_ID"),
            'client_secret' => getenv("CLIENT_SECRET"),
            'username' => $request->username,
            'password' => $request->password,
        ];
    }

    protected function requestAccessToken(array $tokenData)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post(getenv("API_TASKPRO_URL_BASE") . 'oauth/token', $tokenData);
    }

    protected function validateAccessToken($accessToken)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(getenv("API_TASKPRO_URL") . 'validate');
    }


    public function logout()
    {
        $accessToken = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(getenv("API_TASKPRO_URL") . 'logout');

        if ($response->successful()) {
            session()->forget('access_token');
            $cookies = request()->cookies;
            foreach ($cookies->keys() as $cookieName) {
                setcookie($cookieName, '', time() - 3600);
            }
            return redirect()->route('login');
        }
    }

    public function search($user)
    {
        $accessToken = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(getenv("API_TASKPRO_URL") . "search/" . $user);

        return response()->json($response->json());
    }

    public function SearchProjectUserByName($project, $user)
    {
        $accessToken = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(getenv('API_TASKPRO_URL') . 'search/' . $project . '/' . $user);
        return response()->json($response->json());
    }

    public function getUser(Request $request, $project = null)
    {
        $id = $request->cookie('id');
        $accessToken = session('access_token');
        $data = $this->getUserProfileData($accessToken, $id);

        $view = ($project === null) ? 'profile' : 'profile-in-project';
        return view($view, ['data' => $data]);
    }

    public function updateProfile(Request $request, $project = null)
    {
        $id = $request->cookie('id');
        $accessToken = session('access_token');
        $successMessage = 'Profile updated successfully';
        $errorMessage = 'Error updating profile';

        $imagePath = $this->handleProfilePictureUpload($request, $id);
        $requestData = $request->all();
        if ($imagePath) {
            $requestData['foto'] = $imagePath;
        }
        $response = $this->sendUpdateRequest($accessToken, $requestData);
        if ($response->successful()) {
            $data = $this->getUserProfileData($accessToken, $id);
            $this->refreshCookies($data);

            $route = ($project === null) ? 'getUser' : 'getUser';
            $params = ($project === null) ? [] : ['project' => $project];

            return redirect()->route($route, $params)->with(['success' => $successMessage, 'data' => $data]);
        } else {
            return back()->withInput()->withErrors(['mensaje' => $errorMessage]);
        }
    }

    private function sendUpdateRequest($accessToken, $requestData)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ];
        $response = Http::withHeaders($headers)->put(getenv('API_TASKPRO_URL') . 'usuario/editar', $requestData);
        return $response;
    }

    private function refreshCookies($data)
    {
        $cookies = [];
        foreach ($data['user'] as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
            }
            $cookies[] = cookie()->forever($key, $value);
        }
        if (isset($data['user']['foto'])) {
      
            $cookies[] = cookie()->forever('foto', $data['user']['foto']);
        }
        foreach ($cookies as $cookie) {
            cookie()->queue($cookie);
        }
    }

    private function getUserProfileData($accessToken, $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(getenv('API_TASKPRO_URL') . 'usuario/perfil/' . $id);

        return $response->json();
    }

    private function handleProfilePictureUpload(Request $request, $userId)
    {
        if (!$request->hasFile('foto')) {
            return;
        }
        $imageName = 'img-' . $userId . '.' . $request->foto->extension();
        $request->foto->move(public_path('img/perfil'), $imageName);
        return '/img/perfil/' . $imageName;
    }
}
