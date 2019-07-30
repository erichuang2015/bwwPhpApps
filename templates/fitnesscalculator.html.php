<link rel="stylesheet" href="/css/fitnesscalculator.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="ageInputErrorHidden" type="hidden" value="<?= $content['ageInputErrorHidden'] ?>">
<input id="inputNumErrorHidden" type="hidden" value="<?= $content['inputNumErrorHidden'] ?>">
<input id="inputNumSecondErrorHidden" type="hidden" value="<?= $content['inputNumSecondErrorHidden'] ?>">
<input id="bodyFatResultsHidden" type="hidden" value="<?= $content['bodyFatResultsHidden'] ?>">
<input id="inputHeightFtErrorHidden" type="hidden" value="<?= $content['inputHeightFtErrorHidden'] ?>">
<input id="inputHeightInErrorHidden" type="hidden" value="<?= $content['inputHeightInErrorHidden'] ?>">
<input id="inputWeightErrorHidden" type="hidden" value="<?= $content['inputWeightErrorHidden'] ?>">
<input id="bmiResultsHidden" type="hidden" value="<?= $content['bmiResultsHidden'] ?>">

<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div id="divFitnessCalculator" class="container fill-height">
    <div id="divFitStartPg">
        <p><?= $content['fatOrBmi'] ?></p>
        <form id="form-measurement2" name="form-measurement2">
            <fieldset>
                <input id="bodyFat" name="rbMeasureSelect" type="radio" value="Body Fat" checked>
                <label for="bodyFat"><?= $content['bodyFat'] ?></label>
                <input id="bmi" name="rbMeasureSelect" type="radio" value="BMI">
                <label for="bmi"><?= $content['bmi'] ?></label>
                <input id="btnSubmitFitCalc" class="btn btn-primary" type="submit" value="<?= $content['submit'] ?>" />
            </fieldset>
        </form>
    </div>


    <div id="divSexInputPg" style="display: none">
        <h2><?= $content['sexAndAge'] ?></h2>
        <form id="form-sexSelect" class="needs-validation" novalidate>
            <!--always use class='needs-validation' and novalidate attr -->
            <div class="form-row">
                <!--form-row for rows within  the form duh... -->
                <div class="col">
                    <div class="form-check">
                        <!--form-check is for checkbox for radio btn container -->
                        <input id="rbMale" name="rbSexSelect" class="form-check-input" type="radio" value="Male"
                            checked>
                        <!--form-check-input is for checkbox for radio btn input -->
                        <label class="form-check-label" for="rbMale"><?= $content['male'] ?></label>
                        <!--form-check-input is for checkbox for radio btn label -->
                    </div>
                    <div class="form-check">
                        <input id="rbFemale" name="rbSexSelect" class="form-check-input" type="radio" value="Female">
                        <label class="form-check-label" for="rbFemale"><?= $content['female'] ?></label>
                    </div>
                </div>

                <div class="col">
                    <label class="" for="age"><?= $content['yrsAge'] ?></label>
                    <input id="age" name="age" class="form-control col-md-2" type="number" min="18" max="140" value="40"
                        required />
                    <!--form-control is for text or number inputs -->
                    <div class="invalid-feedback"><span id="ageInputError"></span></div>
                    <!--invalid-feedback displays the error message in red font -->
                </div>
            </div>
            <input id="btnSubmitSexSelect" type="submit" value="<?= $content['submit'] ?>" class="btn btn-primary" />
        </form>
    </div>

    <div id="divCalInstructions" style="display: none">
        <ol>
            <li>
                <p class=""><?= $content['skinFoldLoc'] ?><img
                        src="css/images/fitnessCalculator/figure1.png"
                        alt="<?= $content['skinFoldAlt'] ?>"
                        title="<?= $content['skinFoldTitle'] ?>" /></p>
            </li>
            <li>
                <p><?= $content['rightHand'] ?></p>
            </li>
            <li>
                <p class=""><?= $content['twoToThreeInches'] ?><img class="" src="css/images/fitnessCalculator/figure2.png"
                        alt="<?= $content['figTwoAltTxt'] ?>"
                        title="<?= $content['figTwoAltTxt'] ?>" /><img
                        src="css/images/fitnessCalculator/figure3.png"
                        alt="<?= $content['figThreeAltTxt'] ?>"
                        title="<?= $content['figThreeAltTxt'] ?>" />
                </p>
            </li>
            <li>
                <p class=""><?= $content['figFourFiveInstructions'] ?><img class=""
                        src="css/images/fitnessCalculator/figure4.png"
                        alt="<?= $content['figFourAltTxt'] ?>"
                        title="<?= $content['figFourAltTxt'] ?>" /><img
                        src="css/images/fitnessCalculator/figure5.png"
                        alt="<?= $content['figFiveAltTxt'] ?>"
                        title="<?= $content['figFiveAltTxt'] ?>" />
                </p>
            </li>
            <li>
                <p><?= $content['untilClick'] ?></p>
                <p><?= $content['releaseJaws'] ?></p>
            </li>
            <li>
                <p><?= $content['takeAnother'] ?> <span id="spanConsistentReq"><?= $content['spanConsistentReq'] ?></span></p>
            </li>
        </ol>
        <form id="form-input-mm" class="needs-validation" novalidate>
            <fieldset>
                <div class="form-row">
                    <div class="col-4">
                        <label for="numMM1"><span class="required-field" title="Required Field">*</span><?= $content['firstCaliperReading'] ?></label>
                    </div>
                    <div class="col-12">
                        <input id="numMM1" type="number" min="2" max="36" value="2"
                            class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-2" required>
                        <div class="invalid-feedback col-12"><span id="inputNumMM1Error"></span></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="numMM2"><span class="required-field" title="Required Field">*</span> <?= $content['secondCaliperReading'] ?></label>
                    </div>
                    <div class="col-12">
                        <input id="numMM2" type="number" min="2" max="36" value="2"
                            class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-2" required>
                        <div class="invalid-feedback col-12"><span id="inputNumMM2Error"></span></div>
                    </div>
                </div>
                <input id="btnSubmitNumMM" class="btn btn-primary" type="submit" value="<?= $content['submit'] ?>" />
            </fieldset>
        </form>
        <aside>
            <p><?= $content['note'] ?></p>
            <cite><?= $content['cite'] ?></cite>
        </aside>
    </div>
    <div id="divbodFatResults" style="display: none">
        <h2 id="h2BodyFatResults"></h2><br>
        <input id='btnBodFatReset' class='btn btn-secondary' type='reset' value='<?= $content['reset'] ?>' />
    </div>

    <form id="divBMIInputPg" class="needs-validation" novalidate style="display: none">
        <p><?= $content['calcBMI'] ?></p>
        <label for="inputHeight"><?= $content['height'] ?></label>
        <ul>
            <li>
                <label for="inputHeightFt" class="bmi-ft-lbl"><?= $content['feet'] ?></label>
                <input id="inputHeightFt" class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-3" type="number"
                    min="1" max="7" value="5" maxlength="1" autofocus required />
                <div class="invalid-feedback col-12"><span id="inputHeightFtError"></span></div>
            </li>
            <li>
                <label for="inputHeightIn"><?= $content['inches'] ?></label>
                <input id="inputHeightIn" class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-3" type="number"
                    min="0" max="11" value="0" maxlength="2" required />
                <div class="invalid-feedback col-12"><span id="inputHeightInError"></span></div>
            </li>
        </ul>
        <label for="inputWeight"><?= $content['weight'] ?></label>
        <input id="inputWeight" class="form-control col-xl-1 col-lg-1 col-md-3 col-sm-3 col-3" type="number" min="10"
            max="800" value="150" required />
        <div class="invalid-feedback col-12"><span id="inputWeightError"></span></div>

        <div class="row bmi-btns-row">
            <div class="col col-sm-1 col-md-2 col-lg-1 col-xl-1"><input id="btnBMISubmit" class="btn btn-primary"
                    type="submit" value="<?= $content['submit'] ?>"/></div>
            <div class="col col-sm-1 col-md-2 col-lg-1 col-xl-1"><input id="btnBMIReset" class="btn btn-secondary"
                    type="reset" value="<?= $content['reset'] ?>" /></div>
        </div>
        <p id="bmiResults"></p>
    </form>
</div>
<script type="text/javascript" src="/js/fitnesscalculator.js"></script>