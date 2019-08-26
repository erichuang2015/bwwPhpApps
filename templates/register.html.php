<link rel="stylesheet" href="/css/register.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="errorFirstNameInput" type="hidden" value="<?= $content['errorFirstNameInput'] ?>">
<input id="errorLastNameInput" type="hidden" value="<?= $content['errorLastNameInput'] ?>">
<input id="errorEmailInput" type="hidden" value="<?= $content['errorEmailInput'] ?>">
<input id="errorPasswordInput" type="hidden" value="<?= $content['errorPasswordInput'] ?>">
<?php if (!empty($errors)) : ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <p>Your account could not be created, please check the following:</p>
        <ul>
            <?php foreach ($errors as $error) : ?>
            <li>
                <h2><?= $error ?></h2>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<div class="container registration">
    <div class="text-center">
        <img class="d-block mx-auto mb-4" src="/css/images/brand-logo-template.svg" alt="BWW Apps">
        <h1><?= $content['h1Text'] ?></h1>
        <p class="lead"><?= $content['registerInstructions'] ?></p>
    </div>

    <div class="row">
        <div class="col-md-12 order-md-1">
            <form method="post" action="" id="registerForm" class="needs-validation" autocomplete="off" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName"><?= $content['lblFirstName'] ?></label>
                        <input type="text" class="form-control" id="firstName" name="user[fname]" pattern="[A-Za-z]{1,45}" placeholder="" value="" autocomplete="off" required autofocus>
                        <div class="invalid-feedback"><span id="firstNameInputError"></span></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName"><?= $content['lblLastName'] ?></label>
                        <input type="text" class="form-control" id="lastName" name="user[lname]" pattern="[A-Za-z]{1,45}" placeholder="" value="" autocomplete="off" required>
                        <div class="invalid-feedback"><span id="lastNameInputError"></span></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email"><?= $content['lblEmail'] ?></label>
                    <input type="email" class="form-control" id="email" name="user[email]" placeholder="<?= $content['placeHolderEmail'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" autocomplete="off" required>
                    <div class="invalid-feedback"><span id="emailInputError"></span></div>
                </div>

                <div class="mb-3">
                    <label for="password"><?= $content['lblPassword'] ?></label>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['altTxtPassword'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $content['dataContentPassword'] ?>">
                    <span class="sr-only"><?= $content['altTxtPassword'] ?></span>
                    <input type="password" id="password" name="user[password]" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
                    <div class="invalid-feedback"><span id="passwordInputError"></span></div>
                </div>

                <div class="col-12 px-0">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" id="submitBtn" name="submit" value="<?= $content['submitBtn'] ?>" disabled>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/Utils.js"></script>
<script type="text/javascript" src="/js/register.js"></script>