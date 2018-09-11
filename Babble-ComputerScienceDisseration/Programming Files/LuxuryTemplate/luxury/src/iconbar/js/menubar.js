! function(window, document, $) { "use strict";
  var $body     = $(document.body);
  var $menu     = $('.site-menu');
  var $menubar  = $('.site-menubar');
  
  /*
  * menubar module
  */
  site.menubar = {
    opened: !1,
    folded: !1,
    init: function() {
      var breakpoint = Breakpoints.current().name;
      
      $body.is('.menubar-fold') && (this.folded = !0),
      /xs|sm/.test(breakpoint)  && this.folded === !0 && $body.removeClass('menubar-fold'),
      /md|lg/.test(breakpoint)  && this.fold(),
      !/xs|sm/.test(breakpoint) && this.menu.addMenuName(),
      $('[data-toggle="menubar"]').toggleClass('is-active', this.opened),
      $('[data-toggle="menubar-fold"]').toggleClass('is-active', !this.folded);
    },
    fold: function() {
      $body.addClass('menubar-fold'), this.folded = !0;
    },
    unFold: function() {
      $body.removeClass('menubar-fold'), this.folded = !1;
    },
    toggleFold: function() {
      this.folded === !0 ? this.unFold() : this.fold();
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
      var breakpoint = Breakpoints.current().name;
      if (/xl/.test(breakpoint)) {
        this.unFold();
      } else if (/md|lg/.test(breakpoint)) {
        this.fold();
      } else {
        this.hide(), this.folded === !0 && this.unFold();
      }

      if (/xs|sm/.test(breakpoint)) {
        this.menu.removeMenuName();
      } else {
        this.menu.addMenuName();
      }
    },
    menu: {
      slideSpeed: 500,
      addMenuName: function() {
        if ($menu.find('.submenu-fake').length > 0) return;
        $menu.children('li:not(.menu-section-heading)').each(function() {
          var $this = $(this),
              $anchore = $this.find('> a'),
              link = $anchore.attr('href'),
              text = $anchore.find('> .menu-text').text();
          $this.find('> .submenu').length > 0 || $this.append('<ul class="submenu submenu-fake"></ul>');
          $this.find('> .submenu').prepend('<li class="menu-heading"><a href="'+link+'">'+text+'</a></li>');
        });
      },
      removeMenuName: function() {
        $menu.find('.submenu-fake').remove();
      },
      toggleOnClick: function($toggle) {
        $toggle.parent().toggleClass('open').find('> .submenu').slideToggle(this.slideSpeed).end().siblings().removeClass('open').find('> .submenu').slideUp(this.slideSpeed);
      },
      toggleOnHover: function($toggle) {
        /md|lg|xl/.test(Breakpoints.current().name) &&
        $toggle.toggleClass('open').siblings('li').removeClass('open');
      }
    }
  };
}(window, document, jQuery);
