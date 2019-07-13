/*jshint esversion: 6 */
$(document).ready(function () {
    "use strict";

    $("#divHoroscopeResults").hide();
    let myHoroscopeGen = new HoroscopesGenerator();
    let textInputs = [];
    textInputs = $("input[type=text]");
    $("#btn-submit-horoscope").on("click keyup", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            myHoroscopeGen.setHoroscopeData();
            myHoroscopeGen.displayHoroscope();
            $("#btn-submit-horoscope").hide();
            $("#divHoroscopeResults").show();
            $("#horoscope-heading2").focus();
        }
    });

    $("#btn-reset-horoscope").on("click keyup", function (e) {
        e.preventDefault();
        myHoroscopeGen.resetHoroscope();
        $("#divHoroscopeResults").hide();
        $("#btn-submit-horoscope").show();
    });

    $("input[type=text]").on("change blur keyup", function (e) {
        if (e.keycode != 9 && e.which != 9) {
            let value = $(this).val().toLowerCase().trim();
            let wordStatus = false;
            let ing = "ing";
            let labelTxt = $(this).prev().text().toLowerCase();
            labelTxt = labelTxt.substr(0, labelTxt.length - 1);
            if(this.id == "five" || this.id == "nine" ){
                wordStatus = myHoroscopeGen.ValidateWord(value, ing);
            }
            else if(this.id == "seventeen"){
                wordStatus = !isNaN(value);
            }
            else{
                wordStatus = myHoroscopeGen.ValidateWord(value);
            }
            if (wordStatus) {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                $(this).next("span").text("");
                $("#" + this.id + "Error").text("");
            }
            else {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
                $("#" + this.id + "Error").text("Error: Please enter a " + labelTxt);
            }

            $("#btn-submit-horoscope").removeAttr("disabled");
            for(let input = 0; input < textInputs.length; input++){
                if($(textInputs[input]).hasClass("is-invalid") || $(textInputs[input]).val() == "" || $(textInputs[input]).val() === null){
                    $("#btn-submit-horoscope").attr("disabled", "true");
                }
            }
        }
    });
});

class HoroscopesGenerator {
    constructor() {
        "use strict";
        let _horoscopeData = // 'var' or 'let' rather than the 'this' keyword makes this attribute a private instance variable
        {
            one: "",
            two: "",
            three: "",
            four: "",
            five: "",
            six: "",
            seven: "",
            eight: "",
            nine: "",
            ten: "",
            eleven: "",
            twelve: "",
            thirteen: "",
            fourteen: "",
            fifteen: "",
            sixteen: "",
            seventeen: "",
            eighteen: ""
        };
        this.ValidateWord = ValidateWord; //The this keyword makes this method public
        this.setHoroscopeData = setHoroscopeData; //The this keyword makes this method public
        this.displayHoroscope = displayHoroscope; //The this keyword makes this method public
        this.resetHoroscope = resetHoroscope; //The this keyword makes this method public

        function setHoroscopeData() {
            _horoscopeData.one = $('#one').val().toLowerCase().trim();
            _horoscopeData.two = $('#two').val().toLowerCase().trim();
            _horoscopeData.three = $('#three').val().toLowerCase().trim();
            _horoscopeData.four = $('#four').val().toLowerCase().trim();
            _horoscopeData.five = $('#five').val().toLowerCase().trim();
            _horoscopeData.six = $('#six').val().toLowerCase().trim();
            _horoscopeData.seven = $('#seven').val().toLowerCase().trim();
            _horoscopeData.eight = $('#eight').val().toLowerCase().trim();
            _horoscopeData.nine = $('#nine').val().toLowerCase().trim();
            _horoscopeData.ten = $('#ten').val().toLowerCase().trim();
            _horoscopeData.eleven = $('#eleven').val().toLowerCase().trim();
            _horoscopeData.twelve = $('#twelve').val().toLowerCase().trim();
            _horoscopeData.thirteen = $('#thirteen').val().toLowerCase().trim();
            _horoscopeData.fourteen = $('#fourteen').val().toLowerCase().trim();
            _horoscopeData.fifteen = $('#fifteen').val().toLowerCase().trim();
            _horoscopeData.sixteen = $('#sixteen').val().toLowerCase().trim();
            _horoscopeData.seventeen = $('#seventeen').val().toLowerCase().trim();
            _horoscopeData.eighteen = $('#eighteen').val().toLowerCase().trim();
        }
        function displayHoroscope() {
            $('#horoscope-heading2').text('Today\'s Horoscopes');
            $('#user-input-table').hide();
            $('#horoscope-paragraph').removeAttr('hidden').show();
            $('#btn-submit-horoscope').hide();
            $('#btn-reset-horoscope').removeAttr('hidden').show();
            let horoScope = "";
            let geminiFirstLetter = _horoscopeData.four.charAt(0).toUpperCase();
            _horoscopeData.four = _horoscopeData.four.replace(_horoscopeData.four.substr(0, 1), geminiFirstLetter);
            let cancerFirstLetter = _horoscopeData.five.charAt(0).toUpperCase();
            _horoscopeData.five = _horoscopeData.five.replace(_horoscopeData.five.substr(0, 1), cancerFirstLetter);
            let virgoFirstLetter = _horoscopeData.eight.charAt(0).toUpperCase();
            _horoscopeData.eight = _horoscopeData.eight.replace(_horoscopeData.eight.substr(0, 1), virgoFirstLetter);
            horoScope = "<span class='sign'>Aries — Ram (March 21-April 19)</span><br>Someone you know may be feeling " + _horoscopeData.one + ". Stay out of the way!<br><br><span class='sign'>Taurus — Bull (April 20-May 20)</span><br>Don't " + _horoscopeData.two + " in public. It could prove embarrassing.<br><br><span class='sign'>Gemini — Twins (May 21-June 20)</span><br>Control the urge to " + _horoscopeData.three + ". " + _horoscopeData.four + " instead.<br><br><span class='sign'>Cancer — Crab (June 21-July 22)</span><br>" + _horoscopeData.five + " too many " + _horoscopeData.six + " will leave you exhausted!<br><br><span class='sign'>Leo — Lion (July 23-August 22)</span><br>A loved one thinks you are " + _horoscopeData.seven + ". Do not be taken in by flattery.<br><br><span class='sign'>Virgo — Virgin (August 23-September 22)</span><br>" + _horoscopeData.eight + " in private when possible. It's difficult to concentrate when people are watching.<br><br><span class='sign'>Libra— Scales (September 23-October 22)</span><br>Avoid " + _horoscopeData.nine + " " + _horoscopeData.ten + ".<br><br><span class='sign'>Scorpio — Scorpion (October 23-November 21)</span><br>Never loan money to " + _horoscopeData.eleven + " " + _horoscopeData.twelve + "! They are poor credit risks.<br><br><span class='sign'>Sagittarius — Archer (November 22-December 21)</span><br>Today is a good day to " + _horoscopeData.thirteen + " a(n) " + _horoscopeData.fourteen + ".<br><br><span class='sign'>Capricorn — Goat (December 22-January 19)</span><br>You may receive some " + _horoscopeData.fifteen + " from a secret admirer! Water them every day, and they will last a long time.<br><br><span class='sign'>Aquarius — Water Bearer (January 20-February 18)</span><br>Unless you organize your " + _horoscopeData.sixteen + " better, you won't get anything done.<br><br><span class='sign'>Pisces — Fish (February 19-March 20)</span><br>A good friend will give you $" + _horoscopeData.seventeen + " to buy new " + _horoscopeData.eighteen + ". Be sure to thank your friend.<br>";
            $('#horoscope-paragraph').append(horoScope);
        }
        function resetHoroscope(textInputs) {
            $('#horoscope-paragraph').text('');
            $("input[type=text]").val('');
            $("input[type=text]").removeClass("is-valid");
            $('#horoscope-paragraph').hide();
            $('#btn-reset-horoscope').hide();
            $('#horoscope-heading2').text('Fill in the blanks below to generate your horoscope.');
            $('#user-input-table').show();
            $('#btn-submit-horoscope').show();
        }
        function ValidateWord(word, ing) {
            if(ing){
                var substring = word.substr(-3);
                if(substring != "ing"){
                    return false;
                }
            }
            if (/^(?=.{1,12}$)[a-z]+(?:['_.\s][a-z]+)*$/i.test(word)) {
                return true;
            }
            else {
                return false;
            }
        }
        Object.freeze(this);
    }
}

