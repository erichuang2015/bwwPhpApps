<!-- <link rel="stylesheet" href="/css/gladiator.css"> -->
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Distance Converter</h1>
    </div>
</div>
<div id="divDistanceConverter" class="container fill-height">
    <p>Given the fact that there are 12 inches in a foot, and 5,280 feet in a mile, and one eighth of a mile in
        a furlong, we can compute the distance for a selected unit of feet, miles, or furlongs for a given
        number of inches.</p><br>
    <p id=paraInstructions>Begin by choosing whether you want to convert inches to feet, miles, or furlongs.</p><br>

    <form id="form-measurement" name="form-measurement">
        <fieldset>
            <input id="feet" name="rbSelectMetric" type="radio" value="feet" checked>
            <label for="feet">Feet</label>
            <input id="miles" name="rbSelectMetric" type="radio" value="miles">
            <label for="miles">Miles</label>
            <input id="furlongs" name="rbSelectMetric" type="radio" value="furlongs">
            <label for="furlongs">Furlongs</label>
            <input id="btn-submit-Dist-Convert" type="submit" value="Submit" name="btn-submit-Dist-Convert" />
        </fieldset>
    </form>

    <div id="inchesInputArea">
        <label for="inputInches">Inches:</label>
        <input id="inputInches" name="inputInches" class="" type="text" /><span id="inputError" class="input-error"></span>
        <input id="btnInputSubmit" name="btnInputSubmit" type="submit" value="Submit" />
        <label for="resultTxt">Result:</label>
        <input id="resultTxt" name="inputInches" type="text" readonly />
        <input id="btnReset" type="reset" value="Reset" />
    </div>
</div>
<script type="text/javascript" src="/js/distanceconverter.js"></script>