<link rel="stylesheet" href="/css/myaccount.css">



<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
        <div class="container">
          <h1 class="display-3"><?= $fname . ' ' . $lname ?>'s Account</h1>
        </div>
        <?php if (!$loggedIn) : ?>
        <div class="row">
          <div class="alert alert-secondary" role="alert">
            If you have registered with this site please login for the optimal experience <a href="/login">click here to log in</a>.  If you haven't registered please do so <a href="/author/register">Click here to register an account</a>
          </div><!-- /alert -->
        </div><!-- /row -->
        <?php endif; ?>
</div>

<?php if ($loggedIn) : ?>

<?php if (isset($changePassword)) : ?>
<form id="passwordResetForm" method="post" action="" class="container fill-height">
    <!-- <input name="changePasswordSubmitted" type="hidden" value="true"></div> -->
    <label for="oldpassword">Enter your old password:</label>
    <input id="oldpassword" name="oldpassword" type="password">
    <label for="newpassword1">Enter your new password:</label>
    <input id="newpassword1" name="newpassword1" type="password">
    <label for="newpassword2">Enter your new password again:</label>
    <input id="newpassword2" name="newpassword2" type="password">
    <input name="submitPasswordChange" type="submit" class="btn btn-primary">

    <?php if (!empty($errors)): ?>
	<div class="errors"><!--Need to replace this css errors class with bootstrap version -->
		<p>Your account could not be created, please check the following:</p>
		<ul>
		<?php foreach ($errors as $error): ?>
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
            <div class="col"><input name="changepassword" type="submit" value="Change your password" class="btn btn-link"></div>
          </div><!-- /row -->
        <hr>
</form> <!-- /container -->
<?php endif; ?>

<?php endif; ?>