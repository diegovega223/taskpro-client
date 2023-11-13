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
                        <div class="task-card" id="1">
                            <div class="task-content collapsed">
                                <div class="header-task">
                                    Optimización de Algoritmos de Búsqueda en Redes Sociales
                                </div>
                                <div class="body-task">
                                    En esta tarea, los participantes deben mejorar algoritmos de búsqueda en redes
                                    sociales
                                    para aumentar la eficiencia y la relevancia de los resultados.
                                </div>
                                <div class="user-task">
                                    <p>Carlos Rodríguez</p>
                                    <div class="profile">
                                        <img src="img/perfil-2.jpg" alt="">
                                    </div>
                                </div>
                                <div>
                                    <select class="card-task input-project">
                                        <option value="toDo"> To do </option>
                                        <option value="doing"> Doing </option>
                                        <option value="done"> Done </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="task-card" id="2">
                            <div class="task-content collapsed">
                                <div class="header-task">
                                    Diseñar la interfaz de usuario para una aplicación web de comercio electrónico
                                </div>
                                <div class="body-task">
                                    Crear diseños de interfaz de usuario atractivos y funcionales para una tienda en
                                    línea.
                                    Esto incluye el diseño de páginas de inicio, páginas de productos y el proceso
                                    de
                                    pago.
                                </div>
                                <div class="user-task">
                                    <p>Ana Pérez</p>
                                    <div class="profile">
                                        <img src="img/perfil-1.jpg" alt="">
                                    </div>
                                </div>
                                <div>
                                    <select class="card-task input-project">
                                        <option value="toDo"> To do </option>
                                        <option value="doing"> Doing </option>
                                        <option value="done"> Done </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="task-card" id="3">
                            <div class="task-content collapsed">
                                <div class="header-task">
                                    Desarrollar una aplicación web de seguimiento de tareas
                                </div>
                                <div class="body-task">
                                    Crear una aplicación web que permita a los usuarios llevar un registro de sus
                                    tareas
                                    y
                                    proyectos. Debe incluir funciones como la creación de tareas, la asignación de
                                    fechas
                                    límite y la organización por categorías.

                                </div>
                                <div class="user-task">
                                    <p>Ana Pérez</p>
                                    <div class="profile">
                                        <img src="img/perfil-1.jpg" alt="">
                                    </div>
                                </div>
                                <div>
                                    <select class="card-task input-project">
                                        <option value="toDo"> To do </option>
                                        <option value="doing"> Doing </option>
                                        <option value="done"> Done </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="doing" id="doing"></div>
                    <div class="done" id="done"></div>
                </div>
            </div>
        </div>
    </div>
@endsection