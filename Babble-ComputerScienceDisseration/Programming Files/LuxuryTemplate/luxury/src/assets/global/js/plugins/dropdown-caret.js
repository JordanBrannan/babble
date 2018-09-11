"use strict";

!function($) {
  $.fn.dropdownCaret = function (config) {
    return this.each(function () {
      var $this   = $(this);
      var _config = $.extend(
        {},
        $.fn.dropdownCaret.defaults,
        $this.data(),
        typeof config === 'object' && config
      );
      var $parent = $this.closest(_config.parent);
      var width   = $parent.width();
      var attrs   = _config.style || {};
      var length  = Math.ceil(width / 2) - 12;

      if (_config.right || $this.is('.dropdown-menu-right') || $this.is('.float-right')) {
        $.extend(attrs, {
          right: length + 'px',
          left : 'auto'
        });
      } else {
        $.extend(attrs, {
          left : length + 'px',
          right: 'auto'
        });
      }
      $('<span class="'+_config.class+'"></span>').css(attrs).prependTo($this);
    });
  };

  $.fn.dropdownCaret.defaults = {
    parent: '.dropdown',
    class : 'arrow',
    right : false
  };
}(jQuery);
