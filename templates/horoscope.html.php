<link rel="stylesheet" href="/css/horoscope.css">
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3">Horoscopes Generator</h1>
    </div>
</div>
<div class="container fill-height">
    <h2 id="horoscope-heading2" tabindex="-1">The fields below have been pre-filled out
      for you, but you can change the values to what every you want. The program will use the values to determine the
      horoscopes.</h2>
    <div id="divHoroscopeResults">
      <p id="horoscope-paragraph"></p>
      <button id="btn-reset-horoscope" class="btn btn-secondary">Reset</button>
    </div>
    <form id="UserInputForm" action="" method="">
      <div id="largeScreenDisplay">
        <div id="user-input-table" class="container">
            <div class="row">
              <div class="col">
                <label class="label col-form-label" class="label col-form-label" for="one">Adjective:</label>
                <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12" id="one"
                  name="one" value="" placeholder="Example: tall" required>
              </div>
              <div class="col">
                <label class="label col-form-label" class="label col-form-label" for="two">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="two"
                  name="two" value="" placeholder="Example: drink" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="three">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="three"
                  name="three" value="" placeholder="Example: catch" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="four">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="four"
                  name="four" value="" placeholder="Example: freeze" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="five">Verb ending with ing:</label>
                <input class="form-control" title="Enter a verb that ends with ing" type="text" maxlength="12" size="12"
                  id="five" name="five" value="" placeholder="Example: fighting" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="six">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="six"
                  name="six" value="" placeholder="Example: men" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="seven">Adjective:</label>
                <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12" id="seven"
                  name="seven" value="" placeholder="Example: fat" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="eight">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="eight"
                  name="eight" value="" placeholder="Example: run" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="nine">Verb ending with ing:</label>
                <input class="form-control" title="Enter a verb that ends with ing" type="text" maxlength="12" size="12"
                  id="nine" name="nine" value="" placeholder="Example: lifting" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="ten">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="ten"
                  name="ten" value="" placeholder="Example: dogs" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="eleven">Adjective:</label>
                <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12" id="eleven"
                  name="eleven" value="" placeholder="Example: harry" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="twelve">Animal:</label>
                <input class="form-control" title="Enter a type of animal" type="text" maxlength="12" size="12" id="twelve"
                  name="twelve" value="" placeholder="Example: elephant" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="thirteen">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="thirteen"
                  name="thirteen" value="" placeholder="Example: sew" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="fourteen">Singular Noun:</label>
                <input class="form-control" title="Enter a singular noun" type="text" maxlength="12" size="12" id="fourteen"
                  name="fourteen" value="" placeholder="Example: spaghetti" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="fifteen">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="fifteen"
                  name="fifteen" value="" placeholder="Example: men" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="sixteen">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="sixteen"
                  name="sixteen" value="" placeholder="Example: cans" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="seventeen">Number:</label>
                <input class="form-control" title="Enter a number" type="text" maxlength="12" size="12" id="seventeen"
                  name="seventeen" value="" placeholder="Example: 12" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="eighteen">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="eighteen"
                  name="eighteen" value="" placeholder="Example: women" required>
              </div>
            </div>
          </div>
        </div>


        <div id="smallScreenDisplay">
        <div id="user-input-table" class="container">
            <div class="row">
              <div class="col">
                <label class="label col-form-label" class="label col-form-label" for="one">Adjective:</label>
                <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12" id="one"
                  name="one" value="" placeholder="Example: tall" required>
              </div>
              <div class="col">
                <label class="label col-form-label" class="label col-form-label" for="two">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="two"
                  name="two" value="" placeholder="Example: drink" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="three">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="three"
                  name="three" value="" placeholder="Example: catch" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="four">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="four"
                  name="four" value="" placeholder="Example: freeze" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="five">Verb ending with ing:</label>
                <input class="form-control" title="Enter a verb that ends with ing" type="text" maxlength="12" size="12"
                  id="five" name="five" value="" placeholder="Example: fighting" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="six">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="six"
                  name="six" value="" placeholder="Example: men" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="seven">Adjective:</label>
                <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12" id="seven"
                  name="seven" value="" placeholder="Example: fat" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="eight">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="eight"
                  name="eight" value="" placeholder="Example: run" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="nine">Verb ending with ing:</label>
                <input class="form-control" title="Enter a verb that ends with ing" type="text" maxlength="12" size="12"
                  id="nine" name="nine" value="" placeholder="Example: lifting" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="ten">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="ten"
                  name="ten" value="" placeholder="Example: dogs" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="eleven">Adjective:</label>
                <input class="form-control" title="Enter an adjective" type="text" maxlength="12" size="12" id="eleven"
                  name="eleven" value="" placeholder="Example: harry" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="twelve">Animal:</label>
                <input class="form-control" title="Enter a type of animal" type="text" maxlength="12" size="12" id="twelve"
                  name="twelve" value="" placeholder="Example: elephant" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="thirteen">Present Tense Verb:</label>
                <input class="form-control" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="thirteen"
                  name="thirteen" value="" placeholder="Example: sew" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="fourteen">Singular Noun:</label>
                <input class="form-control" title="Enter a singular noun" type="text" maxlength="12" size="12" id="fourteen"
                  name="fourteen" value="" placeholder="Example: spaghetti" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="fifteen">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="fifteen"
                  name="fifteen" value="" placeholder="Example: men" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="sixteen">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="sixteen"
                  name="sixteen" value="" placeholder="Example: cans" required>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="label col-form-label" for="seventeen">Number:</label>
                <input class="form-control" title="Enter a number" type="text" maxlength="12" size="12" id="seventeen"
                  name="seventeen" value="" placeholder="Example: 12" required>
              </div>
              <div class="col">
                <label class="label col-form-label" for="eighteen">Plural Noun:</label>
                <input class="form-control" title="Enter a plural noun" type="text" maxlength="12" size="12" id="eighteen"
                  name="eighteen" value="" placeholder="Example: women" required>
              </div>
            </div>
            </div>
          </div>
      <input id="btn-submit-horoscope" name="submitBtn" class="btn btn-primary btn-lg" type="submit" value="Get Horoscope">
    </form>
    <div class="resolutionSizeCheck"></div>
</div>
<script type="text/javascript" src="/js/Utils.js"></script>
<script type="text/javascript" src="/js/horoscope.js"></script>