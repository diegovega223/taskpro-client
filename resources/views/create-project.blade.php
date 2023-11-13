@extends('layouts.base-out-project')
@section('content')
    <div class="text-center mb-2">
        <h1 class="title">New Project</h1>
    </div>
    <div class="container-new-project">
        <div class="container-create-project">
            <div class="column project-data">
                <h2>Title project</h2>
                <input type="text" class="input-project" placeholder="Title">
                <h2>Description project</h2>
                <textarea name="" class="input-project" placeholder="Description"></textarea>

                <h2>Estimated project time</h2>
                <div class="estimated-project">
                    <div>
                        <h3>Start</h3>
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
                            <h3>End</h3>
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
            <div class="column assigned-user-project-container">
                <div class="column">
                    <h2>Username</h2>
                    <input type="search" placeholder="User" class="input-project">
                    <h2>Role</h2>
                    <select id="rol" name="rol" class="input-project">
                        <option value="admin"> Admin </option>
                        <option value="member"> Member </option>
                        <option value="guest"> Guest </option>
                    </select>
                    <button> Assign</button>
                </div>
                <div class="column">
                    <h2>User Assign</h2>
                    <div class="assing-box">
                        <div class="assigned-user-project">
                            <div class="profile">
                                <img src="img/perfil-1.jpg">
                            </div>
                            <div class="letter-role">A</div>
                            <p>Ana Pérez</p>
                            <span class="material-icons">
                                disabled_by_default
                            </span>
                        </div>
                        <div class="assigned-user-project">
                            <div class="profile">
                                <img src="img/perfil-2.jpg">
                            </div>
                            <div class="letter-role">M</div>
                            <p>Carlos Rodríguez</p>
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
@endsection
