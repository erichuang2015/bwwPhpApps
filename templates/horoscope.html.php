<!-- <link rel="stylesheet" href="/css/gladiator.css"> -->
<div class="jumbotron fill-height">
  <div class="container fill-height">
    <h1 class="display-3">Horoscopes Generator</h1>
    <h2 id="horoscope-heading2" class="horoscope-heading2" tabindex="-1">The fields below have been pre-filled out
      for you, but you can change the values to what every you want. The program will use the values to determine the
      horoscopes.</h2>
    <div id="divHoroscopeResults">
      <p id="horoscope-paragraph" class="horoscope-paragraph"></p>
      <button id="btn-reset-horoscope" class="resetBtn">Reset</button>
    </div>
    <div id="UserInputForm" class="inputTblFormat">
      <table id="user-input-table">
        <tbody>
          <tr>
            <td>
              <label for="one">Adjective</label>
              <input class="horoscope-input" title="Enter an adjective" type="text" maxlength="12" size="12" id="one"
                name="one" value="" placeholder="Example: tall" required>
            </td>
            <td>
              <label for="two">Present Tense Verb</label>
              <input class="horoscope-input" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="two"
                name="two" value="" placeholder="Example: drink" required>
            </td>
            <td>
              <label for="three">Present Tense Verb</label>
              <input class="horoscope-input" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="three"
                name="three" value="" placeholder="Example: catch" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="four">Present Tense Verb</label>
              <input class="horoscope-input" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="four"
                name="four" value="" placeholder="Example: freeze" required>
            </td>
            <td>
              <label for="five">Verb ending with ing</label>
              <input class="horoscope-input" title="Enter a verb that ends with ing" type="text" maxlength="12" size="12"
                id="five" name="five" value="" placeholder="Example: fighting" required>
            </td>
            <td>
              <label for="six">Plural Noun</label>
              <input class="horoscope-input" title="Enter a plural noun" type="text" maxlength="12" size="12" id="six"
                name="six" value="" placeholder="Example: men" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="seven">Adjective</label>
              <input class="horoscope-input" title="Enter an adjective" type="text" maxlength="12" size="12" id="seven"
                name="seven" value="" placeholder="Example: fat" required>
            </td>
            <td>
              <label for="eight">Present Tense Verb</label>
              <input class="horoscope-input" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="eight"
                name="eight" value="" placeholder="Example: run" required>
            </td>
            <td>
              <label for="nine">Verb ending with ing</label>
              <input class="horoscope-input" title="Enter a verb that ends with ing" type="text" maxlength="12" size="12"
                id="nine" name="nine" value="" placeholder="Example: lifting" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="ten">Plural Noun</label>
              <input class="horoscope-input" title="Enter a plural noun" type="text" maxlength="12" size="12" id="ten"
                name="ten" value="" placeholder="Example: dogs" required>
            </td>
            <td>
              <label for="eleven">Adjective</label>
              <input class="horoscope-input" title="Enter an adjective" type="text" maxlength="12" size="12" id="eleven"
                name="eleven" value="" placeholder="Example: harry" required>
            </td>
            <td>
              <label for="twelve">Animal</label>
              <input class="horoscope-input" title="Enter a type of animal" type="text" maxlength="12" size="12" id="twelve"
                name="twelve" value="" placeholder="Example: elephant" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="thirteen">Present Tense Verb</label>
              <input class="horoscope-input" title="Enter a present tense verb" type="text" maxlength="12" size="12" id="thirteen"
                name="thirteen" value="" placeholder="Example: sew" required>
            </td>
            <td>
              <label for="fourteen">Singular Noun</label>
              <input class="horoscope-input" title="Enter a singular noun" type="text" maxlength="12" size="12" id="fourteen"
                name="fourteen" value="" placeholder="Example: spaghetti" required>
            </td>
            <td>
              <label for="fifteen">Plural Noun</label>
              <input class="horoscope-input" title="Enter a plural noun" type="text" maxlength="12" size="12" id="fifteen"
                name="fifteen" value="" placeholder="Example: men" required>
            </td>
          </tr>
          <tr>
            <td>
              <label for="sixteen">Plural Noun</label>
              <input class="horoscope-input" title="Enter a plural noun" type="text" maxlength="12" size="12" id="sixteen"
                name="sixteen" value="" placeholder="Example: cans" required>
            </td>
            <td>
              <label for="seventeen">Number</label>
              <input class="horoscope-input" title="Enter a number" type="text" maxlength="12" size="12" id="seventeen"
                name="seventeen" value="" placeholder="Example: 12" required>
            </td>
            <td>
              <label for="eighteen">Plural Noun</label>
              <input class="horoscope-input" title="Enter a plural noun" type="text" maxlength="12" size="12" id="eighteen"
                name="eighteen" value="" placeholder="Example: women" required>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <button id="btn-submit-horoscope" name="submitBtn" class="submitBtn">Submit</button>
      <br>
    </div>
  </div>
</div>
<script type="text/javascript" src="/js/horoscope.js"></script>