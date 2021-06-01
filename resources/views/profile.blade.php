@extends("welcome")

@section("title","Profile")

@section("content")

    <div class="container ml-auto">
        <h3 class="text-center fs-1 fw-bold text-warning">Update Profile</h3>
        <form  method="post">
            @csrf
            <input type="hidden" id="id" name="id">
            <input type="email" placeholder="Email" aria-label="Email" name="email" id="email"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errEmail"></div>

            <input type="text" placeholder="Name" aria-label="Name" name="name" id="name"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errName"></div>

            <input type="text" placeholder="Contact" aria-label="Contact" name="contact" id="contact"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errContact"></div>

            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="btnToggle">
                <label class="custom-control-label" for="btnToggle">Do you want change password ?</label>
            </div>

            <input type="password" placeholder="Password" aria-label="Password" name="password" id="password"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errPassword"></div>

            <input type="password" placeholder="Confirm Password" aria-label="Confirm Password" name="confirmPassword" id="confirmPassword"
                   class="form-control p-2 mt-2" required>
            <div class="invalid-feedback" id="errConfirmPassword"></div>

            <button type="button" name="btnUpdateProfile" id="btnUpdateProfile" class="btn btn-warning btn-lg btn-block mt-2">Update Profile</button>

        </form>
    </div>

@endsection

@section("scriptLinks")
    <script> window.onload = getUserData();</script>
@endsection
