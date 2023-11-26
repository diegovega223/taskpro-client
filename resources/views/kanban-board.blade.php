@extends('layouts.base-in-project')
@section('content')
    <div class="container-menu-body">
        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title title-kanban">Kanban Board</h1>
            </div>

            <div class="container-kanban-board">
                <div class="header-kanban-board">
                    <div class="">To Do</div>
                    <div class="">Doing</div>
                    <div class="">Done</div>
                </div>
                <div class="kanban-board">
                    <div class="toDo" id="toDo">
                        @foreach ($tareas as $item)
                            @if ($item['tarea']['estado'] == 'por hacer')
                                <div class="task-card" id="{{ $item['tarea']['IDTarea'] }}">
                                    <div class="task-content collapsed">
                                        <div class="header-task">
                                            {{ $item['tarea']['titulo'] }}
                                        </div>
                                        <div class="body-task">
                                            <p id='{{ $item['tarea']['IDTarea'] }}' class="">
                                                {{ 'Deadline: ' . $item['tarea']['fechaVenc'] }}</p>
                                        </div>
                                        <div class="user-task">
                                            <p>{{ $item['user']['name'] }}</p>
                                            <div class="profile">
                                                @if ($item['user']['perfil']['foto'])
                                                    <img src="{{ $item['user']['perfil']['foto'] }}" alt="">
                                                @else
                                                    <div class="user-initial">
                                                        {{ substr($item['user']['name'], 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <select class="card-task input-project">
                                                <option value="toDo"
                                                    {{ $item['tarea']['estado'] == 'por hacer' ? 'selected' : '' }}>
                                                    To do
                                                </option>
                                                <option value="doing"
                                                    {{ $item['tarea']['estado'] == 'en curso' ? 'selected' : '' }}>
                                                    Doing
                                                </option>
                                                <option value="done"
                                                    {{ $item['tarea']['estado'] == 'listo' ? 'selected' : '' }}>Done
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="doing" id="doing">
                        @foreach ($tareas as $item)
                            @if ($item['tarea']['estado'] == 'en curso')
                                <div class="task-card" id="{{ $item['tarea']['IDTarea'] }}">
                                    <div class="task-content collapsed">
                                        <div class="header-task">
                                            {{ $item['tarea']['titulo'] }}
                                        </div>
                                        <div class="body-task">
                                            <p id='{{ $item['tarea']['IDTarea'] }}' class="">
                                                {{ 'Deadline: ' . $item['tarea']['fechaVenc'] }}</p>
                                        </div>
                                        <div class="user-task">
                                            <p>{{ $item['user']['name'] }}</p>
                                            <div class="profile">
                                                @if ($item['user']['perfil']['foto'])
                                                    <img src="{{ $item['user']['perfil']['foto'] }}" alt="">
                                                @else
                                                    <div class="user-initial">
                                                        {{ substr($item['user']['name'], 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <select class="card-task input-project">
                                                <option value="toDo"
                                                    {{ $item['tarea']['estado'] == 'por hacer' ? 'selected' : '' }}>
                                                    To do
                                                </option>
                                                <option value="doing"
                                                    {{ $item['tarea']['estado'] == 'en curso' ? 'selected' : '' }}>
                                                    Doing
                                                </option>
                                                <option value="done"
                                                    {{ $item['tarea']['estado'] == 'listo' ? 'selected' : '' }}>Done
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="done" id="done">
                        @foreach ($tareas as $item)
                            @if ($item['tarea']['estado'] == 'listo')
                                <div class="task-card" id="{{ $item['tarea']['IDTarea'] }}">
                                    <div class="task-content collapsed">
                                        <div class="header-task">
                                            {{ $item['tarea']['titulo'] }}
                                        </div>
                                        <div class="body-task">
                                            <p id="deadline" data-task-id="{{ $tarea['IDTarea'] }}">
                                                {{ 'Deadline: ' . $tarea['fechaVenc'] }}
                                            </p>
                                            <div class="user-task">
                                                <p>{{ $item['user']['name'] }}</p>
                                                <div class="profile">
                                                    @if ($item['user']['perfil']['foto'])
                                                        <img src="{{ $item['user']['perfil']['foto'] }}" alt="">
                                                    @else
                                                        <div class="user-initial">
                                                            {{ substr($item['user']['name'], 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <select class="card-task input-project">
                                                    <option value="toDo"
                                                        {{ $item['tarea']['estado'] == 'por hacer' ? 'selected' : '' }}>
                                                        To do
                                                    </option>
                                                    <option value="doing"
                                                        {{ $item['tarea']['estado'] == 'en curso' ? 'selected' : '' }}>
                                                        Doing
                                                    </option>
                                                    <option value="done"
                                                        {{ $item['tarea']['estado'] == 'listo' ? 'selected' : '' }}>Done
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/src/kanban-board.js') }}"></script>
    <script type="module" src="{{ asset('js/src/color-date-kanban.js') }}?v={{ time() }}"></script>
@endsection
