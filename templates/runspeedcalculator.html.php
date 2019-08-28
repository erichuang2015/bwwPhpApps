<link rel="stylesheet" href="/css/runspeed.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="distanceInputError" type="hidden" value="<?= $content['distanceInputError'] ?>">
<input id="runMinutesErrorHidden" type="hidden" value="<?= $content['runMinutesErrorHidden'] ?>">
<input id="runSecondsErrorHidden" type="hidden" value="<?= $content['runSecondsErrorHidden'] ?>">
<input id="youMustRun" type="hidden" value="<?= $content['youMustRun'] ?>">
<input id="achieveGoal" type="hidden" value="<?= $content['achieveGoal'] ?>">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div class="container fill-height">
    <h2 class="mb-4"><?= $content['h2Text'] ?></h2>
    <form action="" method="" id="runSpeed-input-form" class="needs-validation">
        <div id="dist-time-input">
            <ol class="run-speed-ol">
                <li>
                    <p class="run-speed"><?= $content['howFar'] ?></p>
                    <div class="col-7 col-sm-7 col-md-3 col-lg-3 col-xl-3">
                        <label for="distance"><?= $content['lblMiles'] ?></label>
                        <span class="sr-only"><?= $content['srTxtMiles'] ?></span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['srTxtMiles'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content='<?= $content['dataContentMiles'] ?>'>
                    </div>
                    <div class="col-11 col-sm-9 col-md-5 col-lg-4 col-xl-3">
                        <input type="number" min="1" max="24" value="3" id="distance" step="0.01" class="form-control" required autofocus>
                        <div class="invalid-feedback"><span id="distanceError"></span></div>
                    </div>

                </li>
                <li>
                    <p class="run-time"><?= $content['howLong'] ?></p>
                    <label for="runMinutes"><?= $content['lblMinutes'] ?></label>
                    <span class="sr-only"><?= $content['srTxtMinutes'] ?></span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['srTxtMinutes'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content='<?= $content['dataContentMinutes'] ?>'>
                    <div class="col-11 col-sm-9 col-md-5 col-lg-4 col-xl-3">
                        <input type="number" min="1" max="300" value="60" id="runMinutes" step="1" class="form-control" required>
                        <div class="invalid-feedback"><span id="runMinutesError"></span></div>
                    </div>

                    <label class="run-seconds" for="runSeconds"><?= $content['lblSeconds'] ?></label>
                    <span class="sr-only"><?= $content['srTxtSeconds'] ?></span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['srTxtSeconds'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content='<?= $content['dataContentSeconds'] ?>'>
                    <div class="col-11 col-sm-9 col-md-5 col-lg-4 col-xl-3">
                        <input type="number" min="0" max="59" value="00" id="runSeconds" step="1" class="form-control" required>
                        <div class="invalid-feedback"><span id="runSecondsError"></span></div>
                    </div>
                </li>
            </ol>

            <div id="mphAlert" class="container fill-height" hidden>
                <div class="alert alert-primary" role="alert">
                    <h2></h2>
                </div>
            </div>

            <!-- <p hidden id="mphParagraph"></p> -->
            <button id="btnSubmitRunSpeed" name="btnsubmitrunspeed" class="btn btn-primary" disabled><?= $content['btnSubmit'] ?></button>
        </div>
    </form>
</div>
<script type="text/javascript" src="/js/runspeedcalculator.js"></script>