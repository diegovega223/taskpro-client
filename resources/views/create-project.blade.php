@extends('layouts.base-out-project')
@section('content')
    <div class="text-center mb-2">
        <h1 class="title">New Project</h1>
    </div>
    <div class="container-new-project">
        <div class="container-create-project">
            <div class="column project-data">
                <h2>Title project</h2>
                <input type="text" class="input-project" placeholder="Title" name="title">
                <h2>Description project</h2>
                <textarea class="input-project" placeholder="Description" name="description"></textarea>

                <h2>Estimated project time</h2>
                <div class="estimated-project">
                    <div>
                        <h3>Start</h3>
                        <div class="align-items">
                            <span class="material-icons">
                                calendar_today
                            </span>
                            <input type="date" class="custom-date-input" name="date-ini">
                        </div>
                        <div class="align-items">
                            <span class="material-icons">
                                watch_later
                            </span>
                            <input type="time" class="custom-date-input" name="time-ini">
                        </div>
                    </div>

                    <div>
                        <div>
                            <h3>End</h3>
                            <div class="align-items">
                                <span class="material-icons">
                                    calendar_today
                                </span>
                                <input type="date" class="custom-date-input" name="date-fin">
                            </div>
                            <div class="align-items">
                                <span class="material-icons">
                                    watch_later
                                </span>
                                <input type="time" class="custom-date-input" name="time-fin">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="column assigned-user-project-container">
                <div class="column">
                    <h2>Username</h2>
                    <p id="error-message" class='inputError'></p>
                    <input type="search" id="user-search" name="search-user" placeholder="User"
                        class="input-project input-project">
                    <div id="search-results" class="search-results"></div>
                    <h2>Role</h2>
                    <select id="rol" name="rol" class="input-project">
                        <option value="admin"> Admin </option>
                        <option value="member"> Member </option>
                        <option value="guest"> Guest </option>
                    </select>
                    <button id="assign-button"> Assign</button>
                </div>
                <div class="column">x
                    <h2>User Assign</h2>
                    <div class="assing-box">
                       
                       
                        <div class="assigned-user-project">
                        <div id="user-owner" style="display: none;">{{ request()->cookie('name') }}</div>
                            <div class="profile">
                                <p>{{ ucfirst(substr(request()->cookie('name'), 0, 1)) }}</p>
                            </div>
                            <div class="letter-role">O</div>
                            <p>{{ request()->cookie('name')}}</p>
                            <span class="material-icons">
                                disabled_by_default
                            </span>
                        </div>


                    </div>
                </div>
                <div class="column"></div>
                <div class="column create-button">
                    <a href="kanban-board.html"> <button>Create</button></a>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('js/src/create-project.js') }}"></script>
@endsection
