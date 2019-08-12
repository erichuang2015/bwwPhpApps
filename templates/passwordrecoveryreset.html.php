<input id="language" type="hidden" value="<?= $language?>">
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

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>


<form id="resetLostPasswordForm" method="post" action="" class="needs-validation container fill-height" autocomplete="off" novalidate>
    <!-- <input name="changePasswordSubmitted" type="hidden" value="true"></div> -->
    <label for="newPassword"><?= $content['lblNewPw'] ?></label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['pwRequiremetnsAltTxt'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $content['pwRequirementsTxt'] ?>">
    <span class="sr-only"><?= $content['pwRequirementsSrTxt'] ?></span>
    <input id="newPassword" name="newpassword" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="newPasswordInputError"></span></div>
    <input id="submitNewPassword" name="submitnewpassword" type="submit" class="btn btn-primary mt-3" value="<?= $content['submitBtnTxt'] ?>" disabled>
</form>
<hr>

<script type="text/javascript" src="/js/Utils.js"></script>
<script type="text/javascript" src="/js/passwordrecovery.js"></script>