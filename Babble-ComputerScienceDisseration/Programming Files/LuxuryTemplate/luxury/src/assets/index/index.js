window.addEventListener('load', function() {
  document.body.classList.add('loading-done');
});

$(function() {
    if (typeof $.settings !== "undefined") {
        localStorage.clear(), $.settings.init(),
        $(document).on('click', '[data-toggle="theme"]', function(e) {
            $.settings.set("menubar", {
                type: $(this).data('menubarType')
            });
            if ($(this).data('navbarType')) {
                $.settings.set("navbar", {
                    type: $(this).data('navbarType'),
                    skin: $(this).data('navbarSkin')
                })
            }
            $.settings.save();
        });
    }
});