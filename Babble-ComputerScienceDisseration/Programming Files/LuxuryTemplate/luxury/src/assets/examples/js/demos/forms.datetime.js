$(function() {
	!function() {
		$('#daterange-ex-2').daterangepicker({
			timePicker: true,
			timePickerIncrement: 30,
			locale: {
				format: 'MM/DD/YYYY h:mm A'
			}
		});

		$('#daterange-ex-3').daterangepicker({
		    singleDatePicker: true,
		    showDropdowns: true
		},

		function(start, end, label) {
		    var years = moment().diff(start, 'years');
		    alert("You are " + years + " years old.");
		});
	}(),
	function() {
		var start = moment().subtract(29, 'days');
		var end = moment();

		function cb(start, end) {
		    $('#daterange-ex-4 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		}

		$('#daterange-ex-4').daterangepicker({
		    startDate: start,
		    endDate: end,
		    ranges: {
		       'Today': [moment(), moment()],
		       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		       'This Month': [moment().startOf('month'), moment().endOf('month')],
		       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		    }
		}, cb);

		cb(start, end);
	}(),
	function() {
		$('#clockpicker-3').clockpicker({
		    placement: 'right',
		    align: 'left',
		    donetext: 'Done'
		});
	}(),
	function() {
		var input = $('#single-input').clockpicker({
		    placement: 'bottom',
		    align: 'left',
		    autoclose: true,
		    'default': 'now'
		});

		// Manually toggle to the minutes view
		$('#check-minutes').click(function(e){
		    // Have to stop propagation here
		    e.stopPropagation();
		    input.clockpicker('show')
		            .clockpicker('toggleView', 'minutes');
		});
	}()
});