<link rel="stylesheet" href="/css/myaccount.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="errorPw" type="hidden" value="<?= $content['errorPw'] ?>">
<input id="errorPwNewAndOldMustDiffer" type="hidden" value="<?= $content['errorPwNewAndOldMustDiffer'] ?>">
<input id="errorPwEntriesMustMatch" type="hidden" value="<?= $content['errorPwEntriesMustMatch'] ?>">
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $fname . ' ' . $lname ?><?= $content['h1Text'] ?></h1>
    </div>
    <?php if (!$loggedIn) : ?>
    <div class="row">
        <div class="alert alert-secondary" role="alert">
            <?= $content['loginToProceed'] ?>
        </div><!-- /alert -->
    </div><!-- /row -->
    <?php endif; ?>
</div>

<?php if ($loggedIn) : ?>

<?php if (isset($changePassword)) : ?>

<form id="passwordResetForm" method="post" action="" class="needs-validation container fill-height" autocomplete="off" novalidate>
    <!-- <input name="changePasswordSubmitted" type="hidden" value="true"></div> -->
    <label for="oldpassword"><?= $content['enterOldPw'] ?></label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['pwRuleScreenReaderTxt'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $content['pwRules'] ?>">
    <span class="sr-only"><?= $content['pwRuleScreenReaderTxt'] ?></span>
    <input id="oldpassword" name="oldpassword" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="oldpasswordInputError"></span></div>
    <label for="newpassword1"><?= $content['enterNewPw'] ?></label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['passwordReqsAltTxt'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $content['pwRules'] ?>">
    <span class="sr-only"><?= $content['pwRuleScreenReaderTxt'] ?></span>
    <input id="newpassword1" name="newpassword1" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="newpassword1InputError"></span></div>
    <label for="newpassword2"><?= $content['enterNewPwAgain'] ?></label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['passwordReqsAltTxt'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $content['pwRules'] ?>">
    <span class="sr-only"><?= $content['pwRuleScreenReaderTxt'] ?></span>
    <input id="newpassword2" name="newpassword2" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="newpassword2InputError"></span></div>
    <input id="submitPasswordChange" name="submitPasswordChange" type="submit" class="btn btn-primary" value="<?= $content['submit'] ?>" disabled>

    <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <p><?= $content['accountCreationError'] ?></p>
        <ul>
            <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
</form>
<hr>
<?php endif; ?>

<?php if ($displayMainMenu == true) : ?>
<form method="post" action="" class="container fill-height">
    <div class="row">
        <div class="col-3"><?= $content['nameLabel'] ?></div>
        <div class="col"><?= $fname . ' ' . $lname ?></div>
    </div><!-- /row -->
    <div class="row">
        <div class="col-3"><?= $content['emailLabel'] ?></div>
        <div class="col"><?= $email ?></div>
    </div><!-- /row -->
    <div class="row">
        <div class="col-3"><?= $content['pwLabel'] ?></div>
        <div class="col">********* </div>
    </div><!-- /row -->
    <div class="row">
        <div class="col"><input name="changepassword" type="submit" value="<?= $content['changePw'] ?>" class="btn btn-link pl-0">
        </div>
    </div><!-- /row -->
    <hr>
</form> <!-- /container -->
<?php endif; ?>

<?php endif; ?>

<script type="text/javascript" src="/js/myAcccount.js"></script>