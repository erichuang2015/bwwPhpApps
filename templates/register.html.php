<link rel="stylesheet" href="/css/signin.css">
<?php if (!empty($errors)): ?>
	<div class="errors"><!--Need to replace this css errors class with bootstrap version -->
		<p>Your account could not be created, please check the following:</p>
		<ul>
		<?php foreach ($errors as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; 	?>
		</ul>
	</div>
<?php endif; ?>

	<form method="post" action="" class="form-signin">
      <!-- <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
      <h1 class="h3 mb-3 font-weight-normal">Please register below</h1>
      <label for="email" class="sr-only">Your email address</label>
	  <input type="email" id="email" name="author[email]" class="form-control" value="<?=$author['email'] ?? ''?>" placeholder="Email address" required autofocus>
	  <label for="name" class="sr-only">Your name</label>
		<input name="author[name]" id="name" type="text" class="form-control" value="<?=$author['name'] ?? ''?>" placeholder="Name" required>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="author[password]" class="form-control" placeholder="Password" value="<?=$author['password'] ?? ''?>" required>
      <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register account">
    </form>