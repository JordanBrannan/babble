$(function() {
  // sticky demos page header
  new Waypoint.Sticky({
    element: $('.demo-header'),
    offset: 64
  });

  $('#contents-heading').on('click', function() {
    $('#contents-index').slideToggle(500);
  });
});