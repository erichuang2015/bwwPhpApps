<link rel="stylesheet" href="/css/signin.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="errorEmail" type="hidden" value="<?= $content['errorEmail'] ?>">
<input id="errorPassword" type="hidden" value="<?= $content['errorPassword'] ?>">
<?php if (isset($error)) : ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2>
            <?= $error; ?>
        </h2>
    </div>
</div>
<?php endif; ?>
<div class="login container mt-0">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form method="post" action="" id="loginForm" class="form-signin needs-validation p-0" novalidate>
                <img class="mb-2 logo" src="/css/images/brand-logo-template.svg" alt="<?= $content['logoAltTxt'] ?>">
                <h1 class="h3 mb-2 font-weight-normal text"><?= $content['h1Text'] ?></h1>
                <div class="form-check">
                    <label for="email" class="sr-only form-check-label"><?= $content['email'] ?></label>
                    <input type="email" id="email" name="email" class="form-control text form-check-input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="<?= $content['email'] ?>" required autofocus>
                    <div class="invalid-feedback"><span id="emailInputError"></span></div>
                </div>
                <div class="form-check">
                    <label for="password" class="sr-only form-check-label"><?= $content['password'] ?></label>
                    <input type="password" id="password" name="password" maxlength="24" class="form-control text form-check-input" placeholder="<?= $content['password'] ?>" required>
                    <div class="invalid-feedback"><span id="passwordInputError"></span></div>
                </div>
                <div class="checkbox mb-3 mt-2">
                    <label class="text">
                        <input name="rememberme" type="checkbox" value="remember-me"> <?= $content['rememberMe'] ?>
                    </label>
                </div>
                <input class="btn btn-lg btn-primary btn-block" type="submit" id="login" name="login" value="<?= $content['h1Text'] ?>" disabled>
                <span><?= $content['needRegister'] ?><a href="/user/register"> <?= $content['clickHere'] ?></a></span>
                <span class="forgot-pw"><?= $content['forgotPw'] ?><a href="/myaccount/passwordrecovery"> <?= $content['clickHere'] ?></a></span>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</div>
<script type="text/javascript" src="/js/login.js"></script>