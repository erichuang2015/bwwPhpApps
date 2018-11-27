<!-- <link rel="stylesheet" href="/css/gladiator.css"> -->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Run Speed Calculator</h1>
    </div>
</div>
<div class="container fill-height">
    <h2>This program will help you determine how fast you need to run in order to reach a specified distance
        within an alloted amount of time.</h2>
    <div id="runSpeed-input-form">
        <div id="dist-time-input">
            <br>
            <ol class="run-speed-ol">
                <li>
                    <p class="run-speed">How far do you want to run?</p>
                    <label for=dist-range>Distance:</label>
                    <input type=range min=1 max=24 value=3 id=dist-range step=0.01 list=distance-settings oninput="distUpdate(value)">
                    <datalist id=distance-settings>
                        <option>1</option>
                        <option>6</option>
                        <option>12</option>
                        <option>18</option>
                        <option>24</option>
                    </datalist>
                    <output for=dist-range id=dist-output>3 miles</output>
                </li>
                <li>
                    <p class="run-speed">How much time do you have available?</p>
                    <label for=run-time>Time:</label>
                    <input type=range min=10 max=120 value=60 id=run-time step=1 list=time-settings oninput="timeUpdate(value)">
                    <datalist id=time-settings>
                        <option>10</option>
                        <option>30</option>
                        <option>60</option>
                        <option>90</option>
                        <option>120</option>
                    </datalist>
                    <output for=run-time id=time-output>60 minutes</output>
                    <script>
                        function timeUpdate(mins) {
                            document.querySelector('#time-output').value = mins;
                            $('#time-output').append(" minutes");
                        }
                    </script>
                </li>
            </ol>
            <br>
            <p hidden="" id="mph-paragraph" class="required-mph-paragraph"></p><br>
            <input type="submit" value="Submit" id="btn-submit-runSpeed" name="btn-submit-runSpeed" class="submitBtn"
                onclick="getMilesPerHour()">
            <br>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/runspeedcalculator.js"></script>