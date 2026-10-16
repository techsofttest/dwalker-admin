$(document).ready(function(){
	$('#menu').slicknav();
});


// For Banner Section //
//$(window).load(function() {
//  $('.flexslider').flexslider({
//    animation: "fade"
//  });
//});

// ===== Scroll to Top ==== 
$(document).ready(function() {
	// Show or hide the sticky footer button
	$(window).scroll(function() {
		if ($(this).scrollTop() > 200) {
			$('.go-top').fadeIn(200);
			} else {
			$('.go-top').fadeOut(200);
			}
			});
			
		// Animate the scroll to top
		$('.go-top').click(function(event) {
			event.preventDefault();
			
			$('html, body').animate({scrollTop: 0}, 300);
	})
});

//===================== Equal Height ============================//

equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('.envBox');
  equalheight('.mileBox');
});


$(window).resize(function(){
  equalheight('.envBox');
  equalheight('.mileBox');
});


// ==================== Show product description =========================//

$(".btnContent").fancybox();