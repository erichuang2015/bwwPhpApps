//$(document).ready(function ()
//{
//    var url = "http://api.flickr.com/services/feeds/photos_public.gne?id=147028526@N03&format=json&jsoncallback=?";
//    var id = "#photos";
//    var myImageImporter = new ImageImporter(url, id);
//    myImageImporter.getData();
//    myImageImporter.print();
//});

//$(document).ready(function ()
//{
//    var url = "https://api.flickr.com/services/feeds/photos_public.gne?" +
//            "format=json&jsoncallback=?&id=147028526@N03";
//
//    $.getJSON(url, function (data)
//    {
//        var html = "";
//        $.each(data.items, function (i, item)
//        {
//            html += "<h2>" + item.title + "</h2>";
//            html += "<img src=" + item.media.m + ">";
//            html += "<p></p>";
//        });
//        $("#photos").html(html);
//    });
//});

$(document).ready(function() {
    "use strict";
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

	// var nextSlide = $("#slides img:first-child");
	// var nextCaption;
	// var nextSlideSource;
		
	// // Start slide show
    // timer1 = setInterval(
    //     function () {   
    //     	$("#caption").fadeOut(1000);
    //     	$("#slide").fadeOut(1000,
    //        		function () {
    //        	     	if (nextSlide.next().length == 0) {
	// 					nextSlide = $("#slides img:first-child");
	// 				}
	// 				else {
	// 					nextSlide = nextSlide.next();
	// 				}
	// 				nextSlideSource = nextSlide.attr("src");
	// 				nextCaption = nextSlide.attr("alt");
	// 				$("#slide").attr("src", nextSlideSource).fadeIn(1000);					
	// 				$("#caption").text(nextCaption).fadeIn(1000);
	// 			}
	// 		)
	// 	}, 
	// 	3000
	// );
});