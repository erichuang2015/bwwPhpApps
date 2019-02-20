<link rel="stylesheet" href="/css/signin.css">
<?php if (isset($error)): ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2>
            <?=$error;?>
        </h2>
    </div>
</div>
<?php endif;?>
<div class="login container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form method="post" action="" id="loginForm" class="form-signin needs-validation" novalidate>
                <img class="mb-4" src="css/images/brand-logo-template.svg" alt="BWW Apps">
                <h1 class="h3 mb-3 font-weight-normal text">Please sign in</h1>
                <div class="form-check">
                    <label for="email" class="sr-only form-check-label">Email address</label>
                    <input type="email" id="email" name="email" class="form-control text form-check-input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        placeholder="Email address" required autofocus>
                    <div class="invalid-feedback"><span id="emailInputError"></span></div>
                </div>
                <div class="form-check">
                    <label for="password" class="sr-only form-check-label">Password</label>
                    <input type="password" id="password" name="password" maxlength="24" class="form-control text form-check-input" placeholder="Password" required>
                    <div class="invalid-feedback"><span id="passwordInputError"></span></div>
                </div>
                <div class="checkbox mb-3">
                    <label class="text">
                        <input name="rememberme" type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block" type="submit" id="login" name="login" value="Sign in"
                    disabled>
                <span>Need to register?<a href="/user/register"> click here</a></span>
                <span class="forgot-pw">Forgot your password?<a href="/myaccount/passwordrecovery"> click here</a></span>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</div>
<script type="text/javascript" src="/js/login.js"></script>