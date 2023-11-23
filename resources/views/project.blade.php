@extends('layouts.base-out-project')
@section('content')
    <div class="text-center mb-2">
        <h1 class="title">List Project</h1>
    </div>
    <div class="content-container">

        <div class="container-project">

            <div class="create-project">

                <div class="card">
                    <a href="/create-project">
                        <span class="material-icons">
                            create_new_folder
                        </span>
                        <h2>Create Project</h2>
                    </a>
                </div>
            </div>




            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm deletion</h4>
                    </div>
                    <p class="modal-text">Are you sure you want to delete this project?</p>
                    <div class="modal-buttons">
                        <button id="cancelButton" class="modal-button">No</button>
                        <a id="confirmDelete" class="modal-button" href="#">Yes</a>
                    </div>
                </div>
            </div>

            <div class="projects">
                @php
                    $maxCards = 3;
                    $proyectosData = $proyectos['data'] ?? [];
                @endphp

                @foreach ($proyectosData as $proyecto)
                    <div class="card">
                        <a href="/kanban-board/{{ $proyecto['proyecto']['IDProyecto'] ?? '' }}" class="card-link">
                            <div class="card-header">
                                <h2> {{ isset($proyecto['proyecto']['titulo']) ? $proyecto['proyecto']['titulo'] : '' }}
                                </h2>
                            </div>
                            <div class="card-body">
                                <p>{{ isset($proyecto['proyecto']['descripcion']) ? $proyecto['proyecto']['descripcion'] : '' }}
                                </p>
                            </div>

                            <div class="icons-container">
                                <a href="/project" class="icon-link" onclick="event.stopPropagation();">
                                    <span class="material-icons">
                                        edit_note
                                    </span>
                                </a>
                                <a href="#" class="icon-link delete-btn" data-toggle="modal"
                                    data-target="#deleteModal" data-id="{{ $proyecto['proyecto']['IDProyecto'] ?? '' }}"
                                    onclick="event.stopPropagation();">
                                    <span class="material-icons">
                                        delete_forever
                                    </span>
                                </a>
                            </div>
                        </a>
                    </div>

                    @php
                        $maxCards--;
                    @endphp
                @endforeach
                @while ($maxCards > 0)
                    <div class="card empty">empty</div>
                    @php
                        $maxCards--;
                    @endphp
                @endwhile
                <div></div>

                <div class="pagination">
                    @if (isset($proyectos['current_page']) && $proyectos['current_page'] > 1)
                        <a href="?page={{ $proyectos['current_page'] - 1 }}" class="arrow-left"></a>
                    @endif

                    @php
                        $start = isset($proyectos['current_page']) ? max($proyectos['current_page'] - 1, 1) : 1;
                        $end = isset($proyectos['last_page']) ? min($proyectos['current_page'] + 1, $proyectos['last_page']) : 1;
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <a href="?page={{ $i }}" class="circle">{{ $i }}</a>
                    @endfor

                    @if (isset($proyectos['current_page']) &&
                            isset($proyectos['last_page']) &&
                            $proyectos['current_page'] < $proyectos['last_page']
                    )
                        <a href="?page={{ $proyectos['current_page'] + 1 }}" class="arrow-right"></a>
                    @endif
                </div>
                <div></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/src/deleteModalProject.js') }}"></script>
@endsection
