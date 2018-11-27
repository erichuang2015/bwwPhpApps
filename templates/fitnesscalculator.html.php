<!-- <link rel="stylesheet" href="/css/gladiator.css"> -->
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
                <input id="btnSubmitFitCalc" type="submit" value="Submit" />
            </fieldset>
        </form>
    </div>
    <div id="divSexInputPg">
        <p>Select your sex and input your age please.</p>
        <form id="form-sexSelect">
            <fieldset>
                <input id="rbMale" name="rbSexSelect" type="radio" value="Male" checked>
                <label for="rbMale">Male</label>
                <input id="rbFemale" name="rbSexSelect" type="radio" value="Female">
                <label for="rbFemale">Female</label>
                <label class="" for="age">Years of Age:</label>
                <input id="age" type="number" min="18" max="140" value="40" required /><br><span id="ageInputError"
                    class="input-error"></span>
                <input id="btnSubmitSexSelect" type="submit" value="Submit" />
            </fieldset>
        </form>
    </div>
    <div id="divCalInstructions">
        <ol>
            <li>
                <p class="">The site you will use for the skinfold measurement is located
                    approximately one inch above the point of your right hipbone. Put your left index finger on
                    the point of your right hipbone and move up one inch (see figure 1).<img src="css/images/fitnessCalculator/figure1.png"
                        alt="Figure 1 shows the location on abdomen for skinfold test." title="Figure 1 shows the location on abdomen for skinfold test." /></p>
            </li>
            <li>
                <p>Make sure the slide on the curved part of the caliper is moved all the way to the right, and
                    place the caliper in your right hand.</p>
            </li>
            <li>
                <p class="">While standing, with your fingers about 2-3 inches apart, firmly
                    grasp the skinfold between the thumb and index finger of your left hand, and gently pull
                    the skinfold away from your body. Pull the skin and underlying fat away from the muscle
                    tissue (see figures 2 and 3).<img class="" src="css/images/fitnessCalculator/figure2.png" alt="Figure 2 shows how to grip the skinfold 2-3 inches apart."
                        title="Figure 2 shows how to grip the skinfold 2-3 inches apart." /><img src="css/images/fitnessCalculator/figure3.png"
                        alt="Figure 3 shows how to pull the skin and underlying fat away from the muscle tissue." title="Figure 3 shows how to pull the skin and underlying fat away from the muscle tissue." /></p>
            </li>
            <li>
                <p class="">With the caliper in your right hand, place its jaws over the
                    skinfold about 1/4 of an inch from your left thumb and forefinger (see figures 4 and 5).
                    The caliper heads should be halfway between the crest and base of the fold, right in the
                    middle of the fold (see figure 4). The caliper must be perpendicular to the skinfold.<img class=""
                        src="css/images/fitnessCalculator/figure4.png" alt="Figure 4 shows the caliper heads in the middle of the skinfold."
                        title="Figure 4 shows the caliper heads in the middle of the skinfold." /><img src="css/images/fitnessCalculator/figure5.png"
                        alt="Figure 5 shows the caliper being used in a perpendicular position to the skinfold." title="Figure 5 shows the caliper being used in a perpendicular position to the skinfold." /></p>
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
        <form id="form-input-mm">
            <fieldset>
                <div class="row">
                    <div class="col-4">
                        <label for="numMM1"><span class="required-field" title="Required Field">*</span> 1st
                            Caliper Reading in <b>Millimeters:</b></label>
                    </div>
                    <div class="col-8">
                        <input id="numMM1" type="number" min="2" max="36" value="2" required><br><span id="inputNumMM1Error"
                            class="input-error"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="numMM2"><span class="required-field" title="Required Field">*</span> 2nd
                            Caliper Reading in <b>Millimeters:</b></label>
                    </div>
                    <div class="col-8">
                        <input id="numMM2" type="number" min="2" max="36" value="2" required><br><span id="inputNumMM2Error"
                            class="input-error"></span>
                    </div>
                </div>
                <input id="btnSubmitNumMM" type="submit" value="Submit" />
            </fieldset>
        </form>
        <aside>
            <p><b>Note:</b> These instructions came with ACCU-MEASURE Calipers and may not provide the same
                results with calipers of a different brand.</p>
            <cite>THE IDEAL WAY TO MEASURE BODY FAT USING THE ACCU-MEASURE&reg; CALIPER by ACCU-MEASURE&reg;</cite>
        </aside>
    </div>
    <div id="divbodFatResults">
        <h2 id="h2BodyFatResults"></h2><br>
        <input id='btnBodFatReset' class='' type='reset' value='Reset' />
    </div>

    <div id="divBMIInputPg">
        <p>To calculate your BMI we need your height and weight. Please input both meaurements below.</p>
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <!--height label-->
                    <label for="inputHeight">Height:</label>
                </div>
                <div class="col-3">
                    <!--height Inputbox-->
                    <ul>
                        <li>
                            <label for="inputHeightFt">Feet:</label>
                            <input id="inputHeightFt" type="number" min="0" max="7" value="6" />
                        </li>
                        <li>
                            <label for="inputHeightIn">Inches:</label>
                            <input id="inputHeightIn" type="number" min="0" max="12" value="0" />
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <!--weight label-->
                    <label for="iputWeight">Weight:</label>
                </div>
                <div class="col-3">
                    <!--weight inputbox-->
                    <input id="inputWeight" type="number" min="10" max="800" value="190" />
                </div>
            </div>
            <div class="">
                <input id="btnBMISubmit" type="submit" value="Submit" />
                <input id="btnBMIReset" type="reset" value="Reset" />
            </div>
            <p id="bmiResults"></p>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/fitnesscalculator.js"></script>