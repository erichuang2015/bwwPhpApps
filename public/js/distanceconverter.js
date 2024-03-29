/*jshint esversion: 6 */
$(document).ready(function () {
    "use strict";
    let myDistanceConverter;
    $("#inchesInputForm").hide();

    $("#inputInches").on("change blur keyup", function (e) {
        var inputInchTxt = $("#inputInches").val();
        var inputInches = removeCommas(inputInchTxt);
        inputInchTxt = addCommas(inputInches);
        $("#inputInches").val(inputInchTxt);

        if (isNaN(inputInches)) {
            $("#inputInches").removeClass("is-valid");
            $("#inputInches").addClass("is-invalid");
            let errorEnterNum = $("#errorEnterNum").val();
            $("#inputInchesError").text(errorEnterNum);
            $("#btnInputSubmit").attr("disabled", "true");
        } else if (parseFloat(Number(inputInches)) <= 0) {
            $("#inputInches").removeClass("is-valid");
            $("#inputInches").addClass("is-invalid");
            let errorNumGreaterZero = $("#errorNumGreaterZero").val();
            $("#inputInchesError").text(errorNumGreaterZero);
            $("#btnInputSubmit").attr("disabled", "true");
        } else {
            $("#inputInches").removeClass("is-invalid");
            $("#inputInches").addClass("is-valid");
            $("#inputInchesError").text("");
            $("#btnInputSubmit").removeAttr("disabled");
        }
    });

    $("#btn-submit-Dist-Convert").on("click keyup", function (e) {
        e.preventDefault();
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            let selectedMetric = $("#form-measurement input:checked").attr("id");
            myDistanceConverter = new DistanceConverter(selectedMetric);
            $("#form-measurement").hide();
            let instructions2 = $("#instructions2").val();
            $("#paraInstructions").text(
                instructions2 + " " +
                myDistanceConverter.unitOfMeasure.toString().toLocaleLowerCase() + ".");
            $("#inchesInputForm").show();
        }
    });

    $("#btnInputSubmit").on("click keyup", function (e) {
        e.preventDefault();
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            let numInches = $("#inputInches").val();
            numInches = numInches.toString();
            numInches = removeCommas(numInches);
            numInches = Number.parseFloat(numInches);
            if (isNaN(numInches)) {
                let errorNotNum = $("#errorNotNum").val();
                $("#inputError").text(errorNotNum).show();
                $("#resultTxt").text("");
                return;
            } else {
                $("#inputError").text("").hide();
            }
            myDistanceConverter.numInches = numInches;
            let result;
            switch (myDistanceConverter.selectedMetric.toString().toLocaleLowerCase()) {
                case "feet":
                    myDistanceConverter.numOfFeet = myDistanceConverter.calcFeet();
                    result = myDistanceConverter.numOfFeet;
                    break;
                case "miles":
                case "millas":
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
            $("#resultTxt").text(result.toString() + " " + myDistanceConverter.selectedMetric.toString());
        }
    });

    $("#btnReset").on("click keyup", function (e) {
        e.preventDefault();
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            $("#inchesInputForm").hide();
            let instructions1 = $("#instructions1").val();
            $("#paraInstructions").text(instructions1);
            $("#form-measurement").show();
            $("#inputInches").val("");
            $("#resultTxt").text("");
            $("#inputInches").removeClass("is-invalid");
            $("#inputInches").removeClass("is-valid");
            $("#inputInchesError").text("");
            $("#btnInputSubmit").attr("disabled", "true");
        }
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
