!function() { "use strict";
	$('[data-plugin="owlCarousel"]').each(function() {
	  var $this     = $(this);
	  var defaults  = {
	    slideSpeed : 300,
	    paginationSpeed : 400,
	    singleItem: !0,
	    autoPlay: !0
	  };
	  var _config = $.extend({}, defaults, $this.data());

	  if (typeof $.fn.owlCarousel === 'function') {
	    $this.owlCarousel(_config);
	  }
	});

	$('#form-switch-btns').on('click', '.btn', function (e) {
		var $target 			= $($(this).data('target'));
		var siblingTarget = $(this).attr('disabled', true)
			.siblings('.btn')
			.removeAttr('disabled')
			.data('target');
			
		$target.addClass('show') && $(siblingTarget).removeClass('show');
	});
}();