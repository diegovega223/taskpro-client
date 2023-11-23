<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class TaskController extends Controller
{
    public function createTask(Request $request, $project)
    {
        try {
            $data = $request->all();
            $accessToken = session('access_token');

            $tarea = $this->newTask($data, $accessToken);
            $this->assignTaskToUser($request, $tarea, $project, $accessToken);
            return redirect("/create-task/{$project}")->with('message', 'tarea creada con exito');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function newTask($data, $accessToken)
    {
        $subTareas = [];

        if (isset($data['subTareas']) && is_array($data['subTareas'])) {
            $subTareas = array_map(function ($subTarea) {
                return [
                    'contenido' => $subTarea,
                    'finalizada' => false,
                ];
            }, $data['subTareas']);
        }

        $subTareas = array_map(function ($subTarea) {
            return [
                'contenido' => $subTarea,
                'finalizada' => false,
            ];
        }, $data['subTareas']);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(getenv("API_TASKPRO_URL") . 'tarea', [
            'titulo' => $data['title'],
            'descripcion' => $data['description'],
            'fechaVenc' => $data['fechaVenc'],
            'prioridad' => $data['prioridad'],
            'estado' => $data['estado'],
            'subTareas' => $subTareas,
        ]);

        return $response->json();
    }

    public function assignTaskToUser(Request $request, $tarea, $project, $accessToken)
    {
        $id = $request->cookie('id');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(getenv("API_TASKPRO_URL") . 'tarea/asignarUsuarioTarea', [
            'IDTarea' => $tarea['IDTarea'],
            'IDUsuario' => $id,
            'IDProyecto' => $project,
        ]);

        return $response;
    }

    public function showBacklog($project, Request $request)
    {
        $accessToken = session('access_token');
        $id = $request->cookie('id');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get(getenv("API_TASKPRO_URL") . "tarea/listarTareasDeProyecto/{$project}/{$id}");

            $tareas = $response->json();
            if (!is_array($tareas)) {
                $tareas = [];
            }
            Log::info('Response from API', ['response' => $response->json()]);

            return view('backlog')->with([
                'tareas' => $tareas,
                'project' => $project,
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching tasks', ['error' => $e->getMessage()]);

            return back()->with('error', $e->getMessage());
        }
    }

    public function listTasksByTitle($project, Request $request)
    {
        $accessToken = session('access_token');
        $id = $request->cookie('id');
        $title = $request->input('titulo');
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->post(getenv("API_TASKPRO_URL") . "tarea/listarTareasPorTitulo/{$project}", [
                'IDProyecto' => $project,
                'IDUsuario' => $id,
                'titulo' => $title,
            ]);

            $tareas = $response->json();
            if (!is_array($tareas)) {
                $tareas = [];
            }
            Log::info('Response from API', ['response' => $response->json()]);

            return view('backlog')->with([
                'tareas' => $tareas,
                'project' => $project,
            ]);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
