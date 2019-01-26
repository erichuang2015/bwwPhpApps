<link rel="stylesheet" href="/css/register.css">


<div class="container">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Register an account</h2>
        <p class="lead">We just emailed activation code to you. Please input your activation code below to activate
            your account. </p>
        <p class="lead">
            <?=$message?>
        </p>
    </div>

    <div class="row">
        <div class="col-md-12 order-md-1">
            <form method="post" action="" id="activationCodeForm" class="needs-validation" autocomplete="off"
                novalidate>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="activationCode">Activation Code</label>
                        <input type="text" class="form-control" id="activationCode" name="activationCode" placeholder=""
                            value="" autocomplete="off" required autofocus>
                        <div class="invalid-feedback"><span id="activationCodeInputError"></span></div>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="col-md-4">
                    <input class="btn btn-primary" type="submit" id="activationSubmitBtn" name="activationSubmitBtn"
                        value="Activate account">
                </div>

            </form>
        </div>
    </div>
</div>
<!-- <script type="text/javascript" src="/js/register.js"></script> -->