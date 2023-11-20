@extends('layouts.base-login-register')
@section('content')
    <div class="container">
        <div class="register">
            <h1 class="text-login">Register</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" placeholder="Name" name="nombre" class="input-2-col" required>
                    <input type="text" placeholder="Lastname" name="apellido" class="input-2-col" required>
                    <input type="text" placeholder="Username" name="user" class="input-2-col" required>
                    <input type="email" placeholder="Email" name="email" class="input-2-col" required>
                    <input type="password" placeholder="Password" name="password" class="input-2-col" required>
                    <input type="password" placeholder="Confirm Password" name="password_confirmation" class="input-2-col"
                        required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <hr class="separador"><br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <a href="/login" class="text-center text-color">Already Have An Account?</a>
        </div>
    </div>
@endsection
