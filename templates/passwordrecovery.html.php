<link rel="stylesheet" href="/css/register.css">
<?php if (!empty($errors)): ?>
	<div class="errors"><!--Need to replace this css errors class with bootstrap version -->
		<p>Your password could not be recovered.  Please check the following:</p>
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
      <h2>Password recovery form</h2>
      <p class="lead">Please submit the form below with your email and the correct answer to the security questions below to recover your password.</p>
    </div>

      <div class="col-md-12 order-md-1">
        <form method="post" action="" class="needs-validation" autocomplete="off">

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="author[email]" placeholder="you@example.com" value="" autocomplete="off" required>
            <div class="invalid-feedback">
              Please enter a valid email address.
            </div>
		  </div>

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
		  <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Recover password">
		  
        </form>
      </div>
  </div>