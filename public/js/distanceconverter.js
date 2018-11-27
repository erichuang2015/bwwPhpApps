/*jshint esversion: 6 */
$(document).ready(function () {
    "use strict";
    let myDistanceConverter;
    $("#inchesInputArea").hide();

    $("#inputInches").on("change", function (e) {
        var inputInchTxt = $("#inputInches").val();
        inputInchTxt = removeCommas(inputInchTxt);
        inputInchTxt = addCommas(inputInchTxt);
        $("#inputInches").val(inputInchTxt);
    });

    $("#btn-submit-Dist-Convert").on("click keyup", function (e) {
        e.preventDefault();
        var selectedMetric = $("#form-measurement input:checked").attr("id");
        myDistanceConverter = new DistanceConverter(selectedMetric);
        $("#form-measurement").hide();
        $("#paraInstructions").text(
            "Enter the number of inches you would like to convert to " +
            myDistanceConverter.unitOfMeasure.toString() + ".");
        $("#inchesInputArea").show();
    });

    $("#btnInputSubmit").on("click keyup", function (e) {
        e.preventDefault();
        let numInches = $("#inputInches").val();
        numInches = numInches.toString();
        numInches = removeCommas(numInches);
        numInches = Number.parseFloat(numInches);
        if (isNaN(numInches)) {
            $("#inputError").text("You did not enter a number.  Please try again.").show();
            $("#resultTxt").val("");
            return;
        }
        else {
            $("#inputError").text("").hide();
        }
        myDistanceConverter.numInches = numInches;
        let result;
        switch (myDistanceConverter.selectedMetric.toString()) {
            case "feet":
                myDistanceConverter.numOfFeet = myDistanceConverter.calcFeet();
                result = myDistanceConverter.numOfFeet;
                break;
            case "miles":
                myDistanceConverter.numOfFeet = myDistanceConverter.calcFeet();
                myDistanceConverter.numOfMiles = myDistanceConverter.calcMiles();
                result = myDistanceConverter.numOfMiles;
                break;
            case "furlongs":
                myDistanceConverter.numOfFeet = myDistanceConverter.calcFeet();
                myDistanceConverter.numOfMiles = myDistanceConverter.calcMiles();
                result = myDistanceConverter.calcFurlongs();
                break;
        }
        result = roundTwoDecimals(result);
        result = addCommas(result.toString());
        $("#resultTxt").val(result.toString() + " " + myDistanceConverter.selectedMetric.toString());
    });

    $("#btnReset").on("click keyup", function (e) {
        $("#inchesInputArea").hide();
        $("#form-measurement").show();
        $("#inputInches").val("");
        $("#resultTxt").val("");
        $("#feet, #miles, #furlongs").removeAttr("checked");
    });
});


class DistanceConverter {
    constructor(metricId) {
        "use strict";
        this.selectedMetric = metricId;
        this.numInches = 0;
        this.numOfFeet = 0;
        this.numOfMiles = 0;
        this.numOfFurlongs = 0;
        this.inchesPerFoot = 12;
        this.feetPerMile = 5280;
        this.furlongsPerMile = (1 / 8);
        return this;
    }
    get unitOfMeasure() {
        return this.selectedMetric;
    }
    set unitOfMeasure(metric) {
        this.selectedMetric = metric;
    }
    get numberOfInches() {
        return this.numInches;
    }
    set numOfInches(inches) {
        this.numInches = inches
    }
    get getNumOfFeet() {
        return this.numOfFeet;
    }
    set setNumOfFeet(feet) {
        this.numOfFeet = feet;
    }
    get getNumOfMiles() {
        return this.numOfMiles;
    }
    set setNumOfMiles(miles) {
        this.numOfMiles = miles;
    }
    get getNumOfFurlongs() {
        return this.numOfFurlongs;
    }
    set setNumOfFurlongs(furlongs) {
        this.numOfFurlongs = furlongs;
    }

    calcFeet() {
        return this.numInches / this.inchesPerFoot;
    }

    calcMiles() {
        this.numOfMiles = this.numOfFeet / this.feetPerMile;
        return this.numOfMiles;
    }

    calcFurlongs() {
        this.numOfFurlongs = this.numOfMiles / this.furlongsPerMile;
        return this.numOfFurlongs;
    }
}
