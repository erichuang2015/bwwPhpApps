<link rel="stylesheet" href="/css/distanceconverter.css">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Distance Converter</h1>
    </div>
</div>
<div id="divDistanceConverter" class="container fill-height">
    <p>Given the fact that there are 12 inches in a foot, and 5,280 feet in a mile, and one eighth of a mile in
        a furlong, we can compute the distance for a selected unit of feet, miles, or furlongs for a given
        number of inches.</p>
    <p id=paraInstructions>Begin by choosing whether you want to convert inches to feet, miles, or furlongs.</p>

    <form id="form-measurement" name="form-measurement">
        <ul>
            <li>
                <input id="feet" name="rbSelectMetric" type="radio" value="feet" checked>
                <label class="label col-form-label" for="feet">Feet</label>
            </li>
            <li>
                <input id="miles" name="rbSelectMetric" type="radio" value="miles">
                <label class="label col-form-label" for="miles">Miles</label>
            </li>
            <li>
                <input id="furlongs" name="rbSelectMetric" type="radio" value="furlongs">
                <label class="label col-form-label" for="furlongs">Furlongs</label>
            </li>
        </ul>
        <input id="btn-submit-Dist-Convert" type="submit" value="Submit" name="btn-submit-Dist-Convert"
            class="btn btn-primary" />
    </form>

    <form id="inchesInputForm" class="needs-validation" style="display: none;" novalidate>
        <div class="form-group">
            <label class="label col-form-label" for="inputInches">Inches:</label>
            <input id="inputInches" name="inputInches" class="form-control" type="text" required autofocus />
            <div class="invalid-feedback"><span id="inputInchesError"></span></div>
        </div>
        <div class="form-group">
            <label class="label col-form-label" for="resultTxt">Result:</label>
            <span id="resultTxt" name="inputInches" class="form-control" type="text" readonly></span>
        </div>
        <input id="btnInputSubmit" name="btnInputSubmit" type="submit" value="Submit" class="btn btn-primary"
            disabled />
        <input id="btnReset" type="reset" value="Reset" class="btn btn-secondary" />
    </form>
</div>
<script type="text/javascript" src="/js/distanceconverter.js"></script>