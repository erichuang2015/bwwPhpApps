<link rel="stylesheet" href="/css/pyramid.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="errorEnter1Rm" type="hidden" value="<?= $content['errorEnter1Rm'] ?>">
<input id="errorMoreThanTen" type="hidden" value="<?= $content['errorMoreThanTen'] ?>">
<input id="errorLouFerringo" type="hidden" value="<?= $content['errorLouFerringo'] ?>">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>

<?php if (!empty($error)): ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2><?= $content['serverError'] ?><span class="d-block">
                <?=$error?> </span></h2>
    </div>
</div>
<?php endif;?>

<?php if ($loggedIn): ?>
<div id="chooseExercisePanel" class="container fill-height">
    <div id="chooseExerciseRow" class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="exercise"><?= $content['lblSelectExercise'] ?></label>
            <span class="sr-only"><?= $content['selectExerciseSrTxt'] ?></span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['selectExerciseSrTxt'] ?>" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="<?= $content['savingYourMaxContent'] ?>">
            <select class="custom-select d-block w-100" id="exerciseSelect" required>
                <option value=""><?= $content['choose'] ?></option>
                <?php $value = 1; ?>
                <?php foreach ($exerciseTypes as $exercise): ?>
                <option value="<?=$value?>" data-id="<?=$exercise["id"]?>">
                    <?=$exercise["exerciseName"]?>
                </option>
                <?php $value = $value + 1; ?>
                <?php endforeach;?>
                <option value="<?=$value?>" data-other="other"><?= $content['other'] ?></option>
            </select>
            <div class="invalid-feedback">
                <?= $content['errorInvalidExercise'] ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <button id="selectExerciseBtn" class="btn btn-primary" disabled><?= $content['btnSubmit'] ?></button>
        </div>
    </div>
</div>

<!-- Add new exercise form begins here -->
<form id="newExerciseForm" action="" method="post" class="container fill-height" style="display: none;">
    <div id="newExerciseRow" class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="newExercise"><?= $content['lblNewExercise'] ?></label>
            <span class="sr-only"><?= $content['srNewExercise'] ?></span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['srNewExercise'] ?>"
                width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="<?= $content['infoPopoverTxt'] ?>">
            <input type="text" class="d-block w-100" id="newExerciseTxtInput" name="newExerciseTxtInput" maxlength="45"
                required>
            <div class="invalid-feedback">
                <?= $content['errorExerciseName'] ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <button id="newExerciseSubmitBtn" class="btn btn-primary" disabled><?= $content['btnSubmit'] ?></button>
        </div>
    </div>
</form>
<!-- Add new exercise form ends here -->



<form id="maxInputForm" action="" method="post" class="container fill-height needs-validation" style="display: none;"
    novalidate>
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label id="lblMax" for="max"><?= $content['lblMax'] ?><span id="exerciseTxt"></span></label>
            <span class="sr-only"><?= $content['srMax'] ?></span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['srMax'] ?>" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="<?= $content['1rmPopOverTxt'] ?>">

            <?php foreach ($userDatas as $userData): ?>
            <input type="hidden" class="user-max-data" data-id="<?=$userData["id"]?>"
                data-user_id="<?=$userData["user_id"]?>" data-max="<?=$userData["max"]?>"
                data-exercise_type="<?=$userData["exercise_type"]?>">
            <?php endforeach;?>

            <input type="hidden" id="recordId" name="recordId">
            <input type="hidden" id="exerciseId" name="exerciseId"> <!-- This is supposed to be the exercise type -->
            <input id="max" name="max" type="number" class="form-control" min="10" max="1200" size="4" step="0.25" required autofocus>
            <div class="invalid-feedback"><span id="maxError"></span></div>
        </div>
    </div>
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <input id="submitLoggedIn" name="submitLoggedIn" type="submit" class="btn btn-primary" value="<?= $content['btnSubmit'] ?>"
                disabled>
        </div>
    </div>
    <!-- End Intro -->
</form>

<?php else: ?>
<form id="maxInputFormNotAuthenticated" action="" method="post" class="container needs-validation" autocomplete="off" novalidate>
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="maxNotLogged"><?= $content['lblMaxNotLogged'] ?></label>
            <span class="sr-only"><?= $content['srMax'] ?></span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['srMax'] ?>" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="<?= $content['1rmPopOverTxt'] ?>">
            <input id="maxNotLogged" name="maxNotLogged" class="form-control" type="number" min="10" max="1200" size="4"
                step="0.25" value="100" autocomplete="off" required autofocus>
            <div class="invalid-feedback"><span id="maxNotLoggedError"></span></div>
            <input id="submit" name="submit" type="submit" class="btn btn-primary" value="<?= $content['btnSubmit'] ?>" disabled>
        </div>
    </div>
</form>
<?php endif;?>
</div>
<script type="text/javascript" src="/js/pyramid.js"></script>