! function(window, document, $) { "use strict";
  var $body     = $(document.body);
  var $menubar  = $('.site-menubar');

  /*
  * menubar module
  */
  site.menubar = {
    top: !0,
    opened: !1,
    init: function() {
      this.change();
    },
    hide: function() {
      $body.removeClass('menubar-open'), this.opened = !1;
    },
    open: function() {
      $body.addClass('menubar-open'), this.opened = !0;
    },
    toggle: function() {
      this.opened === !0 ? this.hide() : this.open();
    },
    change: function() {
      if (/xs|sm|md/.test(Breakpoints.current().name)) {
        this.switchLeft(), this.sticky.disable();
      } else {
        this.switchTop(), this.sticky.enable();
      }
    },
    switchLeft: function() {
      this.top === !0 && $body.removeClass('menubar-top').addClass('menubar-left'), this.top = !1;
    },
    switchTop: function() {
      this.top === !1 && $body.removeClass('menubar-left').addClass('menubar-top'), this.top = !0;
    },
    sticky: {
      enabled: !1,
      sticky: null,
      offset: 64,
      enable: function() {
        if (!this.enabled && typeof Waypoint.Sticky === 'function') {
          this.sticky = new Waypoint.Sticky({
            element: $menubar,
            offset: this.offset
          }), this.enabled = !0;
        }
      },
      disable: function() {
        this.enabled && this.sticky.destroy(), this.enabled = !1, this.sticky = null;
      }
    },
    menu: {
      slideSpeed: 500,
      toggleOnClick: function($toggle) {
        /xs|sm/.test(Breakpoints.current().name) &&
        $toggle.parent().toggleClass('open').find('> .submenu').slideToggle(this.slideSpeed).end().siblings().removeClass('open').find('> .submenu').slideUp(this.slideSpeed);
      }
    }
  };
}(window, document, jQuery);
