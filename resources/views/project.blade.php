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

            <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h2>Project 1</h2>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dolorem at sunt magni
                            eligendi earum! Minus odio voluptatum fugit atque.</p>
                    </div>
                    <div class="icons-container">
                        <a href="/project" class="icon-link">
                            <span class="material-icons">
                                edit_note
                            </span>
                        </a>
                        <a href="/project" class="icon-link">
                            <span class="material-icons">
                                delete_forever
                            </span>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2>Project 2</h2>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dolorem at sunt magni
                            eligendi earum! Minus odio voluptatum fugit atque.</p>
                    </div>
                    <div class="icons-container">
                        <a href="/project" class="icon-link">
                            <span class="material-icons">
                                edit_note
                            </span>
                        </a>
                        <a href="/project" class="icon-link">
                            <span class="material-icons">
                                delete_forever
                            </span>
                        </a>
                    </div>
                </div>
                <div class="card empty">empty</div>
                <div></div>
                <div class="pagination">
                    <div class="arrow-left"></div>
                    <div class="circle">1</div>
                    <div class="circle">2</div>
                    <div class="circle">3</div>
                    <div class="arrow-right"></div>
                </div>
                <div></div>
            </div>
        </div>
    </div>
@endsection