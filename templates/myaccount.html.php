<link rel="stylesheet" href="/css/myaccount.css">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $fname . ' ' . $lname ?>'s Account</h1>
    </div>
    <?php if (!$loggedIn) : ?>
    <div class="row">
        <div class="alert alert-secondary" role="alert">
            If you have registered with this site please login for the optimal experience <a href="/login">click here to
                log in</a>. If you haven't registered please do so <a href="/user/register">Click here to register an
                account</a>
        </div><!-- /alert -->
    </div><!-- /row -->
    <?php endif; ?>
</div>

<?php if ($loggedIn) : ?>

<?php if (isset($changePassword)) : ?>

<form id="passwordResetForm" method="post" action="" class="needs-validation container fill-height" autocomplete="off" novalidate>
    <!-- <input name="changePasswordSubmitted" type="hidden" value="true"></div> -->
    <label for="oldpassword">Enter your old password:</label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about password requirements" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Passwords must be more than 7 and less than 25 characters in length.  They must contain at lease one number, one uppercase and one lowercase alphabetical character, and may contain special characters.">
    <span class="sr-only">Information about password requirements</span>
    <input id="oldpassword" name="oldpassword" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="oldpasswordInputError"></span></div>
    <label for="newpassword1">Enter your new password:</label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about password requirement" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Passwords must be more than 7 and less than 25 characters in length.  They must contain at lease one number, one uppercase and one lowercase alphabetical character, and may contain special characters.">
    <span class="sr-only">Information about password requirements</span>
    <input id="newpassword1" name="newpassword1" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="newpassword1InputError"></span></div>
    <label for="newpassword2">Enter your new password again:</label>
    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about password requirement" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Passwords must be more than 7 and less than 25 characters in length.  They must contain at lease one number, one uppercase and one lowercase alphabetical character, and may contain special characters.">
    <span class="sr-only">Information about password requirement</span>
    <input id="newpassword2" name="newpassword2" type="password" class="form-control" pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off" required>
    <div class="invalid-feedback"><span id="newpassword2InputError"></span></div>
    <input id="submitPasswordChange" name="submitPasswordChange" type="submit" class="btn btn-primary" disabled>

    <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <p>Your account could not be created, please check the following:</p>
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
        <div class="col-3">Name: </div>
        <div class="col"><?= $fname . ' ' . $lname ?></div>
        <!-- <div class="col-4"><input name="changeusername" type="submit" value="Change your username"></div> -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-3">Email: </div>
        <div class="col"><?= $email ?></div>
        <!-- <div class="col-4"><input name="changeemail" type="submit" value="Change your email"></div> -->
    </div><!-- /row -->
    <div class="row">
        <div class="col-3">Password: </div>
        <div class="col">********* </div>
    </div><!-- /row -->
    <div class="row">
        <div class="col"><input name="changepassword" type="submit" value="Change your password" class="btn btn-link pl-0">
        </div>
    </div><!-- /row -->
    <hr>
</form> <!-- /container -->
<?php endif; ?>

<?php endif; ?>

<script type="text/javascript" src="/js/myAcccount.js"></script>