"use strict";
//Spartacus begin
function startBtnEventHandler() {
    $("#gladiator-start-wallpaper").switchClass("gladiator", "red-background");
    if (!$("#btn-start").hasClass("hidden")) {
        $("#btn-start").addClass("hidden");
    }
    $("#spartacus-header").text(
        "The first exercise will be the Goblet Squat. Get ready.");
    let now = new Date();
    let firstRound = 1;
    let firstExercise = 1;
    countDown(now.setTime(now.getTime() + 10000));
    setTimeout(exercise, 10000, firstExercise, firstRound);
}

function exercise(exerciseType, round) {
    let currentExercise = (exerciseType) ? exerciseType : 1;
    let currentRound = round;
    switch (currentExercise) {
        case 1:
            $("#spartacus-header").text("The Goblet Squat");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/goblet-squat.jpg", "alt": "The Goblet Squat"});
            $("#img-placeholder").removeAttr("class").addClass("goblet-squat");
            currentExercise++;
            let now = new Date();
            countDown(now.setTime(now.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 2:
            $("#spartacus-header").text("The Mountain Climber");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/mountain-climber.jpg", "alt": "The Mountain Climber"});
            $("#img-placeholder").removeAttr("class").addClass("mountain-climber");
            currentExercise++;
            let nowA = new Date();
            countDown(nowA.setTime(nowA.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 3:
            $("#spartacus-header").text("The Gladius Swing");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/single-arm-dumbell-swing.jpg", "alt": "The Gladius Swing"});
            $("#img-placeholder").removeAttr("class").addClass("gladius-swing");
            currentExercise++;
            let nowB = new Date();
            countDown(nowB.setTime(nowB.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 4:
            $("#spartacus-header").text("The T-Pushup");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/t-pushup.jpg", "alt": "The T-Pushup"});
            $("#img-placeholder").removeAttr("class").addClass("t-pushup");
            currentExercise++;
            let nowC = new Date();
            countDown(nowC.setTime(nowC.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 5:
            $("#spartacus-header").text("The Latin Leap");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/split-jump.jpg", "alt": "The Latin Leap"});
            $("#img-placeholder").removeAttr("class").addClass("latin-leap");
            currentExercise++;
            let nowD = new Date();
            countDown(nowD.setTime(nowD.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 6:
            $("#spartacus-header").text("The Dumbell Row");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/dumbbell-row.jpg", "alt": "The Dumbell Row"});
            $("#img-placeholder").removeAttr("class").addClass("dumbell-row");
            currentExercise++;
            let nowE = new Date();
            countDown(nowE.setTime(nowE.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 7:
            $("#spartacus-header").text("The Dumbell Side Lunge and Touch");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/dumbbell-side-lunge-touch.jpg", "alt": "The Dumbell Side Lunge and Touch"});
            $("#img-placeholder").removeAttr("class").addClass(
                "dumbell-side-lunge-touch");
            currentExercise++;
            let nowF = new Date();
            countDown(nowF.setTime(nowF.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 8:
            $("#spartacus-header").text("The Slave Boat Row");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/pushup-position-row.jpg", "alt": "The Slave Boat Row"});
            $("#img-placeholder").removeAttr("class").addClass("slave-boat-row");
            currentExercise++;
            let nowG = new Date();
            countDown(nowG.setTime(nowG.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 9:
            $("#spartacus-header").text("The Proud Knee");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/dumbbell-lunge-rotation.jpg", "alt": "The Proud Knee"});
            $("#img-placeholder").removeAttr("class").addClass("dumbell-lunge-rotation");
            currentExercise++;
            let nowH = new Date();
            countDown(nowH.setTime(nowH.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
        case 10:
            $("#spartacus-header").text("The Dumbbell Push Press");
            // $("#img-placeholder").removeAttr("class").addClass("exercise-img").attr({"src": "../css/images/dumbbell-push-press.jpg", "alt": "The Dumbbell Push Press"});
            $("#img-placeholder").removeAttr("class").addClass("dumbell-push-press");
            currentExercise++;
            let nowI = new Date();
            countDown(nowI.setTime(nowI.getTime() + 30000));
            setTimeout(rest, 30000, currentExercise, currentRound);
            break;
    }
}

function rest(station, set) {
    if (station == 11 && set == 1) { // End of the first set
        $("#spartacus-header").text(
            "You got lucky and survived this round slave.  We shall see if you can survive a second trip to the arena."
        );
        $("#img-placeholder").removeAttr("src").removeAttr("class").removeAttr(
            "alt").addClass("hidden");
        station = 1;
        let now = new Date();
        countDown(now.setTime(now.getTime() + 120000));
        set = set + 1;
        setTimeout(exercise, 120000, station, set); // timer for rest between rounds/ sets
    } else if (station == 11 && set == 2) { // End of the second set
        $("#spartacus-header").text(
            "You survived another round!  Maybe the gods favor you slave...  We won't know for sure until you survive a third round. Get some rest.  You're going to need it."
        );
        $("#img-placeholder").removeAttr("src").removeAttr("class").removeAttr(
            "alt").addClass("hidden");
        station = 1;
        let now = new Date();
        countDown(now.setTime(now.getTime() + 120000));
        set = set + 1;
        setTimeout(exercise, 120000, station, set); // timer for rest between rounds/ sets
    } else if (station == 11 && set == 3) { // End of workout
        $("#spartacus-header").text(
            "Congratulations!  You're a true champion of the arena. The gods favor you."
        );
        $("#img-placeholder").removeAttr("src").removeAttr("class").removeAttr(
            "alt").addClass("hidden");
    } else {
        $("#spartacus-header").text("Rest Slave"); // Short rest between stations
        $("#img-placeholder").removeAttr("src").removeAttr("class").removeAttr(
            "alt").addClass("hidden");
        let now = new Date();
        countDown(now.setTime(now.getTime() + 15000), station);
        setTimeout(exercise, 15000, station, set);
    }
}

function countDown(restAmount, nextExercise) {
    if (nextExercise !== undefined) {
        switch (nextExercise) {
            case 1:
                $("#next-exercise-loc").text("Up next is the Goblet Squat");
                break;
            case 2:
                $("#next-exercise-loc").text("Up next is the Mountain Climber");
                break;
            case 3:
                $("#next-exercise-loc").text("Up next is the the Gladius Swing");
                break;
            case 4:
                $("#next-exercise-loc").text("Up next is the the T-Pushup");
                break;
            case 5:
                $("#next-exercise-loc").text("Up next is the Latin Leap");
                break;
            case 6:
                $("#next-exercise-loc").text("Up next is the Dumbell Row");
                break;
            case 7:
                $("#next-exercise-loc").text(
                    "Up next is the Dumbell Side Lunge and Touch");
                break;
            case 8:
                $("#next-exercise-loc").text("Up next is the Slave Boat Row");
                break;
            case 9:
                $("#next-exercise-loc").text("Up next is the Proud Knee");
                break;
            case 10:
                $("#next-exercise-loc").text("Up next is the Dumbbell Push Press");
                break;
            default:
                break;
        }
    }

    var x = setInterval(function () {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = restAmount - now;

        // Time calculations for days, hours, minutes and seconds
        // var days = Math.floor(restAmount / (1000 * 60 * 60 * 24));
        // var hours = Math.floor((restAmount % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        (minutes == 0) ? $("#count-down-area").text(seconds + "s ") : $(
            "#count-down-area").text(minutes + "m " + seconds + "s ");


        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            $("#count-down-area").text("");
            if (nextExercise !== undefined) {
                $("#next-exercise-loc").text("");
            }
        }
    }, 1000);
    return;
}//Spartacus end