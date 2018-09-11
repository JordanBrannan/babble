$(function() {
  var options = {
    backgroundColor: 'none',
    colors: {
      primary   : "#4D92B2",
      success   : "#60c84c",
      info      : "#7FB5CE",
      warning   : "#ffc952",
      danger    : "#ff7473",
      faded     : '#EEEEEE'
    }
  };

  // World
  $('#vmap-world').length > 0 && $('#vmap-world').vectorMap({
    map: 'world_en',
    backgroundColor: options.backgroundColor,
    hoverOpacity: 0.7,
    selectedColor: options.colors.warning,
    enableZoom: true,
    showTooltip: true,
    scaleColors: ['#C8EEFF', '#006491'],
    values: sample_data,
    normalizeFunction: 'polynomial'
  }),

  // Africa
  $('#vmap-africa').length > 0 && $('#vmap-africa').vectorMap({
    map: 'africa_en',
    backgroundColor: options.backgroundColor,
    hoverOpacity: 0.7,
    selectedColor: options.colors.success,
    enableZoom: true,
    showTooltip: true,
    values: sample_data,
    scaleColors: ['#C8EEFF', '#006491'],
    normalizeFunction: 'polynomial'
  }),

  // Asia
  $('#vmap-asia').length > 0 && $('#vmap-asia').vectorMap({
    map: 'asia_en',
    backgroundColor: options.backgroundColor,
    hoverOpacity: 0.7,
    selectedColor: options.colors.danger,
    enableZoom: true,
    showTooltip: true,
    values: sample_data,
    scaleColors: ['#C8EEFF', '#006491'],
    normalizeFunction: 'polynomial'
  }),

  // USA
  $('#vmap-usa').length > 0 && $('#vmap-usa').vectorMap({
    map: 'usa_en',
    backgroundColor: options.backgroundColor,
    color: options.colors.primary,
    enableZoom: true,
    showTooltip: true,
    selectedColor: options.colors.success,
    hoverColor: options.colors.success,
    colors: {
      mo: options.colors.info,
      fl: options.colors.info,
      or: options.colors.info
    },
    onRegionClick: function(event, code, region){
      event.preventDefault();
    }
  }),

  // Russia
  $('#vmap-russia').length > 0 && $('#vmap-russia').vectorMap({
    map: 'russia_en',
    backgroundColor: options.backgroundColor,
    color: options.colors.info,
    hoverOpacity: 0.7,
    selectedColor: options.colors.warning,
    enableZoom: true,
    showTooltip: true,
    colors: {
      ya: options.colors.primary,
      sa: options.colors.primary,
      ko: options.colors.primary
    },
    scaleColors: ['#C8EEFF', '#006491'],
    normalizeFunction: 'polynomial'
  });
});