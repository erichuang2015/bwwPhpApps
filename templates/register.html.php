<link rel="stylesheet" href="/css/register.css">
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



<div class="container registration">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h2>Registration form</h2>
      <p class="lead">Please fill out the below information to register for this site.  By registering you will gain full access to all the apps on this site, and you will be able to save your data so it is available the next time you return to the site.</p>
    </div>

    <div class="row">
      <div class="col-md-12 order-md-1">
        <form method="post" action="" class="needs-validation" autocomplete="off">
          <div class="row">

            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" name="author[fname]" placeholder="" value="" autocomplete="off" required autofocus>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" name="author[lname]" placeholder="" value="" autocomplete="off" required>
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="author[email]" placeholder="you@example.com" value="" autocomplete="off" required>
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
		  </div>
		  
		  <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="author[password]" class="form-control" value="" autocomplete="off" required>
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
		  </div>

		  <hr class="mb-4">

		  <h4 class="mb-3">Password Recovery Questions</h4>

		  <div class="mb-3">
            <label for="firstAnswer">When you were young, what did you want to be when you grew up?</label>
            <input type="text" id="firstAnswer" name="author[firstanswer]" class="form-control" value="" autocomplete="off" required>
            <div class="invalid-feedback">
              Please answer the question about what you want to you wanted to be when you grew up.
            </div>
		  </div>

		  <div class="mb-3">
            <label for="secondAnswer">Who was your childhood hero?</label>
            <input type="text" id="secondAnswer" name="author[secondanswer]" class="form-control" value="" autocomplete="off" required>
            <div class="invalid-feedback">
              Please answer the question about who your childhood hero was.
            </div>
		  </div>

		  <div class="mb-3">
            <label for="thirdAnswer">Where was your best family vacation as a kid?</label>
            <input type="text" id="thirdAnswer" name="author[thirdanswer]" class="form-control" value="" autocomplete="off" required>
            <div class="invalid-feedback">
              Please answer the question about your best family vacation when you were a kid.
            </div>
		  </div>

		  <hr class="mb-4">
		  
		  <div class="col-md-4">
		  <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register account">
		  </div>
		  
        </form>
      </div>
    </div>
  </div>