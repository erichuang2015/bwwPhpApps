<link rel="stylesheet" href="/css/myaccount.css">



<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
        <div class="container">
          <h1 class="display-3"><?= $username ?>'s Account</h1>
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
<form method="post" action="" class="container fill-height">
    <!-- <input name="changePasswordSubmitted" type="hidden" value="true"></div> -->
    <label for="oldpassword">Enter your old password:</label>
    <input id="oldpassword" name="oldpassword" type="password"><br/>
    <label for="newpassword1">Enter your new password:</label>
    <input id="newpassword1" name="newpassword1" type="password"><br/>
    <label for="newpassword2">Enter your new password a second time:</label>
    <input id="newpassword2" name="newpassword2" type="password"><br/>
    <input name="submitPasswordChange" type="submit">

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
<hr>
</form> 
<?php endif; ?>

<?php if ($displayMainMenu == true) : ?>
<form method="post" action="" class="container fill-height">
          <div class="row">
            <div class="col-4">Username: </div>
            <div class="col-4"><?= $username ?></div>
            <div class="col-4"><input name="changeusername" type="submit" value="Change your username"></div>
          </div><!-- /row -->
          <div class="row">
            <div class="col-4">Email: </div>
            <div class="col-4"><?= $email ?></div>
            <div class="col-4"><input name="changeemail" type="submit" value="Change your email"></div>
          </div><!-- /row -->
          <div class="row">
            <div class="col-4">Password: </div>
            <div class="col-4">********* </div>
            <div class="col-4"><input name="changepassword" type="submit" value="Change your password"></div>
          </div><!-- /row -->
        <hr>
</form> <!-- /container -->
<?php endif; ?>

<?php endif; ?>