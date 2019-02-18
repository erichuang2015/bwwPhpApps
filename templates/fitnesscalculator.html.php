<link rel="stylesheet" href="/css/fitnesscalculator.css">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">Fitness Calculator</h1>
    </div>
</div>
<div id="divFitnessCalculator" class="container fill-height">
    <div id="divFitStartPg">
        <p>Which would you like to measure, your Body Fat or BMI?</p>
        <form id="form-measurement2" name="form-measurement2">
            <fieldset>
                <input id="bodyFat" name="rbMeasureSelect" type="radio" value="Body Fat" checked>
                <label for="bodyFat">Body Fat</label>
                <input id="bmi" name="rbMeasureSelect" type="radio" value="BMI">
                <label for="bmi">BMI</label>
                <input id="btnSubmitFitCalc" class="btn btn-primary" type="submit" value="Submit" />
            </fieldset>
        </form>
    </div>


    <div id="divSexInputPg" style="display: none">
        <h2>Select your sex and input your age please.</h2>
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
                        <label class="form-check-label" for="rbMale">Male</label>
                        <!--form-check-input is for checkbox for radio btn label -->
                    </div>
                    <div class="form-check">
                        <input id="rbFemale" name="rbSexSelect" class="form-check-input" type="radio" value="Female">
                        <label class="form-check-label" for="rbFemale">Female</label>
                    </div>
                </div>

                <div class="col">
                    <label class="" for="age">Years of Age:</label>
                    <input id="age" name="age" class="form-control col-md-2" type="number" min="18" max="140" value="40"
                        required />
                    <!--form-control is for text or number inputs -->
                    <div class="invalid-feedback"><span id="ageInputError"></span></div>
                    <!--invalid-feedback displays the error message in red font -->
                </div>
            </div>
            <input id="btnSubmitSexSelect" type="submit" value="Submit" class="btn btn-primary" />
        </form>
    </div>

    <div id="divCalInstructions" style="display: none">
        <ol>
            <li>
                <p class="">The site you will use for the skinfold measurement is located
                    approximately one inch above the point of your right hipbone. Put your left index finger on
                    the point of your right hipbone and move up one inch (see figure 1).<img
                        src="css/images/fitnessCalculator/figure1.png"
                        alt="Figure 1 shows the location on abdomen for skinfold test."
                        title="Figure 1 shows the location on abdomen for skinfold test." /></p>
            </li>
            <li>
                <p>Make sure the slide on the curved part of the caliper is moved all the way to the right, and
                    place the caliper in your right hand.</p>
            </li>
            <li>
                <p class="">While standing, with your fingers about 2-3 inches apart, firmly
                    grasp the skinfold between the thumb and index finger of your left hand, and gently pull
                    the skinfold away from your body. Pull the skin and underlying fat away from the muscle
                    tissue (see figures 2 and 3).<img class="" src="css/images/fitnessCalculator/figure2.png"
                        alt="Figure 2 shows how to grip the skinfold 2-3 inches apart."
                        title="Figure 2 shows how to grip the skinfold 2-3 inches apart." /><img
                        src="css/images/fitnessCalculator/figure3.png"
                        alt="Figure 3 shows how to pull the skin and underlying fat away from the muscle tissue."
                        title="Figure 3 shows how to pull the skin and underlying fat away from the muscle tissue." />
                </p>
            </li>
            <li>
                <p class="">With the caliper in your right hand, place its jaws over the
                    skinfold about 1/4 of an inch from your left thumb and forefinger (see figures 4 and 5).
                    The caliper heads should be halfway between the crest and base of the fold, right in the
                    middle of the fold (see figure 4). The caliper must be perpendicular to the skinfold.<img class=""
                        src="css/images/fitnessCalculator/figure4.png"
                        alt="Figure 4 shows the caliper heads in the middle of the skinfold."
                        title="Figure 4 shows the caliper heads in the middle of the skinfold." /><img
                        src="css/images/fitnessCalculator/figure5.png"
                        alt="Figure 5 shows the caliper being used in a perpendicular position to the skinfold."
                        title="Figure 5 shows the caliper being used in a perpendicular position to the skinfold." />
                </p>
            </li>
            <li>
                <p>While continuing to hold the skinfold with the left hand, press the thumb where indicated on
                    the caliper until you feel a slight "CLICK." The measurement slide will automatically move
                    across the measurement arm and stop at the correct reading. Immediately stop pinching when
                    you feel and hear the "CLICK."</p>
                <p>Release the jaws of the caliper and read and record your measurement to the nearest
                    millimeter.</p>
            </li>
            <li>
                <p>Once you have taken one reading, take another measurement. <span id="spanConsistentReq">If
                        the second reading is more than 1mm apart from your first reading, take another
                        measurement, and record the reading when it becomes most consistent.</span></p>
            </li>
        </ol>
        <form id="form-input-mm" class="needs-validation" novalidate>
            <fieldset>
                <div class="form-row">
                    <div class="col-4">
                        <label for="numMM1"><span class="required-field" title="Required Field">*</span> 1st
                            Caliper Reading in <b>Millimeters:</b></label>
                    </div>
                    <div class="col-12">
                        <input id="numMM1" type="number" min="2" max="36" value="2"
                            class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-2" required>
                        <div class="invalid-feedback col-12"><span id="inputNumMM1Error"></span></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="numMM2"><span class="required-field" title="Required Field">*</span> 2nd
                            Caliper Reading in <b>Millimeters:</b></label>
                    </div>
                    <div class="col-12">
                        <input id="numMM2" type="number" min="2" max="36" value="2"
                            class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-2" required>
                        <div class="invalid-feedback col-12"><span id="inputNumMM2Error"></span></div>
                    </div>
                </div>
                <input id="btnSubmitNumMM" class="btn btn-primary" type="submit" value="Submit" />
            </fieldset>
        </form>
        <aside>
            <p><b>Note:</b> These instructions came with ACCU-MEASURE Calipers and may not provide the same
                results with calipers of a different brand.</p>
            <cite>THE IDEAL WAY TO MEASURE BODY FAT USING THE ACCU-MEASURE&reg; CALIPER by ACCU-MEASURE&reg;</cite>
        </aside>
    </div>
    <div id="divbodFatResults" style="display: none">
        <h2 id="h2BodyFatResults"></h2><br>
        <input id='btnBodFatReset' class='btn btn-secondary' type='reset' value='Reset' />
    </div>

    <form id="divBMIInputPg" class="needs-validation" novalidate style="display: none">
        <p>To calculate your BMI we need your height and weight. Please input both meaurements below.</p>
        <label for="inputHeight">Height:</label>
        <ul>
            <li>
                <label for="inputHeightFt" class="bmi-ft-lbl">Feet:</label>
                <input id="inputHeightFt" class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-3" type="number"
                    min="1" max="7" value="5" maxlength="1" autofocus required />
                <div class="invalid-feedback col-12"><span id="inputHeightFtError"></span></div>
            </li>
            <li>
                <label for="inputHeightIn">Inches:</label>
                <input id="inputHeightIn" class="form-control col-xl-1 col-lg-1 col-md-2 col-sm-2 col-3" type="number"
                    min="0" max="11" value="0" maxlength="2" required />
                <div class="invalid-feedback col-12"><span id="inputHeightInError"></span></div>
            </li>
        </ul>
        <label for="iputWeight">Weight:</label>
        <input id="inputWeight" class="form-control col-xl-1 col-lg-1 col-md-3 col-sm-3 col-3" type="number" min="10"
            max="800" value="150" required />
        <div class="invalid-feedback col-12"><span id="inputWeightError"></span></div>

        <div class="row bmi-btns-row">
            <div class="col col-sm-1 col-md-2 col-lg-1 col-xl-1"><input id="btnBMISubmit" class="btn btn-primary"
                    type="submit" value="Submit"/></div>
            <div class="col col-sm-1 col-md-2 col-lg-1 col-xl-1"><input id="btnBMIReset" class="btn btn-secondary"
                    type="reset" value="Reset" /></div>
        </div>
        <p id="bmiResults"></p>
    </form>
</div>
<script type="text/javascript" src="/js/fitnesscalculator.js"></script>