! function(window, document, $) { "use strict";
  $.extend(window.site, {
    init: function () {
      // Init site.navbar && site.menubar
      if (typeof site.menubar !== "undefined" && typeof site.navbar !== "undefined") {
        site.navbar.init(), site.menubar.init(), $(document).on('click', '.hamburger', function(e){
          $(this).toggleClass('is-active');
        }), $(document).on('click', '[data-toggle="menubar"]', function(e) {
          site.menubar.toggle(), e.preventDefault();
        }), $(document).on('click', '.submenu-toggle', function(e) {
          site.menubar.menu.toggleOnClick($(this)), e.preventDefault();
        }), $(document).on("click", '[data-toggle="collapse"]', function(e) {
          var $trigger = $(e.target);
          $trigger.is('[data-toggle="collapse"]') || ($trigger = $trigger.parents('[data-toggle="collapse"]'));
          var $target = $($trigger.attr('data-target'));
          $target.attr('id') === 'site-navbar-collapse' && $('body').toggleClass('navbar-collapse-in'), e.preventDefault();
        }), $(document).on('click', '[data-toggle="navbar-search"]', function(e) {
          $('.navbar-search').toggleClass('show'), e.preventDefault();
        }), Breakpoints.on('change', function() {
          site.navbar.change(), site.menubar.change(),
          $('[data-toggle="menubar"]').toggleClass('is-active', site.menubar.opened);
        });
      }

      // init scroll containers
      !/xs|sm/.test(Breakpoints.current().name) && $('.scroll-container').perfectScrollbar();
      // init charts in the site header
      this.initHeaderCharts();
      // init other plugins
      this.initPlugins();
    }
  });
}(window, document, jQuery);


$(function() {
  site.init();
});
