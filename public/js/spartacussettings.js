$(document).ready(function () {
    "use strict";
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });
    var diffLvl = $("#difficultyLvl");
    var difficultySelectedIndex = diffLvl[0].dataset.difficultylvl;
    difficultySelectedIndex = parseInt(difficultySelectedIndex, 10);
    if (difficultySelectedIndex > 0) {
        diffLvl[0].selectedIndex = difficultySelectedIndex.toString();
    }

    var lightWeight = $("#lightWeight");
    var lightSelectedIndex = lightWeight[0].dataset.lightweight;
    lightSelectedIndex = parseInt(lightSelectedIndex, 10);
    if (lightSelectedIndex > 0) {
        lightWeight[0].selectedIndex = lightSelectedIndex.toString();
    }

    var heavyWeight = $("#heavyWeight");
    var heavySelectedIndex = heavyWeight[0].dataset.heavyweight;
    heavySelectedIndex = parseInt(heavySelectedIndex, 10);
    if (heavySelectedIndex > 0) {
        heavyWeight[0].selectedIndex = heavySelectedIndex.toString();
    }
});