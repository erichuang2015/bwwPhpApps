$(document).ready(function() {
    "use strict";
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

	var form = $("form.img-card");
	var album = $("div.album");
	if(!form[0]){
		$(album).hide();
	}else{
		$(album).show();
    }

    $("#optionChoice").on("change", function () {
        var selectElement = $("#optionChoice");
        var selectedIndex = selectElement[0].selectedIndex;
        if (selectedIndex > 0) {
            $("#submit").removeAttr("disabled");
        } else {
            $("#submit").attr("disabled", "true");
        }
    });

    $("#userfile").on("change", function(){
        var userFile = $("#userfile");
        // console.log(userFile);
        // console.log(userFile[0].files[0].length);
        if(userFile.length > 0){
            $("#submitBtn").removeAttr("disabled");
            //$("#cancelBtn").css("display", "block");
            $("#cancelBtn").show();
        } else {
            $("#submitBtn").attr("disabled", "true");
        }
    });

    $("#cancelBtn").on("click, keyup", function(e){
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32) {
            window.history.back();
        }
    });
});