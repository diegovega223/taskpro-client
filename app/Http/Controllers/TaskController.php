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
            $this->assignTaskToUser($data['userId'], $tarea, $project, $accessToken);
            return response()->json(['success' => true, 'message' => 'Task created successfully!']);
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

        try {
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
        } catch (Exception $e) {
            Log::error('Excepción al crear nueva tarea: ', ['message' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
        $task = $response->json();
        return $task;
    }

    public function assignTaskToUser($userId, $task, $project, $accessToken)
    {

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post(getenv("API_TASKPRO_URL") . 'tarea/asignarUsuarioTarea', [
            'IDTarea' => $task['IDTarea'],
            'IDUsuario' => $userId,
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
            return view('backlog')->with([
                'tareas' => $tareas,
                'project' => $project,
            ]);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function getTask($project, $id)
    {
        $accessToken = session('access_token');
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get(getenv("API_TASKPRO_URL") . "tarea/detalles/{$id}");

            $tarea = $response->json();

            return view('view-task', ['tarea' => $tarea]);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateSubTask(Request $request, $id)
    {
        $accessToken = session('access_token');
        $data = $request->all();

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->put(getenv("API_TASKPRO_URL") . "tarea/subtarea/{$id}", $data);
            return $response->json();
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteTask($project, $id)
    {
        $accessToken = session('access_token');
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->delete(getenv("API_TASKPRO_URL") . "tarea/{$id}");
            return redirect()->route('backlog', ['project' => $project])->with('response', $response->json());
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getModifyTask($project, $id)
    {
        $accessToken = session('access_token');
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get(getenv("API_TASKPRO_URL") . "tarea/detalles/{$id}");
            $tarea = $response->json();
            return view('modify-task', ['tarea' => $tarea]);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function changeStateTask(Request $request, $project, $id)
    {
        $accessToken = session('access_token');
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->put(getenv("API_TASKPRO_URL") . "tarea/modificarEstado/{$id}", [
                'estado' => $request->input("estado"),
            ]);
            return redirect()->route('backlog', ['project' => $project])->with('response', $response->json());
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function getKanban(Request $request, $project)
    {
        $accessToken = session('access_token');
        $url = getenv("API_TASKPRO_URL") . "kanban-board/{$project}";
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get($url);
            $tareas = $response->json();
            if (!is_array($tareas)) {
                $tareas = [];
            }
            return view('kanban-board')->with([
                'tareas' => $tareas,
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching tasks', ['error' => $e->getMessage()]);
            return back()->with('error', $e->getMessage());
        }
    }
}
