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
});