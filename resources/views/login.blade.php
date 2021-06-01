@extends("welcome")

@section("title","Login")

@section("content")

    <div class="container ml-auto">
        <h3 class="text-center fs-1 fw-bold text-warning">Login</h3>
        <form method="post">
            @csrf
            <input type="email" placeholder="Email" aria-label="Email" name="email" id="email"
                   class="form-control p-2 mb-2">
            <div class="invalid-feedback" id="errEmail"></div>

            <input type="password" placeholder="Password" aria-label="Password" name="password" id="password"
                   class="form-control p-2 mb-2">
            <div class="invalid-feedback" id="errPassword"></div>

            <button type="button" name="btnLogin" id="btnLogin" class="btn btn-warning btn-lg btn-block">Login</button>

            <div class="text-center p-3">
                <a href="/register" class="text-secondary ml-auto links">Don't have an account?</a>
            </div>
        </form>
    </div>

@endsection
