@extends('layouts.base-in-project')
@section('content')
    <div class="container-menu-body">   
    @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title title-kanban">Create task</h1>
            </div>
            <div class="container-create-task">
                <div class="task-info-content">
                    <h2>Title task</h2>
                    <input type="text" class="input-project" placeholder="Title">
                    <h2>Description task</h2>
                    <textarea name="Description-task" class="input-project" placeholder="Description"></textarea>
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
                          
                   
                        </ol>
                    </div>
                </div>
                <div class="task-date-content">
                    <h2>Task time</h2>
                    <div class="estimated-project">
                        <div>
                            <h3>Deadline</h3>
                            <div class="align-items">
                                <span class="material-icons">
                                    calendar_today
                                </span>
                                <input type="date" class="custom-date-input">
                            </div>
                            <div class="align-items">
                                <span class="material-icons">
                                    watch_later
                                </span>
                                <input type="time" class="custom-date-input">
                            </div>
                        </div>

                        <div>
                            <div>
                                <h3>Reminder</h3>
                                <div class="align-items">
                                    <span class="material-icons">
                                        calendar_today
                                    </span>
                                    <input type="date" class="custom-date-input ">
                                </div>
                                <div class="align-items">
                                    <span class="material-icons">
                                        watch_later
                                    </span>
                                    <input type="time" class="custom-date-input">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="assigned-task">
                    <h2>User assignment</h2>
                    <div class="assigned-user-project">
                        <div class="profile">
                            <img src="img/perfil-1.jpg">
                        </div>
                        <p>Ana Pérez</p>
                        <span class="material-icons">
                            disabled_by_default
                        </span>
                    </div>
                    <input type="search" class="input-project" placeholder="Username">
                    <button>assigned</button>
                </div>
                
            </div>
            <div class="button-container">
                <button class="accept-button">Accept</button>
            </div>
        
        </div>
    </div>
@endsection