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
}
