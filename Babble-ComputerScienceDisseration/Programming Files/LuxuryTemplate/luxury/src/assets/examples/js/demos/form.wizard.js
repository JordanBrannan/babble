$(function() {
	/*
	* For Simplisty each example is wrapped
	* into a self-invoking function
	*/

	// First Example (inline)
	!function() {
		var $validator = $("#bootstrap-wizard-form").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				name: {
					required: true,
					minlength: 3
				},
				country: "required",
				city: "required",
				payment_method: "required",
				spending: {
					required: true,
					number: true
				},
				services: "required",
				message: {
					required: true,
					minlength: 6,
					maxlength: 140
				}
			},
			errorElement: "div",
			errorPlacement: function (error, element) {
				error.addClass("form-control-feedback");

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
		 
		function isValid() {
			if (!$("#bootstrap-wizard-form").valid()) {
				$validator.focusInvalid();
				return false;
			} else {
				return true;
			}
		}

		$('#bootstrap-wizard-1').bootstrapWizard({
			tabClass: 'nav-tabs',
			nextSelector: '.pager>.btn.next',
			previousSelector: '.pager>.btn.previous',
			onTabShow: function(tab, navigation, index) {
				$(tab).addClass('visited');
				var $finishBtn = $('#finish-btn');
				var $nextBtn = $('#next-btn');
				var total = navigation.find('li').length;

				if (index + 1 == total) {
					$finishBtn.show();
					$nextBtn.hide();
				} else {
					$finishBtn.hide();
					$nextBtn.show();
				}
			},
			onTabClick: function() {
				return isValid();
			},
			onPrevious: function(tab, navigation, index) {
				$(tab).removeClass('visited');
			},
			onNext: function(tab, navigation, index) {
				return isValid();
			}
		});

		$('#finish-btn').on('click', function(e) {
			if (isValid()) {
				swal("Good job!", "Thanks for your time taking this surve", "success");
			} else {
				swal("Faild", "Please fill in all fields", "error");
			}
		});
	}(),
	// wizard-small-vertex-demo
	function() {
		$('#wizard-small-vertex-demo').bootstrapWizard({
			tabClass: 'nav-tabs',
			nextSelector: '.pager>.btn.next',
			previousSelector: '.pager>.btn.previous',
			onTabShow: function(tab, navigation, index) {
				$(tab).addClass('visited');
			},
			onTabClick: function() {
				return false;
			},
			onPrevious: function(tab, navigation, index) {
				$(tab).removeClass('visited');
			}
		});
	}(),
	// wizard-circle-vertex-demo
	function() {
		$('#wizard-circle-vertex-demo').bootstrapWizard({
			tabClass: 'nav-tabs',
			nextSelector: '.pager>.btn.next',
			previousSelector: '.pager>.btn.previous',
			onTabShow: function(tab, navigation, index) {
				$(tab).addClass('visited');
			},
			onTabClick: function() {
				return false;
			},
			onPrevious: function(tab, navigation, index) {
				$(tab).removeClass('visited');
			}
		});
	}(),
	// wizard-keep-prefix-suffix-demo
	function() {
		$('#wizard-keep-prefix-suffix-demo').bootstrapWizard({
			tabClass: 'nav-tabs',
			nextSelector: '.pager>.btn.next',
			previousSelector: '.pager>.btn.previous',
			onTabShow: function(tab, navigation, index) {
				$(tab).addClass('visited');
			},
			onTabClick: function() {
				return false;
			},
			onPrevious: function(tab, navigation, index) {
				$(tab).removeClass('visited');
			}
		});
	}(),
	// wizard-basic-demo
	function() {
		$('#wizard-basic-demo').bootstrapWizard({
			tabClass: 'nav-tabs',
			nextSelector: '.pager>.btn.next',
			previousSelector: '.pager>.btn.previous',
			onTabShow: function(tab, navigation, index) {
				$(tab).addClass('visited');
			},
			onPrevious: function(tab, navigation, index) {
				$(tab).removeClass('visited');
			}
		});
	}(),
	// Modal Example
	function() {
		$('#modal-wizard').bootstrapWizard({
			tabClass: 'nav-tabs',
			nextSelector: '.pager>.btn.next',
			previousSelector: '.pager>.btn.previous',
			onTabShow: function(tab, navigation, index) {
				$(tab).addClass('visited');
			},
			onPrevious: function(tab, navigation, index) {
				$(tab).removeClass('visited');
			},
		});
	}();
});