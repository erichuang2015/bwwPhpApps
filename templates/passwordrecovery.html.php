<link rel="stylesheet" href="/css/register.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="invalidEmailError" type="hidden" value="<?= $content['invalidEmailError'] ?>">
<input id="invalidPasswordError" type="hidden" value="<?= $content['invalidPasswordError'] ?>">
<?php if (!empty($errors)) : ?>
<div class="alert alert-danger" role="alert">
    <p><?= $content['serverErrorTxt'] ?></p>
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="container registration">
    <div class="py-5 text-center">
        <!-- <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h1><?= $content['h1Text'] ?></h1>
        <p class="lead"><?= $content['instructions'] ?></p>
    </div>

    <div class="col-md-12 order-md-1">
        <form method="post" action="" class="needs-validation" autocomplete="off" novalidate>

            <div class="mb-3">
                <label for="email"><?= $content['email'] ?></label>
                <input type="email" class="form-control" id="email" name="user[email]" placeholder="<?= $content['emailPlaceholder'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" autocomplete="off" required>
                <div class="invalid-feedback"><span id="emailInputError"></span></div>
            </div>

            <div class="col-md-4 pl-0">
                <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submitBtn" value="<?= $content['submitBtnTxt'] ?>" disabled>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/js/passwordrecovery.js"></script>