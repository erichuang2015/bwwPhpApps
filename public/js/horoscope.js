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
            let lang = $("#language").val();
            if(this.id == "five" && lang == "english" || this.id == "nine" && lang == "english"){
                    wordStatus = myHoroscopeGen.ValidateWord(value, ing);
            }
            else if(this.id == "seventeen"){
                if(value){
                    wordStatus = !isNaN(value);
                }else{
                    wordStatus = false;
                }
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
                let errorEnterA = $("#errorEnterA").val();
                $("#" + this.id + "Error").text(errorEnterA + labelTxt);
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
            let todaysHoroscopes = $("#todaysHoroscopes").val();
            $('#horoscope-heading2').text(todaysHoroscopes);
            $('#user-input-table').hide();
            $('#horoscope-paragraph').removeAttr('hidden').show();
            $('#btn-submit-horoscope').hide();
            $('#btn-reset-horoscope').removeAttr('hidden').show();
            let horoScope = "";
            let geminiFirstLetter = _horoscopeData.four.charAt(0).toUpperCase();
            _horoscopeData.four = _horoscopeData.four.replace(_horoscopeData.four.substr(0, 1), geminiFirstLetter);
            let cancerFirstLetter = _horoscopeData.five.charAt(0).toUpperCase();
            _horoscopeData.five = _horoscopeData.five.replace(_horoscopeData.five.substr(0, 1), cancerFirstLetter);
            let someoneFeeling = $("#someoneFeeling").val();
            let stayOutWay = $("#stayOutWay").val();
            let dont = $("#dont").val();
            let publicEmbarrassing = $("#publicEmbarrassing").val();
            let controlUrge = $("#controlUrge").val();
            let instead = $("#instead").val();
            let tooMany = $("#tooMany").val();
            let exhausted = $("#exhausted").val();
            let aLovedOne = $("#aLovedOne").val();
            let dontBeFlattered = $("#dontBeFlattered").val();
            let inPrivate = $("#inPrivate").val();
            let avoid = $("#avoid").val();
            let neverLoan = $("#neverLoan").val();
            let poorCredit = $("#poorCredit").val();
            let goodDay = $("#goodDay").val();
            let mayReceive = $("#mayReceive").val();
            let secretAdmirer = $("#secretAdmirer").val();
            let organize = $("#organize").val();
            let better = $("#better").val();
            let goodFriend = $("#goodFriend").val();
            let buyNew = $("#buyNew").val();
            let thankFriend = $("#thankFriend").val();
            let virgoFirstLetter = _horoscopeData.eight.charAt(0).toUpperCase();
            _horoscopeData.eight = _horoscopeData.eight.replace(_horoscopeData.eight.substr(0, 1), virgoFirstLetter);
            horoScope = "<span class='sign'>Aries — Ram (March 21-April 19)</span><br>" + someoneFeeling + _horoscopeData.one + ". " + stayOutWay + "<br><br><span class='sign'>Taurus — Bull (April 20-May 20)</span><br>" + dont + " " + _horoscopeData.two + " " + publicEmbarrassing + "<br><br><span class='sign'>Gemini — Twins (May 21-June 20)</span><br>" + controlUrge + " " + _horoscopeData.three + ". " + _horoscopeData.four + " " + instead + "<br><br><span class='sign'>Cancer — Crab (June 21-July 22)</span><br>" + _horoscopeData.five + tooMany + _horoscopeData.six + exhausted + "<br><br><span class='sign'>Leo — Lion (July 23-August 22)</span><br>" + aLovedOne + _horoscopeData.seven + ". " + dontBeFlattered + "<br><br><span class='sign'>Virgo — Virgin (August 23-September 22)</span><br>" + _horoscopeData.eight + " " + inPrivate + "<br><br><span class='sign'>Libra— Scales (September 23-October 22)</span><br> " + avoid + _horoscopeData.nine + " " + _horoscopeData.ten + ".<br><br><span class='sign'>Scorpio — Scorpion (October 23-November 21)</span><br>" + neverLoan + _horoscopeData.eleven + " " + _horoscopeData.twelve + "! " + poorCredit + "<br><br><span class='sign'>Sagittarius — Archer (November 22-December 21)</span><br>" + goodDay + _horoscopeData.thirteen + " a(n) " + _horoscopeData.fourteen + ".<br><br><span class='sign'>Capricorn — Goat (December 22-January 19)</span><br>" + mayReceive + _horoscopeData.fifteen + secretAdmirer + "<br><br><span class='sign'>Aquarius — Water Bearer (January 20-February 18)</span><br>" + organize + _horoscopeData.sixteen + better + "<br><br><span class='sign'>Pisces — Fish (February 19-March 20)</span><br>" + goodFriend + " $" + _horoscopeData.seventeen + " " + buyNew + " " + _horoscopeData.eighteen + ". " + thankFriend + "<br>";
            $('#horoscope-paragraph').append(horoScope);
        }
        function resetHoroscope(textInputs) {
            $('#horoscope-paragraph').text('');
            $("input[type=text]").val('');
            $("input[type=text]").removeClass("is-valid");
            $('#horoscope-paragraph').hide();
            $('#btn-reset-horoscope').hide();
            let instructions = $("#instructionsHidden").val();
            $('#horoscope-heading2').text(instructions);
            $('#user-input-table').show();
            $('#btn-submit-horoscope').show();
        }
        function ValidateWord(word, ing) {
            if(ing){
                let substring = word.substr(-3);
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

