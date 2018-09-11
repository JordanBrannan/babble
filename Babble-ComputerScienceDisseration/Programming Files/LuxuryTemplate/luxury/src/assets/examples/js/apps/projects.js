!function() { "use strict";

	// Picks task Due date
	$('input[name="task_due_date"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		autoUpdateInput: false
	});

	$('input[name="task_due_date"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format('MM/DD/YYYY'));
	});

	$('input[name="task_due_date"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
}();