@extends('layouts.base-in-project')
@section('content')
    <div class="container-menu-body">
        @include('layouts.partials.sidebar')
        <div class="right-container">
            <div class="text-center mb-2">
                <h1 class="title">Profile</h1>
            </div>
            <div class="profile-container">
                <form action="" class="form-profile">
                    <label for="fileInput" class="image-profile">
                        <input type="file" accept="image/*" id="fileInput" style="display: none;" />
                        <img id="profileImage" src="{{ asset('img/profile-default.jpg') }}" alt="Perfil" />
                        <span class="material-icons camera">
                            photo_camera
                        </span>
                    </label>
                    <div class="input-group-profile">
                        <input type="text" placeholder="Name" name="name" class="input-project">
                        <input type="text" placeholder="Lastname" name="lastName" class="input-project">
                        <input type="date" placeholder="Birthdate" name="birthdate" class="custom-date-input">
                        <input type="text" placeholder="Username" name="username" class="input-project">
                        <input type="password" placeholder="Password" name="password" class="input-project">
                        <input type="password" placeholder="Confirm Password" name="confirmPassword"
                            class="input-project">
                    </div>
                    <button> Accept </button>
                </form>
            </div>
        </div>
    </div>
     <script src="{{ asset('js/src/profile.js') }}"></script>
@endsection