<link rel="stylesheet" href="/css/pyramid.css">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Pyramid Workout</h1>
    </div>
</div>

<?php if (!empty($error)): ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2>Your exercise selection could not be processed. Please check the following: <span class="d-block">
                <?=$error?> </span></h2>
    </div>
</div>
<?php endif;?>

<?php if ($loggedIn): ?>
<div id="chooseExercisePanel" class="container fill-height">
    <div id="chooseExerciseRow" class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="exercise">Which exercise do you want to use the pyramid for?</label>
            <span class="sr-only">A selectable list of excercises</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="A selectable list of excercises" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="Your max for the exercise you select will be saved so that you won't have to remember it the next time that you use this app.">
            <select class="custom-select d-block w-100" id="exerciseSelect" required>
                <option value="">Choose...</option>
                <?php $value = 1; ?>
                <?php foreach ($exerciseTypes as $exercise): ?>
                <option value="<?=$value?>" data-id="<?=$exercise["id"]?>">
                    <?=$exercise["exerciseName"]?>
                </option>
                <?php $value = $value + 1; ?>
                <?php endforeach;?>
                <option value="<?=$value?>" data-other="other">Other</option>
            </select>
            <div class="invalid-feedback">
                Please select a valid exercise.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <button id="selectExerciseBtn" class="btn btn-primary" disabled>submit</button>
        </div>
    </div>
</div>

<!-- Add new exercise form begins here -->
<form id="newExerciseForm" action="" method="post" class="container fill-height" style="display: none;">
    <div id="newExerciseRow" class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="newExercise">Enter the name of your new exercise below:</label>
            <span class="sr-only">A text input for entry of a new exercise name.</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="A text input for entry of a new exercise name."
                width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="The exercise name you add will be saved so that you can use it to save your max repetitions against in the future.  The maximum number of characters for this input is 45.">
            <input type="text" class="d-block w-100" id="newExerciseTxtInput" name="newExerciseTxtInput" maxlength="45"
                required>
            <div class="invalid-feedback">
                Please input a valid exercise name.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <button id="newExerciseSubmitBtn" class="btn btn-primary" disabled>submit</button>
        </div>
    </div>
</form>
<!-- Add new exercise form ends here -->



<form id="maxInputForm" action="" method="post" class="container fill-height needs-validation" style="display: none;"
    novalidate>
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label id="lblMax" for="max">Enter your 1RM (one rep max) for the <span id="exerciseTxt"></span></label>
            <span class="sr-only">Information about 1RM - 1 rep max</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about 1RM - 1 rep max" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="1RM stands for one repetion maximum.  In other words, it is the maximum amount of weight you can lift one time.">

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
            <input id="submitLoggedIn" name="submitLoggedIn" type="submit" class="btn btn-primary" value="submit"
                disabled>
        </div>
    </div>
    <!-- End Intro -->
</form>

<?php else: ?>
<form id="maxInputFormNotAuthenticated" action="" method="post" class="container needs-validation" autocomplete="off" novalidate>
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="maxNotLogged">Enter your 1RM:</label>
            <span class="sr-only">Information about 1RM - 1 rep max</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about 1RM - 1 rep max" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right"
                data-content="1RM stands for one repetion maximum.  In other words, it is the maximum amount of weight you can lift one time.">
            <input id="maxNotLogged" name="maxNotLogged" class="form-control" type="number" min="10" max="1200" size="4"
                step="0.25" value="100" autocomplete="off" required autofocus>
            <div class="invalid-feedback"><span id="maxNotLoggedError"></span></div>
            <input id="submit" name="submit" type="submit" class="btn btn-primary" value="submit" disabled>
        </div>
    </div>
</form>
<?php endif;?>
</div>
<script type="text/javascript" src="/js/pyramid.js"></script>