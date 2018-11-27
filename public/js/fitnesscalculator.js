/*jshint esversion: 6 */
$(document).ready(function () {
    let myFitnessCalculator;
    $("#divBMIInputPg").hide();
    $("#divSexInputPg").hide();
    $("#divCalInstructions").hide();
    $("#ageInputError").hide();
    $("#age").val("40");
    $("#numMM1").val(2);
    $("#numMM2").val(2);
    $("#divbodFatResults").hide();
    $("#spanConsistentReq").removeClass("span-consistent-req");
    $("#btnSubmitFitCalc").on("click keyup", function (e) {
        e.preventDefault();
        let selectedMeasurementId = $("#divFitnessCalculator input:checked").attr("id");
        // Do more stuff like change the interface to get input and give instructions
        switch (selectedMeasurementId) {
            case "bodyFat":
                $("#divFitStartPg").hide();
                $("#divSexInputPg").show();
                break;
            case "bmi":
                $("#divFitStartPg").hide();
                $("#divBMIInputPg").show();
                break;
        }
    });

    $("#btnSubmitSexSelect").on("click keyup", function (e) {
        e.preventDefault();
        $("#ageInputError").text("").hide();
        let sex = $("#form-sexSelect input:checked").val();
        let age = $("#age").val();
        age = parseInt(age);
        if (isNaN(age)) {
            $("#ageInputError").text("You did not enter a number.  Please try again.").show();
            return;
        }
        if (age < 18 || age > 140) {
            $("#ageInputError").text("You did not enter a number within the valid range.  The age must be greater than 17 and less than 141.  Please try again.").show();
            return;
        }
        $("#ageInputError").text("").hide();
        myFitnessCalculator = new FitnessCalculator(sex, age);
        $("#divSexInputPg").hide();
        $("#divCalInstructions").show();
    });

    $("#btnSubmitNumMM").on("click keyup", function (e) {
        e.preventDefault();
        $("#spanConsistentReq").removeClass("span-consistent-req");
        let firstReading = $("#numMM1").val();
        let secondReading = $("#numMM2").val();
        firstReading = parseInt(firstReading);
        secondReading = parseInt(secondReading);
        let averageReading;
        //validation testing
        let invalidInput = false;
        if (isNaN(firstReading)) {
            $("#inputNumMM1Error").text("You did not enter a valid number.  Please try again.").show();
            invalidInput = true;
        }
        if (isNaN(secondReading) || firstReading < 2 || secondReading < 2) {
            $("#inputNumMM2Error").text("You did not enter a valid number.  Please try again.").show();
            invalidInput = true;
        }
        if (firstReading < 2 || firstReading > 36) {
            $("#inputNumMM1Error").text("Please a number within the range of 2 through 36.").show();
            invalidInput = true;
        }
        if (secondReading < 2 || secondReading > 36) {
            $("#inputNumMM2Error").text("Please a number within the range of 2 through 36.").show();
            invalidInput = true;
        }

        if (invalidInput == true) {
            return;
        }
        else {
            $("#inputNumMM1Error").text("").hide();
            $("#inputNumMM2Error").text("").hide();

            if (firstReading > secondReading) {
                if (firstReading - secondReading > 1) {
                    $("#spanConsistentReq").addClass("span-consistent-req");
                    return;
                }
            }
            else {
                if (secondReading - firstReading > 1) {
                    $("#spanConsistentReq").addClass("span-consistent-req");
                    return;
                }
            }
            averageReading = (firstReading + secondReading) / 2;
            myFitnessCalculator.setMm = averageReading;
            myFitnessCalculator.calcBodyFat();
            $("#divCalInstructions").hide();
            let bodFat = myFitnessCalculator.getBodyFat;
            $("#h2BodyFatResults").text("Your body fat is " + bodFat + "%.");
            $("#divbodFatResults").show();
        }
    });

    $("#btnBodFatReset").on("click keyup", function (e) {
        e.preventDefault();
        $("#divbodFatResults").hide();
        $("#divFitStartPg").show();
    });

    $("#btnBMISubmit").on("click keyup", function (e) {
        let feet = $("#inputHeightFt").val();
        let inchesFromFt = convertFeetToInches(feet);
        let inches = $("#inputHeightIn").val();
        if (inchesFromFt != 0) {
            inches = parseInt(inchesFromFt) + parseInt(inches);
        }
        let weight = $("#inputWeight").val();
        let kilograms = parseFloat(weight) * 0.45;
        let meters = parseFloat(inches) * 0.025;
        let height = parseFloat(meters) * parseFloat(meters);
        let bmi = kilograms / height;
        $("#bmiResults").text("Your BMI is: " + roundTwoDecimals(bmi) + ".");
    });

    $("#btnBMIReset").on("click keyup", function (e) {
        $("#inputHeightFt").val(0);
        $("#inputHeightIn").val(0);
        $("#inputWeight").val(10);
        $("#bmiResults").text("");
        $("#divFitStartPg").show();
        $("#divBMIInputPg").hide();
    });
});


class FitnessCalculator {
    constructor(sex, age) {
        "use strict";
        this.sex = sex.toLowerCase();
        this.age = age;
        this.mm = 0;
        this.bodyFat = 0;
        this.chart = {};
        if (this.sex == "male") {
            this.setMaleChart();
        }
        else {
            this.setFemaleChart();
        }
        return this;
    }

    get getMm() {
        return this.mm;
    }
    set setMm(mm) {
        this.mm = Math.round(mm);
    }

    get getSex() {
        return this.sex;
    }

    get getAge() {
        return this.age;
    }

    get getBodyFat() {
        return this.bodyFat;
    }

    setMaleChart() {
        this.chart["18 - 20, 2 - 3"] = 2.0;
        this.chart["21 - 25, 2 - 3"] = 2.5;
        this.chart["26 - 30, 2 - 3"] = 3.5;
        this.chart["31 - 35, 2 - 3"] = 4.5;
        this.chart["36 - 40, 2 - 3"] = 5.6;
        this.chart["41 - 45, 2 - 3"] = 6.7;
        this.chart["46 - 50, 2 - 3"] = 7.7;
        this.chart["51 - 55, 2 - 3"] = 8.8;
        this.chart["56 - 140, 2 - 3"] = 9.9;
        this.chart["18 - 20, 4 - 5"] = 3.9;
        this.chart["21 - 25, 4 - 5"] = 4.9;
        this.chart["26 - 30, 4 - 5"] = 6.0;
        this.chart["31 - 35, 4 - 5"] = 7.1;
        this.chart["36 - 40, 4 - 5"] = 8.1;
        this.chart["41 - 45, 4 - 5"] = 9.2;
        this.chart["46 - 50, 4 - 5"] = 10.2;
        this.chart["51 - 55, 4 - 5"] = 11.3;
        this.chart["56 - 140, 4 - 5"] = 12.4;
        this.chart["18 - 20, 6 - 7"] = 6.2;
        this.chart["21 - 25, 6 - 7"] = 7.3;
        this.chart["26 - 30, 6 - 7"] = 8.4;
        this.chart["31 - 35, 6 - 7"] = 9.4;
        this.chart["36 - 40, 6 - 7"] = 10.5;
        this.chart["41 - 45, 6 - 7"] = 11.5;
        this.chart["46 - 50, 6 - 7"] = 12.6;
        this.chart["51 - 55, 6 - 7"] = 13.7;
        this.chart["56 - 140, 6 - 7"] = 14.7;
        this.chart["18 - 20, 8 - 9"] = 8.5;
        this.chart["21 - 25, 8 - 9"] = 9.5;
        this.chart["26 - 30, 8 - 9"] = 10.6;
        this.chart["31 - 35, 8 - 9"] = 11.7;
        this.chart["36 - 40, 8 - 9"] = 12.7;
        this.chart["41 - 45, 8 - 9"] = 13.8;
        this.chart["46 - 50, 8 - 9"] = 14.8;
        this.chart["51 - 55, 8 - 9"] = 15.9;
        this.chart["56 - 140, 8 - 9"] = 17.0;
        this.chart["18 - 20, 10 - 11"] = 10.5;
        this.chart["21 - 25, 10 - 11"] = 11.6;
        this.chart["26 - 30, 10 - 11"] = 12.7;
        this.chart["31 - 35, 10 - 11"] = 13.7;
        this.chart["36 - 40, 10 - 11"] = 14.8;
        this.chart["41 - 45, 10 - 11"] = 15.9;
        this.chart["46 - 50, 10 - 11"] = 16.9;
        this.chart["51 - 55, 10 - 11"] = 18.0;
        this.chart["56 - 140, 10 - 11"] = 19.1;
        this.chart["18 - 20, 12 - 13"] = 12.5;
        this.chart["21 - 25, 12 - 13"] = 13.6;
        this.chart["26 - 30, 12 - 13"] = 14.6;
        this.chart["31 - 35, 12 - 13"] = 15.7;
        this.chart["36 - 40, 12 - 13"] = 16.8;
        this.chart["41 - 45, 12 - 13"] = 17.8;
        this.chart["46 - 50, 12 - 13"] = 18.9;
        this.chart["51 - 55, 12 - 13"] = 20.0;
        this.chart["56 - 140, 12 - 13"] = 21.0;
        this.chart["18 - 20, 14 - 15"] = 14.3;
        this.chart["21 - 25, 14 - 15"] = 15.4;
        this.chart["26 - 30, 14 - 15"] = 16.4;
        this.chart["31 - 35, 14 - 15"] = 17.5;
        this.chart["36 - 40, 14 - 15"] = 18.6;
        this.chart["41 - 45, 14 - 15"] = 19.6;
        this.chart["46 - 50, 14 - 15"] = 20.7;
        this.chart["51 - 55, 14 - 15"] = 21.8;
        this.chart["56 - 140, 14 - 15"] = 22.8;
        this.chart["18 - 20, 16 - 17"] = 16.0;
        this.chart["21 - 25, 16 - 17"] = 17.1;
        this.chart["26 - 30, 16 - 17"] = 18.1;
        this.chart["31 - 35, 16 - 17"] = 19.2;
        this.chart["36 - 40, 16 - 17"] = 20.2;
        this.chart["41 - 45, 16 - 17"] = 21.3;
        this.chart["46 - 50, 16 - 17"] = 22.4;
        this.chart["51 - 55, 16 - 17"] = 23.4;
        this.chart["56 - 140, 16 - 17"] = 24.5;
        this.chart["18 - 20, 18 - 19"] = 17.5;
        this.chart["21 - 25, 18 - 19"] = 18.6;
        this.chart["26 - 30, 18 - 19"] = 19.6;
        this.chart["31 - 35, 18 - 19"] = 20.7;
        this.chart["36 - 40, 18 - 19"] = 21.7;
        this.chart["41 - 45, 18 - 19"] = 22.8;
        this.chart["46 - 50, 18 - 19"] = 23.9;
        this.chart["51 - 55, 18 - 19"] = 25.0;
        this.chart["56 - 140, 18 - 19"] = 26.0;
        this.chart["18 - 20, 20 - 21"] = 18.9;
        this.chart["21 - 25, 20 - 21"] = 20.0;
        this.chart["26 - 30, 20 - 21"] = 21.0;
        this.chart["31 - 35, 20 - 21"] = 22.1;
        this.chart["36 - 40, 20 - 21"] = 23.2;
        this.chart["41 - 45, 20 - 21"] = 24.7;
        this.chart["46 - 50, 20 - 21"] = 25.3;
        this.chart["51 - 55, 20 - 21"] = 26.4;
        this.chart["56 - 140, 20 - 21"] = 27.4;
        this.chart["18 - 20, 22 - 23"] = 20.2;
        this.chart["21 - 25, 22 - 23"] = 21.2;
        this.chart["26 - 30, 22 - 23"] = 22.3;
        this.chart["31 - 35, 22 - 23"] = 23.4;
        this.chart["36 - 40, 22 - 23"] = 24.4;
        this.chart["41 - 45, 22 - 23"] = 25.5;
        this.chart["46 - 50, 22 - 23"] = 26.6;
        this.chart["51 - 55, 22 - 23"] = 27.6;
        this.chart["56 - 140, 22 - 23"] = 28.7;
        this.chart["18 - 20, 24 - 25"] = 21.3;
        this.chart["21 - 25, 24 - 25"] = 22.3;
        this.chart["26 - 30, 24 - 25"] = 23.4;
        this.chart["31 - 35, 24 - 25"] = 24.5;
        this.chart["36 - 40, 24 - 25"] = 25.6;
        this.chart["41 - 45, 24 - 25"] = 26.6;
        this.chart["46 - 50, 24 - 25"] = 27.7;
        this.chart["51 - 55, 24 - 25"] = 28.7;
        this.chart["56 - 140, 24 - 25"] = 29.8;
        this.chart["18 - 20, 26 - 27"] = 22.3;
        this.chart["21 - 25, 26 - 27"] = 23.3;
        this.chart["26 - 30, 26 - 27"] = 24.4;
        this.chart["31 - 35, 26 - 27"] = 25.5;
        this.chart["36 - 40, 26 - 27"] = 26.5;
        this.chart["41 - 45, 26 - 27"] = 27.5;
        this.chart["46 - 50, 26 - 27"] = 28.7;
        this.chart["51 - 55, 26 - 27"] = 29.7;
        this.chart["56 - 140, 26 - 27"] = 30.8;
        this.chart["18 - 20, 28 - 29"] = 23.1;
        this.chart["21 - 25, 28 - 29"] = 24.2;
        this.chart["26 - 30, 28 - 29"] = 25.2;
        this.chart["31 - 35, 28 - 29"] = 26.3;
        this.chart["36 - 40, 28 - 29"] = 27.4;
        this.chart["41 - 45, 28 - 29"] = 28.4;
        this.chart["46 - 50, 28 - 29"] = 29.5;
        this.chart["51 - 55, 28 - 29"] = 30.6;
        this.chart["56 - 140, 28 - 29"] = 31.6;
        this.chart["18 - 20, 30 - 31"] = 23.8;
        this.chart["21 - 25, 30 - 31"] = 24.9;
        this.chart["26 - 30, 30 - 31"] = 25.9;
        this.chart["31 - 35, 30 - 31"] = 27.0;
        this.chart["36 - 40, 30 - 31"] = 28.1;
        this.chart["41 - 45, 30 - 31"] = 29.1;
        this.chart["46 - 50, 30 - 31"] = 30.2;
        this.chart["51 - 55, 30 - 31"] = 31.2;
        this.chart["56 - 140, 30 - 31"] = 32.3;
        this.chart["18 - 20, 32 - 33"] = 24.3;
        this.chart["21 - 25, 32 - 33"] = 25.4;
        this.chart["26 - 30, 32 - 33"] = 26.5;
        this.chart["31 - 35, 32 - 33"] = 27.5;
        this.chart["36 - 40, 32 - 33"] = 28.5;
        this.chart["41 - 45, 32 - 33"] = 29.7;
        this.chart["46 - 50, 32 - 33"] = 30.7;
        this.chart["51 - 55, 32 - 33"] = 31.3;
        this.chart["56 - 140, 32 - 33"] = 32.9;
        this.chart["18 - 20, 34 - 36"] = 24.9;
        this.chart["21 - 25, 34 - 36"] = 25.8;
        this.chart["26 - 30, 34 - 36"] = 26.9;
        this.chart["31 - 35, 34 - 36"] = 28.0;
        this.chart["36 - 40, 34 - 36"] = 29.0;
        this.chart["41 - 45, 34 - 36"] = 30.1;
        this.chart["46 - 50, 34 - 36"] = 31.2;
        this.chart["51 - 55, 34 - 36"] = 32.2;
        this.chart["56 - 140, 34 - 36"] = 33.3;
    }

    setFemaleChart() {
        this.chart["18 - 20, 2 - 3"] = 11.3;
        this.chart["21 - 25, 2 - 3"] = 11.9;
        this.chart["26 - 30, 2 - 3"] = 12.5;
        this.chart["31 - 35, 2 - 3"] = 13.2;
        this.chart["36 - 40, 2 - 3"] = 13.8;
        this.chart["41 - 45, 2 - 3"] = 14.4;
        this.chart["46 - 50, 2 - 3"] = 15.0;
        this.chart["51 - 55, 2 - 3"] = 15.6;
        this.chart["56 - 140, 2 - 3"] = 16.3;
        this.chart["18 - 20, 4 - 5"] = 13.5;
        this.chart["21 - 25, 4 - 5"] = 14.2;
        this.chart["26 - 30, 4 - 5"] = 14.8;
        this.chart["31 - 35, 4 - 5"] = 15.4;
        this.chart["36 - 40, 4 - 5"] = 16.0;
        this.chart["41 - 45, 4 - 5"] = 16.7;
        this.chart["46 - 50, 4 - 5"] = 17.3;
        this.chart["51 - 55, 4 - 5"] = 17.9;
        this.chart["56 - 140, 4 - 5"] = 18.5;
        this.chart["18 - 20, 6 - 7"] = 15.7;
        this.chart["21 - 25, 6 - 7"] = 16.3;
        this.chart["26 - 30, 6 - 7"] = 16.9;
        this.chart["31 - 35, 6 - 7"] = 17.6;
        this.chart["36 - 40, 6 - 7"] = 18.2;
        this.chart["41 - 45, 6 - 7"] = 18.8;
        this.chart["46 - 50, 6 - 7"] = 19.4;
        this.chart["51 - 55, 6 - 7"] = 20.0;
        this.chart["56 - 140, 6 - 7"] = 20.7;
        this.chart["18 - 20, 8 - 9"] = 17.7;
        this.chart["21 - 25, 8 - 9"] = 18.4;
        this.chart["26 - 30, 8 - 9"] = 19.0;
        this.chart["31 - 35, 8 - 9"] = 19.6;
        this.chart["36 - 40, 8 - 9"] = 20.2;
        this.chart["41 - 45, 8 - 9"] = 20.8;
        this.chart["46 - 50, 8 - 9"] = 21.5;
        this.chart["51 - 55, 8 - 9"] = 22.1;
        this.chart["56 - 140, 8 - 9"] = 22.7;
        this.chart["18 - 20, 10 - 11"] = 19.7;
        this.chart["21 - 25, 10 - 11"] = 20.3;
        this.chart["26 - 30, 10 - 11"] = 20.9;
        this.chart["31 - 35, 10 - 11"] = 21.5;
        this.chart["36 - 40, 10 - 11"] = 22.2;
        this.chart["41 - 45, 10 - 11"] = 22.8;
        this.chart["46 - 50, 10 - 11"] = 23.4;
        this.chart["51 - 55, 10 - 11"] = 24.0;
        this.chart["56 - 140, 10 - 11"] = 24.6;
        this.chart["18 - 20, 12 - 13"] = 21.5;
        this.chart["21 - 25, 12 - 13"] = 22.1;
        this.chart["26 - 30, 12 - 13"] = 22.7;
        this.chart["31 - 35, 12 - 13"] = 23.4;
        this.chart["36 - 40, 12 - 13"] = 24.0;
        this.chart["41 - 45, 12 - 13"] = 24.6;
        this.chart["46 - 50, 12 - 13"] = 25.2;
        this.chart["51 - 55, 12 - 13"] = 25.9;
        this.chart["56 - 140, 12 - 13"] = 26.5;
        this.chart["18 - 20, 14 - 15"] = 23.2;
        this.chart["21 - 25, 14 - 15"] = 23.8;
        this.chart["26 - 30, 14 - 15"] = 24.5;
        this.chart["31 - 35, 14 - 15"] = 25.1;
        this.chart["36 - 40, 14 - 15"] = 25.7;
        this.chart["41 - 45, 14 - 15"] = 26.3;
        this.chart["46 - 50, 14 - 15"] = 26.9;
        this.chart["51 - 55, 14 - 15"] = 27.6;
        this.chart["56 - 140, 14 - 15"] = 28.2;
        this.chart["18 - 20, 16 - 17"] = 24.8;
        this.chart["21 - 25, 16 - 17"] = 25.5;
        this.chart["26 - 30, 16 - 17"] = 26.1;
        this.chart["31 - 35, 16 - 17"] = 26.7;
        this.chart["36 - 40, 16 - 17"] = 27.3;
        this.chart["41 - 45, 16 - 17"] = 27.9;
        this.chart["46 - 50, 16 - 17"] = 28.6;
        this.chart["51 - 55, 16 - 17"] = 29.2;
        this.chart["56 - 140, 16 - 17"] = 29.8;
        this.chart["18 - 20, 18 - 19"] = 26.3;
        this.chart["21 - 25, 18 - 19"] = 27.0;
        this.chart["26 - 30, 18 - 19"] = 27.6;
        this.chart["31 - 35, 18 - 19"] = 28.2;
        this.chart["36 - 40, 18 - 19"] = 28.8;
        this.chart["41 - 45, 18 - 19"] = 29.4;
        this.chart["46 - 50, 18 - 19"] = 30.1;
        this.chart["51 - 55, 18 - 19"] = 30.7;
        this.chart["56 - 140, 18 - 19"] = 31.3;
        this.chart["18 - 20, 20 - 21"] = 27.7;
        this.chart["21 - 25, 20 - 21"] = 28.4;
        this.chart["26 - 30, 20 - 21"] = 29.0;
        this.chart["31 - 35, 20 - 21"] = 29.6;
        this.chart["36 - 40, 20 - 21"] = 30.2;
        this.chart["41 - 45, 20 - 21"] = 30.8;
        this.chart["46 - 50, 20 - 21"] = 31.5;
        this.chart["51 - 55, 20 - 21"] = 32.1;
        this.chart["56 - 140, 20 - 21"] = 32.7;
        this.chart["18 - 20, 22 - 23"] = 29.0;
        this.chart["21 - 25, 22 - 23"] = 29.6;
        this.chart["26 - 30, 22 - 23"] = 30.3;
        this.chart["31 - 35, 22 - 23"] = 30.9;
        this.chart["36 - 40, 22 - 23"] = 31.5;
        this.chart["41 - 45, 22 - 23"] = 32.1;
        this.chart["46 - 50, 22 - 23"] = 32.8;
        this.chart["51 - 55, 22 - 23"] = 33.4;
        this.chart["56 - 140, 22 - 23"] = 34.0;
        this.chart["18 - 20, 24 - 25"] = 30.2;
        this.chart["21 - 25, 24 - 25"] = 30.8;
        this.chart["26 - 30, 24 - 25"] = 31.5;
        this.chart["31 - 35, 24 - 25"] = 32.1;
        this.chart["36 - 40, 24 - 25"] = 32.7;
        this.chart["41 - 45, 24 - 25"] = 33.3;
        this.chart["46 - 50, 24 - 25"] = 34.0;
        this.chart["51 - 55, 24 - 25"] = 34.6;
        this.chart["56 - 140, 24 - 25"] = 35.2;
        this.chart["18 - 20, 26 - 27"] = 31.3;
        this.chart["21 - 25, 26 - 27"] = 31.9;
        this.chart["26 - 30, 26 - 27"] = 32.5;
        this.chart["31 - 35, 26 - 27"] = 33.2;
        this.chart["36 - 40, 26 - 27"] = 33.8;
        this.chart["41 - 45, 26 - 27"] = 34.4;
        this.chart["46 - 50, 26 - 27"] = 35.0;
        this.chart["51 - 55, 26 - 27"] = 35.6;
        this.chart["56 - 140, 26 - 27"] = 36.3;
        this.chart["18 - 20, 28 - 29"] = 32.3;
        this.chart["21 - 25, 28 - 29"] = 32.9;
        this.chart["26 - 30, 28 - 29"] = 33.5;
        this.chart["31 - 35, 28 - 29"] = 34.1;
        this.chart["36 - 40, 28 - 29"] = 34.8;
        this.chart["41 - 45, 28 - 29"] = 35.4;
        this.chart["46 - 50, 28 - 29"] = 36.0;
        this.chart["51 - 55, 28 - 29"] = 36.6;
        this.chart["56 - 140, 28 - 29"] = 37.2;
        this.chart["18 - 20, 30 - 31"] = 33.1;
        this.chart["21 - 25, 30 - 31"] = 33.8;
        this.chart["26 - 30, 30 - 31"] = 34.4;
        this.chart["31 - 35, 30 - 31"] = 35.0;
        this.chart["36 - 40, 30 - 31"] = 35.6;
        this.chart["41 - 45, 30 - 31"] = 36.3;
        this.chart["46 - 50, 30 - 31"] = 36.9;
        this.chart["51 - 55, 30 - 31"] = 37.5;
        this.chart["56 - 140, 30 - 31"] = 38.1;
        this.chart["18 - 20, 32 - 33"] = 33.9;
        this.chart["21 - 25, 32 - 33"] = 34.5;
        this.chart["26 - 30, 32 - 33"] = 35.2;
        this.chart["31 - 35, 32 - 33"] = 35.8;
        this.chart["36 - 40, 32 - 33"] = 36.4;
        this.chart["41 - 45, 32 - 33"] = 37.0;
        this.chart["46 - 50, 32 - 33"] = 37.6;
        this.chart["51 - 55, 32 - 33"] = 38.3;
        this.chart["56 - 140, 32 - 33"] = 38.9;
        this.chart["18 - 20, 34 - 36"] = 34.6;
        this.chart["21 - 25, 34 - 36"] = 35.2;
        this.chart["26 - 30, 34 - 36"] = 35.8;
        this.chart["31 - 35, 34 - 36"] = 36.4;
        this.chart["36 - 40, 34 - 36"] = 37.1;
        this.chart["41 - 45, 34 - 36"] = 37.7;
        this.chart["46 - 50, 34 - 36"] = 38.3;
        this.chart["51 - 55, 34 - 36"] = 38.9;
        this.chart["56 - 140, 34 - 36"] = 39.5;
    }

    calcBodyFat() {
        let ageParam = "";
        if (this.age >= 18 && this.age <= 20) {
            ageParam = "18 - 20";
        }
        else if (this.age >= 21 && this.age <= 25) {
            ageParam = "21 - 25";
        }
        else if (this.age >= 26 && this.age <= 30) {
            ageParam = "26 - 30";
        }
        else if (this.age >= 31 && this.age <= 35) {
            ageParam = "31 - 35";
        }
        else if (this.age >= 36 && this.age <= 40) {
            ageParam = "36 - 40";
        }
        else if (this.age >= 41 && this.age <= 45) {
            ageParam = "41 - 45";
        }
        else if (this.age >= 46 && this.age <= 50) {
            ageParam = "46 - 50";
        }
        else if (this.age >= 51 && this.age <= 55) {
            ageParam = "51 - 55";
        }
        else if (this.age >= 56 && this.age <= 140) {
            ageParam = "56 - 140";
        }
        else {
            throw "Invalid Age!";
        }

        let milMeterParam = 0;
        if (this.mm >= 2 && this.mm <= 3) {
            milMeterParam = "2 - 3";
        }
        else if (this.mm >= 4 && this.mm <= 5) {
            milMeterParam = "4 - 5";
        }
        else if (this.mm >= 6 && this.mm <= 7) {
            milMeterParam = "6 - 7";
        }
        else if (this.mm >= 8 && this.mm <= 9) {
            milMeterParam = "8 - 9";
        }
        else if (this.mm >= 10 && this.mm <= 11) {
            milMeterParam = "10 - 11";
        }
        else if (this.mm >= 12 && this.mm <= 13) {
            milMeterParam = "12 - 13";
        }
        else if (this.mm >= 14 && this.mm <= 15) {
            milMeterParam = "14 - 15";
        }
        else if (this.mm >= 16 && this.mm <= 17) {
            milMeterParam = "16 - 17";
        }
        else if (this.mm >= 18 && this.mm <= 19) {
            milMeterParam = "18 - 19";
        }
        else if (this.mm >= 20 && this.mm <= 21) {
            milMeterParam = "20 - 21";
        }
        else if (this.mm >= 22 && this.mm <= 23) {
            milMeterParam = "22 - 23";
        }
        else if (this.mm >= 24 && this.mm <= 25) {
            milMeterParam = "24 - 25";
        }
        else if (this.mm >= 26 && this.mm <= 27) {
            milMeterParam = "26 - 27";
        }
        else if (this.mm >= 28 && this.mm <= 29) {
            milMeterParam = "28 - 29";
        }
        else if (this.mm >= 30 && this.mm <= 31) {
            milMeterParam = "30 - 31";
        }
        else if (this.mm >= 32 && this.mm <= 33) {
            milMeterParam = "32 - 33";
        }
        else if (this.mm >= 34 && this.mm <= 36) {
            milMeterParam = "34 - 36";
        }
        else {
            throw "Invalid millimeter input!";
        }
        let ageAndMmParams = ageParam + ", " + milMeterParam;
        this.bodyFat = this.chart[ageAndMmParams];
    }
}