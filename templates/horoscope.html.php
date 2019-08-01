<link rel="stylesheet" href="/css/horoscope.css">
<input id="language" type="hidden" value="<?= $language ?>">
<input id="errorEnterA" type="hidden" value="<?= $content['errorEnterA'] ?>">
<input id="todaysHoroscopes" type="hidden" value="<?= $content['todaysHoroscopes'] ?>">
<input id="someoneFeeling" type="hidden" value="<?= $content['someoneFeeling'] ?>">
<input id="stayOutWay" type="hidden" value="<?= $content['stayOutWay'] ?>">
<input id="dont" type="hidden" value="<?= $content['dont'] ?>">
<input id="publicEmbarrassing" type="hidden" value="<?= $content['publicEmbarrassing'] ?>">
<input id="controlUrge" type="hidden" value="<?= $content['controlUrge'] ?>">
<input id="instead" type="hidden" value="<?= $content['instead'] ?>">
<input id="tooMany" type="hidden" value="<?= $content['tooMany'] ?>">
<input id="exhausted" type="hidden" value="<?= $content['exhausted'] ?>">
<input id="aLovedOne" type="hidden" value="<?= $content['aLovedOne'] ?>">
<input id="dontBeFlattered" type="hidden" value="<?= $content['dontBeFlattered'] ?>">
<input id="inPrivate" type="hidden" value="<?= $content['inPrivate'] ?>">
<input id="avoid" type="hidden" value="<?= $content['avoid'] ?>">
<input id="neverLoan" type="hidden" value="<?= $content['neverLoan'] ?>">
<input id="poorCredit" type="hidden" value="<?= $content['poorCredit'] ?>">
<input id="goodDay" type="hidden" value="<?= $content['goodDay'] ?>">
<input id="mayReceive" type="hidden" value="<?= $content['mayReceive'] ?>">
<input id="secretAdmirer" type="hidden" value="<?= $content['secretAdmirer'] ?>">
<input id="organize" type="hidden" value="<?= $content['organize'] ?>">
<input id="better" type="hidden" value="<?= $content['better'] ?>">
<input id="goodFriend" type="hidden" value="<?= $content['goodFriend'] ?>">
<input id="buyNew" type="hidden" value="<?= $content['buyNew'] ?>">
<input id="thankFriend" type="hidden" value="<?= $content['thankFriend'] ?>">
<input id="instructionsHidden" type="hidden" value="<?= $content['instructions'] ?>">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div class="container fill-height">
    <h2 id="horoscope-heading2" tabindex="-1"><?= $content['instructions'] ?></h2>
    <div id="divHoroscopeResults" style="display: none;">
        <p id="horoscope-paragraph"></p>
        <button id="btn-reset-horoscope" class="btn btn-secondary"><?= $content['btnReset'] ?></button>
    </div>
    <form id="UserInputForm" action="" method="" class="needs-validation" novalidate>
        <div id="largeScreenDisplay">
            <div id="user-input-table" class="container pl-0">
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" class="label col-form-label" for="one"><?= $content['adjective'] ?></label>
                        <input class="form-control" title="<?= $content['enterAdjective'] ?>" type="text" maxlength="12" size="12"
                               id="one" name="one" value="" placeholder="<?= $content['exampleTall'] ?>" pattern="[A-Za-z]{1,12}" required
                               autofocus>
                        <div class="invalid-feedback"><span id="oneError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" class="label col-form-label" for="two"><?= $content['presentVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterPresentVerb'] ?>" type="text" maxlength="12"
                               size="12" id="two" name="two" value="" placeholder="<?= $content['exampleDrink'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="twoError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="three"><?= $content['presentVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterPresentVerb'] ?>" type="text" maxlength="12"
                               size="12" id="three" name="three" value="" placeholder="<?= $content['exampleCatch'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="threeError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="four"><?= $content['presentVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterPresentVerb'] ?>" type="text" maxlength="12"
                               size="12" id="four" name="four" value="" placeholder="<?= $content['exampleFreeze'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="fourError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="five"><?= $content['ingVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterVerbing'] ?>" type="text" maxlength="12"
                               size="12" id="five" name="five" value="" placeholder="<?= $content['exampleFighting'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="fiveError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="six"><?= $content['pluralNoun'] ?></label>
                        <input class="form-control" title="<?= $content['enterPluralNoun'] ?>" type="text" maxlength="12" size="12"
                               id="six" name="six" value="" placeholder="<?= $content['exampleMen'] ?>" pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="sixError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="seven"><?= $content['adjective'] ?></label>
                        <input class="form-control" title="<?= $content['enterAdjective'] ?>" type="text" maxlength="12" size="12"
                               id="seven" name="seven" value="" placeholder="<?= $content['exampleFat'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="sevenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="eight"><?= $content['presentVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterPresentVerb'] ?>" type="text" maxlength="12"
                               size="12" id="eight" name="eight" value="" placeholder="<?= $content['exampleRun'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="eightError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="nine"><?= $content['ingVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterVerbing'] ?>" type="text" maxlength="12"
                               size="12" id="nine" name="nine" value="" placeholder="<?= $content['exampleLifting'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="nineError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="ten"><?= $content['pluralNoun'] ?></label>
                        <input class="form-control" title="<?= $content['enterPluralNoun'] ?>" type="text" maxlength="12" size="12"
                               id="ten" name="ten" value="" placeholder="<?= $content['exampleDogs'] ?>" pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="tenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="eleven"><?= $content['adjective'] ?></label>
                        <input class="form-control" title="<?= $content['enterAdjective'] ?>" type="text" maxlength="12" size="12"
                               id="eleven" name="eleven" value="" placeholder="<?= $content['exampleHarry'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="elevenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="twelve"><?= $content['animal'] ?></label>
                        <input class="form-control" title="<?= $content['typeAnimal'] ?>" type="text" maxlength="12" size="12"
                               id="twelve" name="twelve" value="" placeholder="<?= $content['exampleElephant'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="twelveError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="thirteen"><?= $content['presentVerb'] ?></label>
                        <input class="form-control" title="<?= $content['enterPresentVerb'] ?>" type="text" maxlength="12"
                               size="12" id="thirteen" name="thirteen" value="" placeholder="<?= $content['exampleSew'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="thirteenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="fourteen"><?= $content['singularNoun'] ?></label>
                        <input class="form-control" title="<?= $content['enterSingularNoun'] ?>" type="text" maxlength="12" size="12"
                               id="fourteen" name="fourteen" value="" placeholder="<?= $content['exampleSpaghetti'] ?>"
                               pattern="[A-Za-z]{1,12}" required>
                        <div class="invalid-feedback"><span id="fourteenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="fifteen"><?= $content['pluralNoun'] ?></label>
                        <input class="form-control" title="<?= $content['enterPluralNoun'] ?>" type="text" maxlength="12" size="12"
                               id="fifteen" name="fifteen" value="" placeholder="<?= $content['exampleMen'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="fifteenError"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="label col-form-label" for="sixteen"><?= $content['pluralNoun'] ?></label>
                        <input class="form-control" title="<?= $content['enterPluralNoun'] ?>" type="text" maxlength="12" size="12"
                               id="sixteen" name="sixteen" value="" placeholder="<?= $content['exampleCans'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="sixteenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="seventeen"><?= $content['number'] ?></label>
                        <input class="form-control" title="<?= $content['enterNumber'] ?>" type="text" maxlength="12" size="12"
                               id="seventeen" name="seventeen" value="" placeholder="<?= $content['example12'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="seventeenError"></span></div>
                    </div>
                    <div class="col">
                        <label class="label col-form-label" for="eighteen"><?= $content['pluralNoun'] ?></label>
                        <input class="form-control" title="<?= $content['enterPluralNoun'] ?>" type="text" maxlength="12" size="12"
                               id="eighteen" name="eighteen" value="" placeholder="<?= $content['exampleWomen'] ?>" pattern="[A-Za-z]{1,12}"
                               required>
                        <div class="invalid-feedback"><span id="eighteenError"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <input id="btn-submit-horoscope" name="submitBtn" class="btn btn-primary btn-lg" type="submit"
               value="<?= $content['getHoroscope'] ?>">
    </form>
    <div class="resolutionSizeCheck"></div>
</div>
<script type="text/javascript" src="/js/Utils.js"></script>
<script type="text/javascript" src="/js/horoscope.js"></script>