<link rel="stylesheet" href="/css/horoscope.css">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Horoscopes Generator</h1>
    </div>
</div>
<div class="container fill-height">
    <h2 id="horoscope-heading2" tabindex="-1">Fill in the blanks below to generate your horoscope.</h2>
    <div id="divHoroscopeResults" style="display: none;">
        <p id="horoscope-paragraph"></p>
        <button id="btn-reset-horoscope" class="btn btn-secondary">Reset</button>
    </div>
    <form id="UserInputForm" action="" method="" class="needs-validation" novalidate>
        <div id="largeScreenDisplay">
            <div id="user-input-table" class="container pl-0">
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" class="label col-form-label" for="one">Adjective:</label>
                        <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12"
                               id="one" name="one" value="" placeholder="Example: tall" pattern="[A-Za-z]{1,12}" required
                               autofocus>
                        <div class="invalid-feedback"><span id="oneError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" class="label col-form-label" for="two">Present Tense
                            Verb:</label>
                        <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12"
                               size="12" id="two" name="two" value="" placeholder="Example: drink" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="twoError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="three">Present Tense Verb:</label>
                        <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12"
                               size="12" id="three" name="three" value="" placeholder="Example: catch"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="threeError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="four">Present Tense Verb:</label>
                        <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12"
                               size="12" id="four" name="four" value="" placeholder="Example: freeze"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="fourError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="five">Verb ending with ing:</label>
                        <input class="form-control" title="Enter a verb that ends with ing" type="text" maxlength="12"
                               size="12" id="five" name="five" value="" placeholder="Example: fighting"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="fiveError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="six">Plural Noun:</label>
                        <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12"
                               id="six" name="six" value="" placeholder="Example: men" pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="sixError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="seven">Adjective:</label>
                        <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12"
                               id="seven" name="seven" value="" placeholder="Example: fat" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="sevenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="eight">Present Tense Verb:</label>
                        <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12"
                               size="12" id="eight" name="eight" value="" placeholder="Example: run"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="eightError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="nine">Verb ending with ing:</label>
                        <input class="form-control" title="Enter a verb that ends with ing" type="text" maxlength="12"
                               size="12" id="nine" name="nine" value="" placeholder="Example: lifting"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="nineError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="ten">Plural Noun:</label>
                        <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12"
                               id="ten" name="ten" value="" placeholder="Example: dogs" pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="tenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="eleven">Adjective:</label>
                        <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12"
                               id="eleven" name="eleven" value="" placeholder="Example: harry" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="elevenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="twelve">Animal:</label>
                        <input class="form-control" title="Enter a type of animal" type="text" maxlength="12" size="12"
                               id="twelve" name="twelve" value="" placeholder="Example: elephant" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="twelveError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="thirteen">Present Tense Verb:</label>
                        <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12"
                               size="12" id="thirteen" name="thirteen" value="" placeholder="Example: sew"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="thirteenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="fourteen">Singular Noun:</label>
                        <input class="form-control" title="Enter a singular noun" type="text" maxlength="12" size="12"
                               id="fourteen" name="fourteen" value="" placeholder="Example: spaghetti"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="fourteenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="fifteen">Plural Noun:</label>
                        <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12"
                               id="fifteen" name="fifteen" value="" placeholder="Example: men" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="fifteenError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="sixteen">Plural Noun:</label>
                        <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12"
                               id="sixteen" name="sixteen" value="" placeholder="Example: cans" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="sixteenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="seventeen">Number:</label>
                        <input class="form-control" title="Enter a number" type="text" maxlength="12" size="12"
                               id="seventeen" name="seventeen" value="" placeholder="Example: 12" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="seventeenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="eighteen">Plural Noun:</label>
                        <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12"
                               id="eighteen" name="eighteen" value="" placeholder="Example: women" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="eighteenError"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <input id="btn-submit-horoscope" name="submitBtn" class="btn btn-primary btn-lg" type="submit"
               value="Get Horoscope">
    </form>
    <div class="resolutionSizeCheck"></div>
</div>
<script type="text/javascript" src="/js/Utils.js"></script>
<script type="text/javascript" src="/js/horoscope.js"></script>