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
        if(userFile.length > 0){
            var fileType = userFile[0].files[0].type;
            if(fileType == "image/jpeg" || fileType == "image/png"){
                $("#submitBtn").removeAttr("disabled");
                $(userFile).removeClass("is-invalid");
                $(userFile).addClass("is-valid");
                $("#cancelBtn").show();
            }
            else{
                $("#submitBtn").attr("disabled", "true");
                $(userFile).removeClass("is-valid");
                $(userFile).addClass("is-invalid");
                $("#userFileError").text("Error: Please only upload jpeg or png image files.");
            }

        } else {
            $("#submitBtn").attr("disabled", "true");
            $(userFile).removeClass("is-valid");
            $(userFile).addClass("is-invalid");
            $("#userFileError").text("Error: Please select an image to upload.");
        }
    });

    $("#cancelBtn").on("click, keyup", function(e){
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32) {
            window.history.back();
        }
    });
});