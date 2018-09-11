! function(window, document, $) { "use strict";
  var $body     = $(document.body);
  var $menubar  = $('.site-menubar');
  
  /*
  * menubar module
  */
  site.menubar = {
    opened: !1,
    init: function() {
      this.change();
    },
    hide: function() {
      this.opened === !0 && $body.removeClass('menubar-open'), this.opened = !1;
    },
    open: function() {
      this.opened === !1 && $body.addClass('menubar-open'), this.opened = !0;
    },
    toggle: function() {
      this.opened === !0 ? this.hide() : this.open();
    },
    change: function() {
      if (/xl/.test(Breakpoints.current().name)) {
        this.open();
      } else {
        this.hide();
      }
    },
    menu: {
      slideSpeed: 500,
      toggleOnClick: function($toggle) {
        $toggle.parent().toggleClass('open').find('> .submenu').slideToggle(this.slideSpeed).end().siblings().removeClass('open').find('> .submenu').slideUp(this.slideSpeed);
      }
    }
  };
}(window, document, jQuery);
