"use strict";

!function($) {
  $.fn.firstLitter = function(config) {
    return this.each(function() {
      var $this   = $(this);
      var _config = $.extend(
        {},
        $.fn.firstLitter.defaults,
        $this.data(),
        typeof config === 'object' && config
      );

      var text        = $(_config.target).text() || $this.text();
      var firstLitter = text.charAt(0);

      _config.upperCase && (firstLitter = firstLitter.toUpperCase()),
      _config.lowerCase && (firstLitter = firstLitter.toLowerCase()), 

      $this.text(firstLitter);
    });
  };

  $.fn.firstLitter.defaults = {
    upperCase: true,
    lowerCase: false
  };
}(jQuery);
