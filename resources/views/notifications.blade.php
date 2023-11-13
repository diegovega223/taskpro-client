@extends('layouts.base-in-project')
@section('content')
    <div class="container-menu-body">
        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title">Notifications</h1>
            </div>
            <div class="notifications-list">
                <ul>
                    <li>
                        <div class="user-info">
                            <div class="profile">
                                <i class="material-icons">notifications</i>
                            </div>
                        </div>
                        <span>¡Nueva Tarea Asignada! A ti se te ha asignado la tarea 'Desarrollo de la Función de
                            Exportación'. Fecha límite: 15 de noviembre.</span>
                        <a href=""> <button class="close-button" title="Editar">
                                <i class="material-icons">close</i>
                            </button></a>
                    </li>
                    <li>
                        <div class="user-info">
                            <div class="profile">
                                <i class="material-icons">notifications</i>
                            </div>
                        </div>
                        <span>La tarea 'Revisión de Diseño de Interfaz' ha sido actualizada por el equipo. Por favor,
                            revísala y proporciona tus comentarios.</span>
                        <a href=""> <button class="close-button" title="Editar">
                                <i class="material-icons">close</i>
                            </button></a>
                    </li>
                    <li>
                        <div class="user-info">
                            <div class="profile">
                                <i class="material-icons">notifications</i>
                            </div>
                        </div>
                        <span>Recordatorio de Reunión: Reunión de Planificación Semanal a las 10:00 AM. Por favor,
                            prepárate y únete a la videollamada.</span>
                        <a href=""> <button class="close-button" title="Editar">
                                <i class="material-icons">close</i>
                            </button></a>
                    </li>
                    <li>
                        <div class="user-info">
                            <div class="profile">
                                <i class="material-icons">notifications</i>
                            </div>
                        </div>
                        <span>¡Buena noticia! La tarea 'Pruebas de Funcionalidad' ha sido completada con éxito. Puedes
                            verificarla en la columna 'Hecho'</span>
                        <a href=""> <button class="close-button" title="Editar">
                                <i class="material-icons">close</i>
                            </button></a>
                    </li>
                    <li>
                        <div class="user-info">
                            <div class="profile">
                                <i class="material-icons">notifications</i>
                            </div>
                        </div>
                        <span>Has recibido un nuevo comentario en la tarea 'Desarrollo del Módulo de Autenticación'.
                            Accede a la tarea para ver el comentario.</span>
                        <a href=""> <button class="close-button" title="Editar">
                                <i class="material-icons">close</i>
                            </button></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection