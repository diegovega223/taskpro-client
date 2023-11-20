@extends('layouts.base-login-register')
@section('content')
    <div class="container">
        <div class="">
            <div class="image">
                <h1 class="hello">HELLO!</h1>
                <p class="text-justify">Welcome to TaskPro Kanban Board! We're thrilled to have you onboard. With our
                    platform, you can
                    efficiently manage your projects, collaborate with your team, and track your tasks effortlessly.</p>
            </div>
        </div>
        <div class="">
            <form action="{{ route('login') }}" method="POST" class="form-login">
                @csrf
                <h2 class="text-login">Login</h2>
                <input type="text" id="username" name="username" placeholder="Username" required class="input-login">
                <input type="password" id="password" name="password" placeholder="Password" required class="input-login">
                <button type="submit">Login</button>
                <br>
                <hr class="separador"><br>
                <img src="{{ asset('img/google-login.png') }}" class="google-login" alt="google-login">
                <a href="/register" class="text-center text-color">Or Sing Up Using</a>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

            </form>
        </div>

    </div>
@endsection
