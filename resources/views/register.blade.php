@extends("welcome")

@section("title","Register")

@section("content")

    <div class="container ml-auto">
        <h3 class="text-center fs-1 fw-bold text-warning">Register</h3>
        <form  method="post">
            @csrf
            <input type="email" placeholder="Email" aria-label="Email" name="email" id="email"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errEmail"></div>

            <input type="text" placeholder="Name" aria-label="Name" name="name" id="name"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errName"></div>

            <input type="text" placeholder="Contact" aria-label="Contact" name="contact" id="contact"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errContact"></div>

            <input type="password" placeholder="Password" aria-label="Password" name="password" id="password"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errPassword"></div>

            <input type="password" placeholder="Confirm Password" aria-label="Confirm Password" name="confirmPassword" id="confirmPassword"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errConfirmPassword"></div>

            <button type="button" name="btnRegister" id="btnRegister" class="btn btn-warning btn-lg btn-block mt-2">Register</button>

            <div class="text-center p-3">
                <a href="/login" class="text-secondary ml-auto links">Already register?</a>
            </div>
        </form>
    </div>

@endsection
