<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ProjectController extends Controller
{

    public function createProject(Request $request)
    {
        try {
            $data = $request->all();
            $accessToken = session('access_token');
            $proyecto = $this->newProject($data, $accessToken);
            $this->assignUsersTOProject($proyecto, $data, $accessToken);
            return redirect('/project');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function newProject($data, $accessToken)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(getenv("API_TASKPRO_URL") . 'proyecto', [
            'titulo' => $data['title'],
            'descripcion' => $data['description'],
            'fecha_ini' => $data['fechaIni'],
            'fecha_fin' => $data['fechaFin'],
        ]);

        return $response->json();
    }

    public function assignUsersTOProject($proyecto, $data, $accessToken)
    {
        $nombresDeUsuarios = array_column($data['userRoles'], 'username');
        $roles = array_column($data['userRoles'], 'role');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(getenv("API_TASKPRO_URL") . 'proyecto/asignarUsuario', [
            'IDProyecto' => $proyecto['IDProyecto'],
            'usernames' => $nombresDeUsuarios,
            'rol' => $roles,
            'fecha' => now()->format('Y-m-d H:i:s'),
        ]);

        return $response;
    }

    public function showUserProjects(Request $request)
    {
        $id = $request->cookie('id');
        $page = $request->query('page', 1);

        $accessToken = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(getenv("API_TASKPRO_URL") . "proyecto/listarproyectos/" . $id . "?page=" . $page);

        $proyectos = $response->json();
        return view('project', ['proyectos' => $proyectos]);
    }

    public function deleteProject(Request $request, $id)
    {
        $accessToken = session('access_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->delete(getenv("API_TASKPRO_URL") . "proyecto/" . $id);
        return  redirect()->route('project')->with('success', 'Project deleted successfully');
    }
}
