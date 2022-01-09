<div class="container login center">

    <form action="./?page=signin" method="POST" class="was-validated">
        <h1>Login</h1>
        <p class="text-muted"> Please enter your email and password!</p>
        <p>
            <input class="login-usrinput" type="text" name="mailU" placeholder="Email address" required>
        </p>
        <p>
            <input class="login-pswinput" type="password" name="mdpU" placeholder="Password" id="password" required>
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </p>
        <a class="login-forgot" href="#">Forgot password?</a>
        <input class="login-form-submit" type="submit" name="" href="#">
        <div class="col-md-12">
            <ul class="social-network social-circle">
                <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
            </ul>
        </div>
    </form>
</div>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('bi-eye');
    });
</script>