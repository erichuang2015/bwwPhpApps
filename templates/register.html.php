<link rel="stylesheet" href="/css/register.css">
<?php if (!empty($errors)): ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <!--Need to replace this css errors class with bootstrap version -->
        <p>Your account could not be created, please check the following:</p>
        <ul>
            <?php foreach ($errors as $error): ?>
            <li>
                <h2><?=$error?></h2>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<?php endif;?>

<div class="container registration">
    <div class="text-center">
        <!-- <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <!-- <img class="d-block mx-auto mb-4" src="css/images/brand-logo-template.svg" alt="BWW Apps" width="72" height="72"> -->
        <h2>Register an account</h2>
        <p class="lead">Please fill out the below information to register for this site. By registering you will gain
            full access to all the apps on this site, and you will be able to save your data so it is available the
            next time you return to the site.</p>
    </div>

    <div class="row">
        <div class="col-md-12 order-md-1">
            <form method="post" action="" id="registerForm" class="needs-validation" autocomplete="off" novalidate>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" name="user[fname]"
                            pattern="[A-Za-z]{1,45}" placeholder="" value="" autocomplete="off" required autofocus>
                        <div class="invalid-feedback"><span id="firstNameInputError"></span></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="user[lname]"
                            pattern="[A-Za-z]{1,45}" placeholder="" value="" autocomplete="off" required>
                        <div class="invalid-feedback"><span id="lastNameInputError"></span></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="user[email]" placeholder="you@example.com"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" autocomplete="off" required>
                    <div class="invalid-feedback"><span id="emailInputError"></span></div>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about password requirements"
                        width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right"
                        data-content="Passwords must be more than 7 and less than 25 characters in length.  They must contain at lease one number, one uppercase and one lowercase alphabetical character, and may contain special characters.">
                    <span class="sr-only">Information about password requirements</span>
                    <input type="password" id="password" name="user[password]" class="form-control"
                        pattern="^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$" value="" maxlength="24" autocomplete="off"
                        required>
                    <div class="invalid-feedback"><span id="passwordInputError"></span></div>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Password Recovery Questions</h4>

                <div class="mb-3">
                    <label for="firstAnswer">When you were young, what did you want to be when you grew up?</label>
                    <input type="text" id="firstAnswer" name="user[firstanswer]" class="form-control" value=""
                        autocomplete="off" required>
                    <div class="invalid-feedback"><span id="firstAnswerInputError"></span></div>
                </div>

                <div class="mb-3">
                    <label for="secondAnswer">Who was your childhood hero?</label>
                    <input type="text" id="secondAnswer" name="user[secondanswer]" class="form-control" value=""
                        autocomplete="off" required>
                    <div class="invalid-feedback"><span id="secondAnswerInputError"></span></div>
                </div>

                <div class="mb-3">
                    <label for="thirdAnswer">Where was your best family vacation as a kid?</label>
                    <input type="text" id="thirdAnswer" name="user[thirdanswer]" class="form-control" value=""
                        autocomplete="off" required>
                    <div class="invalid-feedback"><span id="thirdAnswerInputError"></span></div>
                </div>

                <hr class="mb-4">

                <div class="col-md-4">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" id="submitBtn" name="submit"
                        value="Register account" disabled>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/register.js"></script>