!function(window, document, $) {
	"use strict";
	var pluginDefaults = {
		owlCarousel: {
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem: !0,
			autoPlay: !1
		},
		switchry: {
			color: '#188ae2',
			jackColor: '#ffffff',
			size: 'default'
		}
	};

	window.site = {
		initHeaderCharts: function() {
			if (typeof $.fn.sparkline === 'function') {
				var sparklineBar = function (selector, data, options) {
					options.type = 'bar';
					options.height = 30;
					options.barColor = $.colors.primary;
					options.barSpacing = 2;
					options.chartRangeMin = 0;
					$(selector).sparkline(data, options);
				}
				sparklineBar('#jumbotron_chart_1', [5,4,2,7,8,5,6,7,10,9], {
					highlightColor: $.colors.warning
				}), sparklineBar('#jumbotron_chart_2', [5,4,2,7,8,5,6,7,10,9], {
					highlightColor: $.colors.danger
				}), sparklineBar('#jumbotron_chart_3', [5,4,2,7,8,5,6,7,10,9], {
					highlightColor: $.colors.success
				});
			}
		},
		initPlugins: function() {
			$('[data-plugin]').each(function() {
				var $this = $(this);
				var plugin = $this.data('plugin');

				if (typeof $.fn[plugin] === 'function') {
					var defaults = pluginDefaults[plugin] || {};
					$.fn[plugin].call($this, $.extend({}, defaults, $this.data()));
				}
			});

			$('[data-toggle="class"]').each(function() {
				var $this = $(this);
				var target = $this.data('target') || $this.attr('href');
				var $target = $(target);
				var className = $this.data('class') || 'show';
				
				$this.on('click', function(e) {
					$target.toggleClass(className);
					e.preventDefault();
				});
			});

			$('[data-plugin="switchery"]').each(function() {
				var defaults = pluginDefaults['switchry'] || {};
				new Switchery(this, $.extend({}, defaults, $(this).data()));
			});

			$('[data-toggle="video-modal"]').videoModal();
			$('[data-toggle="tooltip"]').tooltip();
		}
	}, $.colors = {
		primary   : "#39527b",
		success   : "#60c84c",
		info      : "#58d9e1",
		warning   : "#ffc952",
		danger    : "#ff7473",
		white     : "#ffffff"
	};
}(window, document, jQuery);