<link rel="stylesheet" href="/css/pyramid.css">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Pyramid Workout</h1>
    </div>
</div>
<?php if ($loggedIn): ?>
<div id="chooseExercisePanel" class="container fill-height">

    <div id="chooseExerciseRow" class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="exercise">Which exercise do you want to use the pyramid for?</label>
            <span class="sr-only">A selectable list of excercises</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="A selectable list of excercises" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Your max for the exercise you select will be saved so that you won't have to remember it the next time that you use this app.">
            <select class="custom-select d-block w-100" id="exerciseSelect" required>
                <option value="">Choose...</option>
                <?php $value = 1; ?>
                <?php foreach ($exerciseTypes as $exercise): ?>
                <option value="<?=$value?>" data-id="<?=$exercise["id"]?>">
                    <?=$exercise["exerciseName"]?>
                </option>
                <?php $value = $value + 1; ?>
                <?php endforeach;?>
                <option value="<?=$value?>">Other</option>
            </select>
            <div class="invalid-feedback">
                Please select a valid exercise.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <button id="selectExerciseBtn" class="btn btn-primary">submit</button>
        </div>
    </div>
</div>
<form id="maxInputForm" action="" method="post" class="container fill-height" style="display: none;">
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label id="lblMax" for="max">Enter your 1RM (one rep max) for the <span id="exerciseTxt"></span></label>
            <span class="sr-only">Information about 1RM - 1 rep max</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about 1RM - 1 rep max" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="1RM stands for one repetion maximum.  In other words, it is the maximum amount of weight you can lift one time.">

            <?php foreach ($userDatas as $userData): ?>
            <input type="hidden" class="user-max-data" data-id="<?=$userData[" id"]?>" data-user_id="
            <?=$userData["user_id"]?>" data-max="
            <?=$userData["max"]?>" data-exercise_type="
            <?=$userData["exercise_type"]?>">
            <?php endforeach;?>


            <input type="hidden" id="exerciseId" name="exerciseId">
            <input id="max" name="max" type="number" min="10" max="1200" size="4" step="0.25" value="" required>
        </div>
    </div>
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <input id="submitLoggedIn" name="submitLoggedIn" type="submit" class="btn btn-primary" value="submit">
        </div>
    </div>
    <!-- End Intro -->
</form>

<?php else: ?>
<form action="" method="post" class="container">
    <div class="row mb-3">
        <div id="col-xs-12 col-sm-9 col-md-3 col-lg-4">
            <label for="maxNotLogged">Enter your 1RM:</label>
            <span class="sr-only">Information about 1RM - 1 rep max</span>
            <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about 1RM - 1 rep max" width="12px"
                height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="1RM stands for one repetion maximum.  In other words, it is the maximum amount of weight you can lift one time.">
            <input id="maxNotLogged" name="maxNotLogged" type="number" min="10" max="1200" size="4" step="0.25" value="100"
                required>
            <input id="submit" name="submit" type="submit" class="btn btn-primary" value="submit">
        </div>
    </div>
</form>
<?php endif;?>
</div>
<script type="text/javascript" src="/js/pyramid.js"></script>