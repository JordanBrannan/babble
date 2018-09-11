"use strict";

!function($) {
	$.fn.videoModal = function(config) {
		return this.each(function() {
			var $this   = $(this);
			var _config = $.extend(
				{},
				$.fn.videoModal.defaults,
				$(this).data(),
				typeof config === 'object' && config
				);
			var $modal        = $(_config.target);
			var $modalContent = $modal.find('.modal-content');
			var $iframe       = $modal.find('iframe');
			var iSRC          = $iframe.attr('src');
			var videoSRC      = _config.autoplay === true ? 
			_config.src + '?autoplay=1' : _config.src;

			$this.on('click', function(e) {
				e.preventDefault(), $modal.modal('show');

				if (videoSRC) {
					$iframe.attr('src', videoSRC);
				} else {
					var message = 'You must specify the video source in the <code>data-src</code> attribute';
					$modalContent.addClass('d-none');
					$modal.find('.modal-dialog').append('<div class="alert alert-danger fz-base font-weight-normal">'+message+'</div>');
					throw new Error(message);
				}
			});

			$modal.on('hidden.bs.modal', function() {
				if ($modalContent.is('.d-none')) {
					$modal.find('.alert').remove(),
					$modalContent.removeClass('d-none');
				} else {
					$iframe.attr('src', iSRC);
				}
			});
		});
	};

	$.fn.videoModal.defaults = {
		autoplay: true
	};
}(jQuery);
