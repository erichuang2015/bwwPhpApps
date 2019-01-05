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
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <form method="post" action="" class="form-signin">
                <img class="mb-4" src="css/images/brand-logo-template.jpg" alt="BWW Apps" width="300" height="153">
                <h1 class="h3 mb-3 font-weight-normal text">Please sign in</h1>
                <label for="email" class="sr-only">Email address</label>
                <input type="email" id="email" name="email" class="form-control text" placeholder="Email address"
                    required autofocus>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control text" placeholder="Password"
                    required>
                <div class="checkbox mb-3">
                    <label class="text">
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Sign in">
                <span>Need to register?</span><a href="/author/register">click here</a>
                <br />
                <span>Forgot your password?</span><a href="/myaccount/passwordrecovery">click here</a>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>