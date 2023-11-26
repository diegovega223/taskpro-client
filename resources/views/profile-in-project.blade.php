@extends('layouts.base-in-project')
@section('content')
    <div class="container-menu-body">
        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title">Profile</h1>
            </div>
            <div class="profile-container">
                <form action="/profile/{{ request()->route('project') }}" method="post" class="form-profile"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="number" style="display: none;" value={{ $data['user']['id'] }} name='id' />
                    <label for="fileInput" class="image-profile">

                        <input type="file" accept="image/*" id="fileInput" style="display: none;" name="foto"/>
                        <img id="profileImage"
                            src="{{ $data['user']['perfil']['foto'] ?? asset('img/profile-default.jpg') }}"
                            alt="Perfil" />
                        <span class="material-icons camera">
                            photo_camera
                        </span>
                    </label>
                    <div class="input-group-profile">
                        <div class="input-container">
                            <label>Name</label>
                            <input type="text" placeholder="Name" name="name" class="input-project"
                                value="{{ $data['user']['perfil']['nombre'] }}" required>
                        </div>
                        <div class="input-container">
                            <label>Lastname</label>
                            <input type="text" placeholder="Lastname" name="lastName" class="input-project"
                                value="{{ $data['user']['perfil']['apellido'] }}" required>
                        </div>
                        <div class="input-container">
                            <label>Username</label>
                            <input type="text" placeholder="Username" name="username" class="input-project"
                                value="{{ $data['user']['name'] }}" required>
                        </div>
                        <div class="input-container">
                            <label>Email</label>
                            <input type="text" placeholder="Email" name="email" class="input-project"
                                value="{{ $data['user']['email'] }}" required>
                        </div>
                        <div class="input-container">
                            <label>Birthdate</label>
                            <input type="date" placeholder="Birthdate" name="birthdate" class="custom-date-input"
                                value="{{ $data['user']['perfil']['fecha_nac'] }}" required>
                        </div>
                    </div>
                    <div class="alert mesagge-success">
                        @if (session('success'))
                            {{ session('success') }}
                        @endif
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit"> Accept </button>
                </form>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/src/profile.js') }}"></script>
@endsection
