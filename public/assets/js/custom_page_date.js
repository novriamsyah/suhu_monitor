'use strict';

// * Pickers with jQuery dependency (jquery)
$(function () {
  // Bootstrap Datepicker
  // --------------------------------------------------------------------
  var bsDatepickerBasic = $('#bs-datepicker-basic'),
    bsDatepickerFormat = $('#bs-datepicker-format'),
    bsDatepickerRange = $('#bs-datepicker-daterange'),
    bsDatepickerDisabledDays = $('#bs-datepicker-disabled-days'),
    bsDatepickerMultidate = $('#bs-datepicker-multidate'),
    bsDatepickerOptions = $('#bs-datepicker-options'),
    bsDatepickerAutoclose = $('#bs-datepicker-autoclose'),
    bsDatepickerAutoclosee = $('#bs-datepicker-autoclosee'),
    bsDatepickerInlinedate = $('#bs-datepicker-inline');

  // Basic
  if (bsDatepickerBasic.length) {
    bsDatepickerBasic.datepicker({
      todayHighlight: true,
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  // Format
  if (bsDatepickerFormat.length) {
    bsDatepickerFormat.datepicker({
      todayHighlight: true,
      format: 'dd/mm/yyyy',
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  // Range
  if (bsDatepickerRange.length) {
    bsDatepickerRange.datepicker({
      todayHighlight: true,
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  // Disabled Days
  if (bsDatepickerDisabledDays.length) {
    bsDatepickerDisabledDays.datepicker({
      todayHighlight: true,
      daysOfWeekDisabled: [0, 6],
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  // Multiple
  if (bsDatepickerMultidate.length) {
    bsDatepickerMultidate.datepicker({
      multidate: true,
      todayHighlight: true,
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  // Options
  if (bsDatepickerOptions.length) {
    bsDatepickerOptions.datepicker({
      calendarWeeks: true,
      clearBtn: true,
      todayHighlight: true,
      orientation: isRtl ? 'auto left' : 'auto right'
    });
  }

  // Auto close
  if (bsDatepickerAutoclose.length) {
    bsDatepickerAutoclose.datepicker({
      todayHighlight: true,
      autoclose: true,
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  if (bsDatepickerAutoclosee.length) {
    bsDatepickerAutoclosee.datepicker({
      todayHighlight: true,
      autoclose: true,
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  }

  // Inline picker
  if (bsDatepickerInlinedate.length) {
    bsDatepickerInlinedate.datepicker({
      todayHighlight: true
    });
  }

  // Bootstrap Daterange Picker
  // --------------------------------------------------------------------
  var bsRangePickerBasic = $('#bs-rangepicker-basic'),
    bsRangePickerSingle = $('#bs-rangepicker-single'),
    bsRangePickerTime = $('#bs-rangepicker-time'),
    bsRangePickerRange = $('#bs-rangepicker-range'),
    bsRangePickerWeekNum = $('#bs-rangepicker-week-num'),
    bsRangePickerDropdown = $('#bs-rangepicker-dropdown'),
    bsRangePickerCancelBtn = document.getElementsByClassName('cancelBtn');

  // Basic
  if (bsRangePickerBasic.length) {
    bsRangePickerBasic.daterangepicker({
      opens: isRtl ? 'left' : 'right'
    });
  }

  // Single
  if (bsRangePickerSingle.length) {
    bsRangePickerSingle.daterangepicker({
      singleDatePicker: true,
      opens: isRtl ? 'left' : 'right'
    });
  }

  // Time & Date
  if (bsRangePickerTime.length) {
    bsRangePickerTime.daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY h:mm A'
      },
      opens: isRtl ? 'left' : 'right'
    });
  }

  if (bsRangePickerRange.length) {
    bsRangePickerRange.daterangepicker({
      ranges: {
        Today: [moment(), moment()],
        Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      opens: isRtl ? 'left' : 'right'
    });
  }

  // Week Numbers
  if (bsRangePickerWeekNum.length) {
    bsRangePickerWeekNum.daterangepicker({
      showWeekNumbers: true,
      opens: isRtl ? 'left' : 'right'
    });
  }
  // Dropdown
  if (bsRangePickerDropdown.length) {
    bsRangePickerDropdown.daterangepicker({
      showDropdowns: true,
      opens: isRtl ? 'left' : 'right'
    });
  }

  // Adding btn-label-secondary class in cancel btn
  for (var i = 0; i < bsRangePickerCancelBtn.length; i++) {
    bsRangePickerCancelBtn[i].classList.remove('btn-default');
    bsRangePickerCancelBtn[i].classList.add('btn-label-primary');
  }

  // jQuery Timepicker
  // --------------------------------------------------------------------
  var basicTimepicker = $('#timepicker-basic'),
    minMaxTimepicker = $('#timepicker-min-max'),
    disabledTimepicker = $('#timepicker-disabled-times'),
    formatTimepicker = $('#timepicker-format'),
    stepTimepicker = $('#timepicker-step'),
    altHourTimepicker = $('#timepicker-24hours'),
    altHourTimepickerr = $('#timepicker-24hourss');

  // Basic
  if (basicTimepicker.length) {
    basicTimepicker.timepicker({
      orientation: isRtl ? 'r' : 'l'
    });
  }

  // Min & Max
  if (minMaxTimepicker.length) {
    minMaxTimepicker.timepicker({
      minTime: '2:00pm',
      maxTime: '7:00pm',
      showDuration: true,
      orientation: isRtl ? 'r' : 'l'
    });
  }

  // Disabled Picker
  if (disabledTimepicker.length) {
    disabledTimepicker.timepicker({
      disableTimeRanges: [
        ['12am', '3am'],
        ['4am', '4:30am']
      ],
      orientation: isRtl ? 'r' : 'l'
    });
  }

  // Format Picker
  if (formatTimepicker.length) {
    formatTimepicker.timepicker({
      timeFormat: 'H:i:s',
      orientation: isRtl ? 'r' : 'l'
    });
  }

  // Steps Picker
  if (stepTimepicker.length) {
    stepTimepicker.timepicker({
      step: 15,
      orientation: isRtl ? 'r' : 'l'
    });
  }

  // 24 Hours Format
  if (altHourTimepicker.length) {
    altHourTimepicker.timepicker({
      show: '24:00',
      timeFormat: 'H:i:s',
      orientation: isRtl ? 'r' : 'l'
    });
  }

  if (altHourTimepickerr.length) {
    altHourTimepickerr.timepicker({
      show: '24:00',
      timeFormat: 'H:i:s',
      orientation: isRtl ? 'r' : 'l'
    });
  }
});