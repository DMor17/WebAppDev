		$(window).scroll(function(){    
		 var  triggerPoint = 10;
			  offset = $(document).scrollTop();
		 if ( offset > triggerPoint )
			 $("body").addClass("nav-toggle");
		 else
			 $("body").removeClass("nav-toggle");
		});
		
		(function ($) {

		var TRIGGER_POINT_PX = 10;
		var TOGGLE_SPEED = 300;

		function onValueChange(initialValue, func) {
			return function (newValue) {
				if (initialValue !== newValue) {
					initialValue = newValue;
					func(newValue);
				}
			};
		}