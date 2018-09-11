$(function() {
  // Default editor example
  $('#summernote').summernote({
    minHeight: null,
    maxHeight: 200,
  });

  // Air-Mode example
  $('#summernote-airmode').summernote({airMode: true});

  // Custom Toolbar example
  $('#summernote-custom-toolbar').summernote({
    placeholder: 'Write here...',
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ]
  });

  // Click to edit example
  var edit = function() {
    $('#summernote-click-to-edit').summernote({focus: true});
  };

  var save = function() {
    var makrup = $('#summernote-click-to-edit').summernote('code');
    $('#summernote-click-to-edit').summernote('destroy');
  };

  $('#edit-btn').on('click', function() {
    edit();
  }), $('#save-btn').on('click', function() {
    save();
  });
});