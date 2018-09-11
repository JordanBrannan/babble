! function(window, document, $) { "use strict";
  var $body   = $(document.body);
  var $navbar = $('.site-navbar');

  /*
  * navbar module
  */
  site.navbar = {
    init: function() {
      !/xl/.test(Breakpoints.current().name) && this.searchForm.clone();
    },
    change: function() {
      if (/xl/.test(Breakpoints.current().name)) {
        this.searchForm.remove();
      } else {
        this.searchForm.clone();
      }
    },
    searchForm: {
      cloned: !1,
      clone: function() {
        if (! this.cloned) {
          $navbar.find('.navbar-search').clone().appendTo('body'), this.cloned = !0;
        }
      },
      remove: function() {
        $body.find('> .navbar-search').remove(), this.cloned = !1;
      }
    }
  };
}(window, document, jQuery);