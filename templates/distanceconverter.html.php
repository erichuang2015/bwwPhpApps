<link rel="stylesheet" href="/css/distanceconverter.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="instructions1" type="hidden" value="<?= $content['instructions1'] ?>">
<input id="instructions2" type="hidden" value="<?= $content['instructions2'] ?>">
<input id="errorEnterNum" type="hidden" value="<?= $content['errorEnterNum'] ?>">
<input id="errorNumGreaterZero" type="hidden" value="<?= $content['errorNumGreaterZero'] ?>">
<input id="errorNotNum" type="hidden" value="<?= $content['errorNotNum'] ?>">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div id="divDistanceConverter" class="container fill-height">
    <p><?= $content['infoTxt'] ?></p>
    <p id=paraInstructions><?= $content['instructions1'] ?></p>

    <form id="form-measurement" name="form-measurement">
        <ul>
            <li>
                <input id="feet" name="rbSelectMetric" type="radio" value="feet" checked>
                <label class="label col-form-label" for="feet"><?= $content['lblFeet'] ?></label>
            </li>
            <li>
                <input id="<?= $content['lblMiles'] ?>" name="rbSelectMetric" type="radio" value="miles">
                <label class="label col-form-label" for="miles"><?= $content['lblMiles'] ?></label>
            </li>
            <li>
                <input id="furlongs" name="rbSelectMetric" type="radio" value="furlongs">
                <label class="label col-form-label" for="furlongs"><?= $content['lblFurlongs'] ?></label>
            </li>
        </ul>
        <input id="btn-submit-Dist-Convert" type="submit" value="<?= $content['btnSubmit'] ?>" name="btn-submit-Dist-Convert"
            class="btn btn-primary" />
    </form>

    <form id="inchesInputForm" class="needs-validation" style="display: none;" novalidate>
        <div class="form-group">
            <label class="label col-form-label" for="inputInches"><?= $content['lblInches'] ?></label>
            <input id="inputInches" name="inputInches" class="form-control" type="text" required autofocus />
            <div class="invalid-feedback"><span id="inputInchesError"></span></div>
        </div>
        <div class="form-group">
            <label class="label col-form-label" for="resultTxt"><?= $content['lblResult'] ?></label>
            <span id="resultTxt" name="inputInches" class="form-control" type="text" readonly></span>
        </div>
        <input id="btnInputSubmit" name="btnInputSubmit" type="submit" value="<?= $content['btnSubmit'] ?>" class="btn btn-primary"
            disabled />
        <input id="btnReset" type="reset" value="<?= $content['btnReset'] ?>" class="btn btn-secondary" />
    </form>
</div>
<script type="text/javascript" src="/js/distanceconverter.js"></script>