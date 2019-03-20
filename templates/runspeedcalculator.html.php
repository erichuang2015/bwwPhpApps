<link rel="stylesheet" href="/css/runspeed.css">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Run Speed Calculator</h1>
    </div>
</div>
<div class="container fill-height">
    <h2 class="mb-4">This program will help you determine how fast you need to run in order to reach a specified distance
        within an alloted amount of time.</h2>
    <form action="" method="" id="runSpeed-input-form" class="needs-validation">
        <div id="dist-time-input">
            <ol class="run-speed-ol">
                <li>
                    <p class="run-speed">How far do you want to run?</p>
                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                        <label for="distance">Miles</label>
                        <span class="sr-only">Information about input options for miles</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about input options for miles" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content='Valid input options for "miles" include any number that is one or greater and 24 or less.'>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                        <input type="number" min="1" max="24" value="3" id="distance" step="0.01" class="form-control" required autofocus>
                        <div class="invalid-feedback"><span id="distanceError"></span></div>
                    </div>

                </li>
                <li>
                    <p class="run-time">How much time will you spend running?</p>
                    <label for="runMinutes">Minutes</label>
                    <span class="sr-only">Information about input options for minutes</span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about input options for minutes" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content='Valid input options for "minutes" include any number that is one or greater and 300 or less.'>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2">
                        <input type="number" min="1" max="300" value="60" id="runMinutes" step="1" class="form-control" required>
                        <div class="invalid-feedback"><span id="runMinutesError"></span></div>
                    </div>

                    <label class="run-seconds" for="runSeconds">Seconds</label>
                    <span class="sr-only">Information about input options for seconds</span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about input options for seconds" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content='Valid input options for "seconds" include any number that is zero or greater and 59 or less.'>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2">
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
            <button id="btnSubmitRunSpeed" name="btnsubmitrunspeed" class="btn btn-primary" disabled>Submit</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="/js/runspeedcalculator.js"></script>