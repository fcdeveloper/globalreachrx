(function($) {

	$.noty.layouts.topCenter = {
		name: 'topCenter',
		options: { // overrides options

		},
		container: {
			object: '<ul id="noty_topCenter_layout_container" />',
			selector: 'ul#noty_topCenter_layout_container',
			style: function() {
				$(this).css({
					top: 50,
					left: 0,
					position: 'fixed',
					width: '500px',
					height: 'auto',
					margin: 0,
					padding: 0,
					listStyleType: 'none',
					zIndex: 10000000
				});

				$(this).css({
					left: ($(window).width() - $(this).outerWidth(false)) / 2 + 'px'
				});
			}
		},
		parent: {
			object: '<li />',
			selector: 'li',
			css: {}
		},
		css: {
			top: 50,
			display: 'none',
			width: '500px'
		},
		addClass: ''
	};

})(jQuery);
