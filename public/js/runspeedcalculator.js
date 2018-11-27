/*jshint esversion: 6 */

function getMilesPerHour() {
    "use strict";
    var distanceVal = $("#dist-output").val();
    var whiteSpace = distanceVal.indexOf(" ");
    var distNum = distanceVal.slice(0, whiteSpace);
    //distNum = distNum.trim();
    var minutesVal = $("#time-output").val();
    var minuteWhiteSpace = minutesVal.indexOf(" ");
    var minutesNum = minutesVal.slice(0, minuteWhiteSpace);
    var mph = runSpeedDistCalculator(distNum, minutesNum);
    $('#mph-paragraph').removeAttr('hidden').show();
    $("#mph-paragraph").text("You must run " + mph + " mph to acheive your goal.");
}


function runSpeedDistCalculator(dist, time)
{
    "use strict";
    let miles = dist;
    let minutes = time;
    let hour = 60;
    let mpm = minutes / miles; // minutes per mile
    let miesPh = hour / mpm;
    miesPh = miesPh.toFixed(2);
    return miesPh;
}

function distUpdate(miles)
{
    document.querySelector('#dist-output').value = miles;
    (miles > 1) ? $('#dist-output').append(" miles") : $('#dist-output').append(" mile");
}



