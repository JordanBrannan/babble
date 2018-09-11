// Reference - https://themeforest.net/item/luxury-responsive-bootstrap-4-admin-template/20881509

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