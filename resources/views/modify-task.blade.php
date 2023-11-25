@extends('layouts.base-in-project')
@section('content')
    <div class="container-menu-body">
        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title title-kanban">Modify task</h1>
            </div>
            <div class="container-create-task">
                <div class="task-info-content">
                    <h2>Title task</h2>
                    <input type="text" class="input-project" placeholder="Title" value="{{ $tarea['titulo'] }}">
                    <h2>Description task</h2>
                    <textarea name="Description-task" class="input-project" placeholder="Description">{{ $tarea['descripcion'] }}</textarea>
                </div>
                <div class="subtask-content">
                    <h2>
                        Sub task
                    </h2>
                    <div class="add-task-container">
                        <input type="text" name="subtask-title" class="input-project" placeholder="Subtask">
                        <button type="button" class="add-task-button">
                            <span class="material-icons">
                                add_task
                            </span>
                        </button>
                    </div>
                    <h2>
                        List subtask
                    </h2>
                    <div class="subtask-box" id="subtask-container">
                        <ol>
                            @foreach ($tarea['sub_tareas'] as $sub_tarea)
                                <li class="subtask">
                                    <span>{{ $sub_tarea['contenido'] }}</span>
                                    <span class="material-icons">highlight_off</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="container-task-date-content">
                    <div class="">
                        <h2>Deadline</h2>
                        <div class="align-items">
                            <input type="date" class="custom-date-input" id="Deadline"
                                value="{{ $tarea['fechaVenc'] }}">
                        </div>
                    </div>

                    <div class="">
                        <h2>Prioridad</h2>
                        <div class="align-items">
                            <select class="custom-select-input" id="Prioridad">
                                <option value="1" {{ $tarea['prioridad'] == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $tarea['prioridad'] == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $tarea['prioridad'] == 3 ? 'selected' : '' }}>3</option>
                                <option value="5" {{ $tarea['prioridad'] == 5 ? 'selected' : '' }}>5</option>
                                <option value="8" {{ $tarea['prioridad'] == 8 ? 'selected' : '' }}>8</option>
                                <option value="13" {{ $tarea['prioridad'] == 13 ? 'selected' : '' }}>13</option>
                                <option value="21" {{ $tarea['prioridad'] == 21 ? 'selected' : '' }}>21</option>
                                <option value="34" {{ $tarea['prioridad'] == 34 ? 'selected' : '' }}>34</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="assigned-task">
                    <h2>User assignment</h2>
                    <input type="text" id="username" placeholder="Username" class="input-project" value="">
                    <div id="search-results" class="search-results"></div>
                </div>
            </div>


            <div class="button-container">
                <button class="accept-button">Accept</button>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <script src="{{ asset('js/src/subtask.js') }}"></script>
    @endsection
