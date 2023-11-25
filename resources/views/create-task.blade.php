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
                    <p id="error-message-title" class='inputError'></p>
                    <input type="text" class="input-project" placeholder="Title">
                    <h2>Description task</h2>
                    <p id="error-message-description" class='inputError'></p>
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
                <div class="container-task-date-content">
                    <div class="">
                        <h2>Deadline</h2>
                        <p id="error-message-deadline" class='inputError'></p>
                        <div class="align-items">
                            <input type="date" class="custom-date-input" id="Deadline">
                        </div>
                    </div>

                    <div class="">
                        <h2>Prioridad</h2>
                        <div class="align-items">
                            <select class="custom-select-input" id="Prioridad">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="8">8</option>
                                <option value="13">13</option>
                                <option value="21">21</option>
                                <option value="34">34</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="assigned-task">
                    <h2>User assignment</h2>
                    <p id="error-message-assignment" class='inputError'></p>
                    <input type="text" id="username" placeholder="Username" class="input-project">
                    <div id="search-results" class="search-results"></div>
                </div>
            </div>

            <div id="message" class="alert mesagge-success"></div>
            <div class="button-container">
                <button class="accept-button">Accept</button>
            </div>

        </div>
        <script src="{{ asset('js/src/create-task.js') }}"></script>
    @endsection
