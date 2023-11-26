@extends('layouts.base-in-project')

@section('content')
    <div class="container-menu-body">

        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title">Task</h1>
            </div>
            <div class="container-task">
                <div class="task-details">
                    <h2>{{ $tarea['titulo'] }}</h2>
                    <div class="task-description">
                        <p>{{ $tarea['descripcion'] }}</p>
                    </div>

                    <p>Deadline: <span>{{ $tarea['fechaVenc'] }}</span></p>
                    <p>Priority: <span>{{ $tarea['prioridad'] }}</span></p>
                    <p>State:
                        <span>
                            @switch($tarea['estado'])
                                @case('por hacer')
                                    TO DO
                                @break

                                @case('haciendo')
                                    DOING
                                @break

                                @case('hecho')
                                    DONE
                                @break

                                @default
                                    {{ $tarea['estado'] }}
                            @endswitch
                        </span>
                    <p>Assigned to: <span>{{ $tarea['usuarios_proyectos'][0]['user']['name'] }}</span></p>
                    <div class="button-task-container">
                        <div class="button-task">
                            <button id="deleteButton"
                                data-delete-url="{{ route('deleteTask', ['project' => request()->segment(2), 'id' => $tarea['IDTarea']]) }}">Delete</button>
                            <button
                                onclick="window.location.href='{{ route('modifyTask', ['project' => request()->segment(2), 'id' => $tarea['IDTarea']]) }}'">Edit</button>
                        </div>
                    </div>
                </div>


                <div class="sub-tasks">
                    <div class="sub-task-header">
                        <h2>Subtasks completed: </h2>
                        <p><span id="completedPercentage">0%</span></p>
                    </div>
                    <div class="sub-task-body">
                        @foreach ($tarea['sub_tareas'] as $sub_tarea)
                            <div class="sub-task">
                                <input type="checkbox" id="subtask-{{ $sub_tarea['IDSubTarea'] }}"
                                    {{ $sub_tarea['finalizada'] ? 'checked' : '' }}
                                    onclick="updateSubTask({{ $sub_tarea['IDSubTarea'] }}, this.checked)">
                                <label for="subtask-{{ $sub_tarea['IDSubTarea'] }}">{{ $sub_tarea['contenido'] }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm deletion</h4>
            </div>
            <p class="modal-text">Are you sure you want to delete this task?</p>
            <div class="modal-buttons">
                <button id="cancelButton" class="modal-button">No</button>
                <a id="confirmDelete" class="modal-button" href="#">Yes</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/src/view-task.js') }}"></script>
@endsection
