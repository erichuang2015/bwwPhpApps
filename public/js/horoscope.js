/*jshint esversion: 6 */
$(document).ready(function () {
    "use strict";
    // run test on initial page load
    var size = checkSize();
    if(size === "small"){
        $("#largeScreenDisplay").hide();
        $("#smallScreenDisplay").show();
    }else{
        $("#largeScreenDisplay").show();
        $("#smallScreenDisplay").hide();
    }

    // run test on resize of the window
    $(window).on("resize", function(){
        var windowSize = checkSize();
        if(windowSize === "small"){
            $("#largeScreenDisplay").hide();
            $("#smallScreenDisplay").show();
        }else{
            $("#largeScreenDisplay").show();
            $("#smallScreenDisplay").hide();
        }
    });

    $("#divHoroscopeResults").hide();
    let myHoroscopeGen;
    $("#btn-submit-horoscope").on("click keyup", function (e) {
        e.preventDefault();
        myHoroscopeGen = new HoroscopesGenerator();
        myHoroscopeGen.setHoroscopeData();
        $("#btn-submit-horoscope").hide();
        $("#divHoroscopeResults").show();
        $("#horoscope-heading2").focus();
    });

    $("#btn-reset-horoscope").on("click keyup", function (e) {
        e.preventDefault();
        myHoroscopeGen.resetHoroscope();
        $("#divHoroscopeResults").hide();
        $("#btn-submit-horoscope").show(); 
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
        this.validateHoroscopeData = validateHoroscopeData; //The this keyword makes this method public
        this.setHoroscopeData = setHoroscopeData; //The this keyword makes this method public
        this.displayHoroscope = displayHoroscope; //The this keyword makes this method public
        this.resetHoroscope = resetHoroscope; //The this keyword makes this method public
        function validateHoroscopeData() {
            let valid = true;
            let txt = "";
            let x;
            for (x in _horoscopeData) {
                for (let i = 0; i < _horoscopeData[x].length; i++) {
                    if (i === 16) {
                        continue;
                    }
                    //console.log(_horoscopeData[x].charAt(i));
                    // 65-90 A-Z & 97-122 a-z
                    valid = (_horoscopeData[x].charAt(i) > 64 && _horoscopeData[x].charAt(i) < 123) ? true : true; // both true to turn validation off
                    if (valid === false) {
                        alert("That's not a string!");
                        break;
                    }
                }
                if (valid === false) {
                    break;
                }
            }
            return valid;
        }
        function setHoroscopeData() {
            _horoscopeData.one =
                $('#one').val();
            _horoscopeData.two =
                $('#two').val();
            _horoscopeData.three =
                $('#three').val();
            _horoscopeData.four =
                $('#four').val();
            _horoscopeData.five =
                $('#five').val();
            _horoscopeData.six =
                $('#six').val();
            _horoscopeData.seven =
                $('#seven').val();
            _horoscopeData.eight =
                $('#eight').val();
            _horoscopeData.nine =
                $('#nine').val();
            _horoscopeData.ten =
                $('#ten').val();
            _horoscopeData.eleven =
                $('#eleven').val();
            _horoscopeData.twelve =
                $('#twelve').val();
            _horoscopeData.thirteen =
                $('#thirteen').val();
            _horoscopeData.fourteen =
                $('#fourteen').val();
            _horoscopeData.fifteen =
                $('#fifteen').val();
            _horoscopeData.sixteen =
                $('#sixteen').val();
            _horoscopeData.seventeen =
                $('#seventeen').val();
            _horoscopeData.eighteen =
                $('#eighteen').val();
            let validHoroscopeData = validateHoroscopeData();
            (validHoroscopeData) ? displayHoroscope() : "";
        }
        function displayHoroscope() {
            $('#horoscope-heading2').text('Today\'s Horoscopes');
            $('#user-input-table').hide();
            $('#horoscope-paragraph').removeAttr('hidden').show();
            $('#btn-submit-horoscope').hide();
            $('#btn-reset-horoscope').removeAttr('hidden').show();
            let horoScope = "";
            let geminiFirstLetter = _horoscopeData.four.charAt(0).toUpperCase();
            _horoscopeData.four =
                _horoscopeData.four.replace(_horoscopeData.four.substr(0, 1), geminiFirstLetter);
            let cancerFirstLetter = _horoscopeData.five.charAt(0).toUpperCase();
            _horoscopeData.five =
                _horoscopeData.five.replace(_horoscopeData.five.substr(0, 1), cancerFirstLetter);
            let virgoFirstLetter = _horoscopeData.eight.charAt(0).toUpperCase();
            _horoscopeData.eight =
                _horoscopeData.eight.replace(_horoscopeData.eight.substr(0, 1), virgoFirstLetter);
            horoScope = "<span class='sign'>Aries — Ram (March 21-April 19)</span><br>Someone you know may be feeling " + _horoscopeData.one + ". Stay out of the way!<br><br><span class='sign'>Taurus — Bull (April 20-May 20)</span><br>Don't " + _horoscopeData.two + " in public. It could prove embarrassing.<br><br><span class='sign'>Gemini — Twins (May 21-June 20)</span><br>Control the urge to " + _horoscopeData.three + ". " + _horoscopeData.four + " instead.<br><br><span class='sign'>Cancer — Crab (June 21-July 22)</span><br>" + _horoscopeData.five + " too many " + _horoscopeData.six + " will leave you exhausted!<br><br><span class='sign'>Leo — Lion (July 23-August 22)</span><br>A loved one thinks you are " + _horoscopeData.seven + ". Do not be taken in by flattery.<br><br><span class='sign'>Virgo — Virgin (August 23-September 22)</span><br>" + _horoscopeData.eight + " in private when possible. It's difficult to concentrate when people are watching.<br><br><span class='sign'>Libra— Scales (September 23-October 22)</span><br>Avoid " + _horoscopeData.nine + " " + _horoscopeData.ten + ".<br><br><span class='sign'>Scorpio — Scorpion (October 23-November 21)</span><br>Never loan money to " + _horoscopeData.eleven + " " + _horoscopeData.twelve + "! They are poor credit risks.<br><br><span class='sign'>Sagittarius — Archer (November 22-December 21)</span><br>Today is a good day to " + _horoscopeData.thirteen + " a(n) " + _horoscopeData.fourteen + ".<br><br><span class='sign'>Capricorn — Goat (December 22-January 19)</span><br>You may receive some " + _horoscopeData.fifteen + " from a secret admirer! Water them every day, and they will last a long time.<br><br><span class='sign'>Aquarius — Water Bearer (January 20-February 18)</span><br>Unless you organize your " + _horoscopeData.sixteen + " better, you won't get anything done.<br><br><span class='sign'>Pisces — Fish (February 19-March 20)</span><br>A good friend will give you $" + _horoscopeData.seventeen + " to buy new " + _horoscopeData.eighteen + ". Be sure to thank your friend.<br>";
            $('#horoscope-paragraph').append(horoScope);
        }
        function resetHoroscope() {
            $('#horoscope-paragraph').text('');
            $('#horoscope-paragraph').hide();
            $('#btn-reset-horoscope').hide();
            $('#horoscope-heading2').text('The fields below have been pre-filled out for you, but you can change the values to what every you want.  The program will use these values to determine the horoscopes.');
            $('#user-input-table').show();
            $('#btn-submit-horoscope').show();
        }
        Object.freeze(this);
    }
}

