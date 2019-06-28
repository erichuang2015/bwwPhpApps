<link rel="stylesheet" href="/css/register.css">
<?php if (!empty($errors)) : ?>
<div class="errors">
    <!--Need to replace this css errors class with bootstrap version -->
    <p>Your password could not be recovered. Please check the following:</p>
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>


<!-- Todo: Replace this with an email that allows the user to reset their password -->
<div class="container registration">
    <div class="py-5 text-center">
        <!-- <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h2>Password recovery form</h2>
        <p class="lead">Please submit the form below with your email address. A password reset link will be sent to the email you provide below.</p>
    </div>

    <div class="col-md-12 order-md-1">
        <form method="post" action="" class="needs-validation" autocomplete="off" novalidate>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="user[email]" placeholder="you@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" autocomplete="off" required>
                <div class="invalid-feedback"><span id="emailInputError"></span></div>
            </div>

            <div class="col-md-4 pl-0">
                <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submitBtn" value="Recover password" disabled>
            </div>

        </form>
    </div>
</div>
<script type="text/javascript" src="/js/passwordrecovery.js"></script>