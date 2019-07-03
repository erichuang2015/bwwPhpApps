<!-- <link rel="stylesheet" href="/css/myaccount.css"> -->
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <p>Your password could not be recovered. Please check the following:</p>
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
        <h1 class="display-3">Create your new password</h1>
    </div>
</div>


<form id="resetLostPasswordForm" method="post" action="" class="needs-validation container fill-height" autocomplete="off" novalidate>
    <!-- <input name="changePasswordSubmitted" type="hidden" value="true"></div> -->
    <label for="newPassword">Enter your new password:</label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about password requirements" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Passwords must be more than 7 and less than 25 characters in length.  They must contain at lease one number, one uppercase and one lowercase alphabetical character, and may contain special characters.">
    <span class="sr-only">Information about password requirements</span>
    <input id="newPassword" name="newpassword" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="newPasswordInputError"></span></div>
    <input id="submitNewPassword" name="submitnewpassword" type="submit" class="btn btn-primary mt-3" disabled>
</form>
<hr>

<script type="text/javascript" src="/js/Utils.js"></script>
<script type="text/javascript" src="/js/passwordrecovery.js"></script>