@extends('layouts.base-in-project')

@section('content')
    <div class="container-menu-body">
        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title">Backlog</h1>
            </div>
            <form method="POST" action="{{ route('backlog', ['project' => $project]) }}">
                @csrf
                <div class="container-search">
                    <input type="search" name="titulo" id="" placeholder="Search" class=".input">
                    <button type="submit">Search</button>
                </div>
            </form>
            <div class="container-backlog">
                <div class="backlog">
                    @foreach ($tareas as $tarea)
                        <a href="{{ route('getTask', ['project' => $project, 'id' => $tarea['IDTarea']]) }}"
                            class="container-backlog-task">
                            <div class="task-card" id="{{ $tarea['IDTarea'] }}">
                                <div class="task-content collapsed">
                                    <div class="header-task">
                                        {{ $tarea['titulo'] }}
                                    </div>
                                    <div class="user-task">
                                        @if (!empty($tarea['foto']))
                                            <p>{{ $tarea['name'] }}</p>
                                            <div class="profile">
                                                <img src="{{ $tarea['foto'] }}" alt="{{ $tarea['name'] }}"
                                                    class="profile-img">
                                            </div>
                                        @else
                                            <p>{{ $tarea['name'] }}</p>
                                            <div class="profile">
                                                {{ strtoupper(substr($tarea['name'], 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="deadline-container">
                                        <p class='' id="deadline-{{ $tarea['IDTarea'] }}">
                                            Deadline: {{ $tarea['fechaVenc'] }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/src/color-date-backlog.js') }}?v={{ time() }}"></script>
@endsection
