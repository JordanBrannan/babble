$(function() { "use strict";

    /*
    * Each Example is wrapped within a self-invoking function
    */

    // #parsleyjs-example-1
    !function() {
      $('#parsleyjs-example-1').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.alert-info').toggleClass('d-none', !ok);
        $('.alert-warning').toggleClass('d-none', ok);
      })
      .on('form:submit', function() {
        return false; // Don't submit form for this demo
      });
    }(),
    // #parsleyjs-example-2
    function() {
      var $sections = $('.form-section');

      function navigateTo(index) {
        // Mark the current section with the class 'current'
        $sections
          .removeClass('current')
          .eq(index)
            .addClass('current');
        // Show only the navigation buttons that make sense for the current section:
        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);
      }

      function curIndex() {
        // Return the current index by looking at which section has the class 'current'
        return $sections.index($sections.filter('.current'));
      }

      // Previous button is easy, just go back
      $('.form-navigation .previous').click(function() {
        navigateTo(curIndex() - 1);
      });

      // Next button goes forward iff current block validates
      $('.form-navigation .next').click(function() {
        if ($('#parsleyjs-example-2').parsley().validate({group: 'block-' + curIndex()}))
          navigateTo(curIndex() + 1);
      });

      // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
      $sections.each(function(index, section) {
        $(section).find(':input').attr('data-parsley-group', 'block-' + index);
      });
      navigateTo(0); // Start at the beginning
    }(),
    // #jq-validation-example-1 Example
    !function() {
        $("#jq-validation-example-1").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                agree: "required"
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            },
            errorElement: "div",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("form-control-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent(".checkbox"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).closest(".form-group").addClass("has-danger").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).closest(".form-group").addClass("has-success").removeClass("has-danger");
            }
        });
    }(),
    // #jq-validation-example-2 Example
    function() {
        $("#jq-validation-example-2").validate({
            rules: {
                firstname1: "required",
                lastname1: "required",
                username1: {
                    required: true,
                    minlength: 2
                },
                password1: {
                    required: true,
                    minlength: 5
                },
                confirm_password1: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password1"
                },
                email1: {
                    required: true,
                    email: true
                },
                agree1: "required"
            },
            messages: {
                firstname1: "Please enter your firstname",
                lastname1: "Please enter your lastname",
                username1: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password1: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password1: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email1: "Please enter a valid email address",
                agree1: "Please accept our policy"
            },
            errorElement: "div",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("form-control-feedback");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.closest(".form-group").addClass("has-danger");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent(".checkbox"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).closest(".form-group").addClass("has-danger").removeClass("has-success");
                $(element).removeClass('form-control-success').addClass('form-control-danger');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).closest(".form-group").addClass("has-success").removeClass("has-danger");
                $(element).removeClass('form-control-danger').addClass('form-control-success');
            }
        });
    }();
});