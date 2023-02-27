/**
 * Date picker for bootstrap 4
 *
 * https://github.com/lesilent/datepicker-bs4
 */
(function () {
//-------------------------------------
'use strict';

/**
 * Default options for the current modal being displayed
 *
 * @type {object}
 * @todo add support for additional options
 */
var settings = {
	format: 'MM/DD/YYYY',
	maxDate: null,
	minDate: '1900-01-01',
	minScreenWidth: 576,
	popoverWidth: '19rem'
};

/**
 * Flag for whether plugin has been initialized
 *
 * @type {boolean}
 */
var initialized = false;

/**
 * Convert special chararacters html entities
 *
 * @param  {string} str the string to encode
 * @return {string} the encoded string
 */
function htmlEncode(str)
{
	return str.replace(/&/g, '&amp;').replace(/>/g, '&gt;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}

/**
 * Parse a date string and return a dayjs object
 *
 * @param  {string} str
 * @param  {object} options
 * @return {object|boolean} either a dayjs object or false on error
 */
function parseDate(str, options)
{
	var input_date, matches;
	if (typeof str == 'object' && str instanceof dayjs)
	{
		return str.isValid() ? str : false;
	}
	str = str.replace(/^\s+|\s+$/g, '');
	if ((matches = str.match(/^(\d{4})\s*\-\s*([01]\d)\s*\-\s*([0-3]\d)$/))
		&& parseInt(matches[2]) > 0 && parseInt(matches[2]) < 13
		&& parseInt(matches[3]) > 0 && parseInt(matches[3]) < 32)
	{
		input_date = dayjs(str);
		return input_date.isValid() ? input_date : false;
	}
	else if ((matches = str.match(/^([01]?\d)\s*[\/\-\.]?\s*([0-3]?\d)\s*[\/\-\.]?\s*((\d{2})?\d{2})$/))
		&& parseInt(matches[1]) > 0 && parseInt(matches[1]) < 13
		&& parseInt(matches[2]) > 0 && parseInt(matches[2]) < 32)
	{
		if (matches[3].length == 2)
		{
			matches[3] = Math.floor(new Date().getFullYear() / 100) * 100 - ((parseInt(matches[3]) >= 50) ? 100 : 0) + parseInt(matches[3]) ;
		}
		input_date = dayjs(matches[3] + '-' + ((matches[1].length > 1) ? '': '0') + matches[1] + '-' + ((matches[2].length > 1) ? '' : '0') + matches[2]);
		if (input_date.isValid())
		{
			if (options &&
				((options.minDate && input_date.isBefore(options.minDate, 'date'))
				|| (options.maxDate && input_date.isAfter(options.maxDate, 'date'))))
			{
				return false;
			}
			return input_date;
		}
	}
	else if (options && options.format)
	{
		input_date = dayjs(str, options.format);
		return input_date.isValid() ? input_date : false;
	}
	return false;
}

/**
 * Update the year selector in the popover
 *
 * @param {object} $input  the id of the input
 */
 function updateYearPicker($input)
 {
	var input_id = $input.attr('id');
	var options = $input.data('options');
	var input_date = parseDate($input.val(), options);
	var today = dayjs();
	var viewDate = $input.data('viewdate') || today;

	// Get date for view
	var viewYear = viewDate.year();
	var startYear = viewYear - (viewYear % 5) - 15;
	var startDate = dayjs(startYear + '-01-01').startOf('year');
	var endYear = (startYear + 29);
	var endDate = dayjs(endYear + '-12-31').endOf('year');

	var today_disabled = ((options.minDate && today.isBefore(options.minDate, 'date'))
		|| (options.maxDate && today.isAfter(options.maxDate, 'date'))
		|| (today.year() >= startYear && today.year() <= endYear)
	);

	// Build html
	var html = '<div class="d-flex justify-content-between align-items-center datepicker-btns">'
		+ '<div class="font-weight-bold"><button type="button" id="' + input_id + '-picker-btn" class="btn font-weight-bold dropdown-toggle">' + startDate.year() + ' - ' + endDate.year()  + '</button></div><div>'
		+ '<a id="' + input_id + '-picker-prev-link" class="btn btn-link px-1 mx-0' + ((!options.minDate || options.minDate.isBefore(startDate, 'date')) ? '' : ' disabled') + '" href="javascript:void(0)" title="Go to Previous Years"><i class="fas fa-chevron-left fa-fw"></i></a>'
		+ '<a id="' + input_id + '-picker-today-link" class="btn btn-link px-1 mx-0' + (today_disabled ? ' disabled' : '') + '" href="javascript:void(0)" title="Go to Current Year"><i class="far fa-calendar-check fa-fw"></i></a>'
		+ '<a id="' + input_id + '-picker-next-link" class="btn btn-link px-1 mx-0' + ((!options.maxDate || options.maxDate.isAfter(endDate, 'date')) ? '' : ' disabled') + '" href="javascript:void(0)" title="Go to Next Years"><i class="fas fa-chevron-right fa-fw"></i></a>'
		+ '</div></div>'
		+ '<table class="table table-sm table-borderless text-center datepicker-table mb-1"><thead class="thead-light"><tr><th class="py-1" colspan="5"><span class="invisible">Year</span></th></tr></thead><tbody>';
	for (var i = 0; i < (endYear - startYear + 1); i++)
	{
		var i_date = viewDate.year(startYear + i);
		var disabled = ((options.minDate && options.minDate.isAfter(i_date.endOf('year'), 'date'))
			|| (options.maxDate && options.maxDate.isBefore(i_date.startOf('year'), 'date')));
		html += ((i % 5 == 0) ? '<tr>' : '')
			+ '<td class="text-center p-0"><button type="button" class="btn btn-block px-0 '
			+ ((input_date && input_date.isSame(i_date, 'year')) ? 'active btn-info'
			: 'btn-outline-dark border-white' + (i_date.isSame(today, 'year') ? ' today' : ''))
			+ '" ' + (disabled ? 'disabled="disabled"' : 'data-year="' + i_date.year() + '"') + '>' + i_date.year() + '</button></td>'
			+ ((i % 5 == 4) ? '</tr>' : '');
	}
	html += '</table>';
	jQuery('#' + input_id + '-picker-content').html(html).find('table button').on('click', function () {
		viewDate = viewDate.year(jQuery(this).data('year'));
		$input.data('viewdate', viewDate);
		updateMonthPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-prev-link').on('click', function () {
		viewDate = $input.data('viewdate').subtract(30, 'year');
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateYearPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-next-link').on('click', function () {
		viewDate = $input.data('viewdate').add(30, 'year');
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateYearPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-today-link').on('click', function () {
		viewDate = today;
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateYearPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-btn').on('click', function () {
		updateMonthPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: $input.data('viewdate')
		}]);
	});
 }

 /**
  * Update the month selector in the popover
  *
  * @param {object} $input
  */
 function updateMonthPicker($input)
 {
	var input_id = $input.attr('id');
	var options = $input.data('options');
	var input_date = parseDate($input.val(), options);
	var today = dayjs();
	var viewDate = $input.data('viewdate') || today;
	var today_disabled = ((options.minDate && today.isBefore(options.minDate, 'date'))
		|| (options.maxDate && today.isAfter(options.maxDate, 'date'))
		|| today.isSame(viewDate, 'year')
	);

	var html = '<div class="d-flex justify-content-between align-items-center datepicker-btns">'
		+ '<div class="font-weight-bold"><button type="button" id="' + input_id + '-picker-btn" class="btn font-weight-bold dropdown-toggle">' + viewDate.format('YYYY') + '</button></div><div>'
		+ '<a id="' + input_id + '-picker-prev-link" class="btn btn-link px-1 mx-0' + ((!options.minDate || options.minDate.isBefore(viewDate.startOf('year'), 'date')) ? '' : ' disabled') + '" href="javascript:void(0)" title="Go to Previous Year" data-unit="month"><i class="fas fa-chevron-left fa-fw"></i></a>'
		+ '<a id="' + input_id + '-picker-today-link" class="btn btn-link px-1 mx-0' + (today_disabled ? ' disabled' : ' ') + '" href="javascript:void(0)" title="Go to Current Month"><i class="far fa-calendar-check fa-fw"></i></a>'
		+ '<a id="' + input_id + '-picker-next-link" class="btn btn-link px-1 mx-0' + ((!options.maxDate || options.maxDate.isAfter(viewDate.endOf('year'), 'date')) ? '' : ' disabled') + '" href="javascript:void(0)" title="Go to Next Year" data-unit="month"><i class="fas fa-chevron-right fa-fw"></i></a>'
		+ '</div></div>'
		+ '<table id="d-table" class="table table-sm table-borderless text-center datepicker-table mb-1"><thead class="thead-light"><tr><th class="py-1" colspan="3"><span class="invisible">Month</th></tr></thead><tbody>';
	for (var i = 0; i < 12; i++)
	{
		var i_date = viewDate.month(i);
		var disabled = ((options.minDate && options.minDate.isAfter(i_date.endOf('month'), 'date'))
			|| (options.maxDate && options.maxDate.isBefore(i_date.startOf('month'), 'date')));
		html += ((i % 3 == 0) ? '<tr>' : '') + '<td class="text-center p-0"><button type="button" class="btn btn-block px-0 '
			+ ((input_date && input_date.isSame(i_date, 'month')) ? 'active btn-info'
			: 'btn-outline-dark border-white' + (i_date.isSame(today, 'month') ? ' today' : ''))
			+ '" ' + (disabled ? 'disabled="disabled"' : 'data-date="' + i_date.format('YYYY-MM-DD"')) + '>' + i_date.format('MMM') + '</button></td>' + ((i % 3 == 2) ? '</tr>' : '');
	}
	for (var i = 0; i < 6; i++)
	{
		html += ((i % 3 == 0) ? '<tr>' : '')
			+ '<td class="p-0"><button type="button" class="btn btn-block invisible px-0" disabled="disabled">&nbsp;</button></td>'
			+ ((i % 3 == 2) ? '</tr>' : '');
	}
	jQuery('#' + input_id + '-picker-content').html(html).find('table button').on('click', function () {
		viewDate = dayjs(jQuery(this).data('date'));
		$input.data('viewdate', viewDate);
		updateDatePicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-prev-link').on('click', function () {
		viewDate = $input.data('viewdate').subtract(1, 'year');
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateMonthPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-next-link').on('click', function () {
		viewDate = $input.data('viewdate').add(1, 'year');
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateMonthPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-today-link').on('click', function () {
		viewDate = today;
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateMonthPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-btn').on('click', function () {
		updateYearPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: $input.data('viewdate')
		}]);
	});
}

/**
 * Update the calendar in the popover
 *
 * @param {object} $input  the input object
 */
function updateDatePicker($input)
{
	var input_id = $input.attr('id');
	var options = $input.data('options');
	var input_date = parseDate($input.val(), options);
	var today = dayjs();
	var viewDate = $input.data('viewdate') || today;
	var today_disabled = ((options.minDate && today.isBefore(options.minDate, 'date'))
		|| (options.maxDate && today.isAfter(options.maxDate, 'date'))
		|| today.isSame(viewDate, 'month')
	);

	// Build html
	var html = '<div class="d-flex justify-content-between align-items-center datepicker-btns">'
		+ '<div class="font-weight-bold"><button type="button" id="' + input_id + '-picker-btn" class="btn font-weight-bold dropdown-toggle px-2">' + viewDate.format('MMMM YYYY') + '</button></div><div class="text-nowrap">'
		+ '<a id="' + input_id + '-picker-prev-link" class="btn btn-link px-1 mx-0' + ((!options.minDate || options.minDate.isBefore(viewDate.startOf('month'), 'date')) ? '' : ' disabled') + '" href="javascript:void(0)" title="Go to Previous Month" data-unit="month"><i class="fas fa-chevron-left fa-fw"></i></a>'
		+ '<a id="' + input_id + '-picker-today-link" class="btn btn-link px-1 mx-0' + (today_disabled ? ' disabled' : '') + '" href="javascript:void(0)" title="Go to Today"><i class="far fa-calendar-check fa-fw"></i></a>'
		+ '<a id="' + input_id + '-picker-next-link" class="btn btn-link px-1 mx-0' + ((!options.maxDate || options.maxDate.isAfter(viewDate.endOf('month'), 'date')) ? '' : ' disabled') + '" href="javascript:void(0)" title="Go To Next Month" data-unit="month"><i class="fas fa-chevron-right fa-fw"></i></a>'
		+ '</div></div>'
		+ '<table class="table table-sm table-borderless text-center datepicker-table mb-1"><thead class="thead-light"><tr>';
//		['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].forEach(function (day) {
//			html += '<th class="py-1" scope="col" style="width:14.28%">' + day + '</th>';
//	});
	for (var i = 0; i < 7; i++)
	{
		html += '<th class="py-1" scope="col" style="width:14.28%">' + viewDate.day(i).format('dd') + '</th>';
	}
	html += '</tr></thead><tbody><tr>';
	var i_date;
	var dow = 0;
	var startMonth = viewDate.startOf('month');
	for (var i = startMonth.day(); i > 0; i--)
	{
		i_date = startMonth.subtract(i, 'day');
		var disabled = ((options.minDate && options.minDate.isAfter(i_date.endOf('date'), 'date'))
			|| (options.maxDate && options.maxDate.isBefore(i_date.startOf('date'), 'date')));
		html += '<td class="text-center p-0"><button type="button" class="btn btn-block px-0 '
			+ ((input_date && input_date.isSame(i_date, 'date')) ? 'active btn-info'
			: 'btn-outline-secondary border-white' + (i_date.isSame(today, 'date') ? ' today' : ''))
			+ '" ' + (disabled ? 'disabled="disabled"' : 'data-date="' + i_date.format('YYYY-MM-DD"')) + '>' + i_date.format('D') + '</button></td>';
		dow++;
	}
	var rows = 0;
	var days_in_month = viewDate.daysInMonth();
	for (var i = 1; i <= days_in_month; i++)
	{
		i_date = viewDate.date(i);
		var disabled = ((options.minDate && options.minDate.isAfter(i_date.endOf('date'), 'date'))
			|| (options.maxDate && options.maxDate.isBefore(i_date.startOf('date'), 'date')));
		html += ((dow == 0) ? '<tr>' : '') + '<td class="text-center p-0"><button type="button" class="btn btn-block px-0 '
			+ ((input_date && input_date.isSame(i_date, 'date')) ? 'active btn-info'
			: 'btn-outline-dark border-white' + (i_date.isSame(today, 'date') ? ' today' : ''))
			+ '" ' + (disabled ? 'disabled="disabled"' : 'data-date="' + i_date.format('YYYY-MM-DD"')) + '>' + i_date.format('D') + '</button></td>' + ((dow == 6) ? '</tr>' : '');
		rows += (dow == 6) ? 1 : 0;
		dow = (dow + 1) % 7;
	}
	if (dow > 0)
	{
		var nextMonth = viewDate.add(1, 'month');
		for (var i = 1; i <= (7 - dow); i++)
		{
			i_date = nextMonth.date(i);
			var disabled = ((options.minDate && options.minDate.isAfter(i_date.endOf('date'), 'date'))
				|| (options.maxDate && options.maxDate.isBefore(i_date.startOf('date'), 'date')));
			html += '<td class="text-center p-0"><button type="button" class="btn btn-block px-0 '
				+ ((input_date && input_date.isSame(i_date, 'date')) ? 'active btn-info'
				: ' btn-outline-secondary border-white' + (i_date.isSame(today, 'date') ? ' today' : ''))
				+ '" ' + (disabled ? 'disabled="disabled"' : 'data-date="' + i_date.format('YYYY-MM-DD"')) + '>' + i_date.format('D') + '</button></td>';
		}
		html += '</tr>';
		rows++;
	}
	for (var i = 0; i < ((6- rows) * 7); i++)
	{
		i_date = i_date.add(1, 'day');
		var disabled = ((options.minDate && options.minDate.isAfter(i_date.endOf('date'), 'date'))
			|| (options.maxDate && options.maxDate.isBefore(i_date.startOf('date'), 'date')));
		html += ((i % 7 == 0) ? '<tr>' : '') + '<td class="text-center p-0"><button type="button" class="btn btn-block px-0 '
			+ ((input_date && input_date.isSame(i_date, 'date')) ? 'active btn-info'
			: ' btn-outline-secondary border-white' + (i_date.isSame(today, 'date') ? ' today' : ''))
			+ '" ' + (disabled ? 'disabled="disabled"' : 'data-date="' + i_date.format('YYYY-MM-DD"')) + '>' + i_date.format('D') + '</button></td>'
			+ ((i % 7 == 6) ? '</tr>' : '');
	}
	html += '</tbody></table>';
	jQuery('#' + input_id + '-picker-content').html(html).find('table button').on('click', function () {
		var newDate = dayjs(jQuery(this).data('date'));
		$input.val(newDate.format(options.format)).popover('hide').trigger('change');
	});
	jQuery('#' + input_id + '-picker-prev-link').on('click', function () {
		viewDate = $input.data('viewdate').subtract(1, 'month');
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateDatePicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-next-link').on('click', function () {
		viewDate = $input.data('viewdate').add(1, 'month');
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateDatePicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-today-link').on('click', function () {
		viewDate = today;
		jQuery(this).toggleClass('active disabled', true);
		$input.data('viewdate', viewDate);
		updateDatePicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: viewDate
		}]);
	});
	jQuery('#' + input_id + '-picker-btn').on('click', function () {
		updateMonthPicker($input);
		$input.trigger('update.datepicker', [{
			viewDate: $input.data('viewdate')
		}]);
	});
}

/**
 * Add method for initializing plugin
 */
jQuery.fn.datepicker = function (options) {
	// Get boostrap version
	var bs_version = parseInt(jQuery.fn.dropdown.Constructor.VERSION.replace(/\..+$/, ''));
	if (bs_version < 4)
	{
		console.error('Invalid bootstrap version ' + bs_version + ' detected');
	}

	// Handle functions
	if (typeof options == 'string')
	{
		if (this.length < 1)
		{
			return undefined;
		}
		var input_options = this.data('options') || {};
		switch (options)
		{
			case 'date':
				if (arguments.length > 1)
				{
					var newDate = (arguments[1]) ? parseDate(arguments[1], input_options) : null;
					return this.val((newDate && newDate.isValid()) ? newDate.format(input_options.format) : '');
				}
				else
				{
					return parseDate(this.val()) || null;
				}
				break;
			case 'format':
				if (arguments.length > 1)
				{
					if (arguments[1] && typeof arguments[1] == 'string')
					{
						input_options.format = arguments[1];
						this.data('options', input_options);
					}
					else
					{
						console.warn('Invalid format');
					}
				}
				else
				{
					return input_options.format;
				}
				break;
			case 'minDate':
			case 'maxDate':
				if (arguments.length > 1)
				{
					if (arguments[1])
					{
						var newDate = parseDate(arguments[1], input_options);
						if (newDate && newDate.isValid())
						{
							input_options[options] = newDate;
							this.data('options', input_options);
						}
						else
						{
							console.warn('Invalid ' + options);
						}
					}
					else
					{
						input_options[options] = null;
						this.data('options', input_options);
					}
				}
				else
				{
					return input_options[options];
				}
			default:
				break;
		}
		return this;
	}

	// Initialize code if it hasn't already
	if (!initialized)
	{
		initialized = true;
		jQuery(document.head).append('<style id="datepicker-style">'
			+ '.datepicker-popover { font-size: inherit;  }'
			+ '.datepicker-btns .btn:hover { background-color: #e2e6ea; color: #000; }'
			+ '.datepicker-table td button:focus { box-shadow: none !important; }'
			+ '.datepicker-table td button:not(:disabled):hover { background-color: #6c757d !important; border-color: #6c757d !important; color: #fff; }'
			+ '.datepicker-table td button:disabled { cursor: not-allowed; }'
			+ '.datepicker-table td button.today { background-color: #fcf8e3; }'
			+ '</style>');

		// Make popovers close when clicked outside of them
		jQuery(document.body).on('mouseup', function (e) {
			if (jQuery(e.target).parents('.popover').length == 0)
			{
				jQuery('.datepicker').popover('hide');
			}
		});
	}

	// Process options
	if (typeof options == 'undefined')
	{
		options = {};
	}
	var common_options = jQuery.extend({}, settings, options);

	// Convert to date type if screen doesn't meet the mininum width or an IOS device
	if ((common_options.minScreenWidth && window.screen.width < common_options.minScreenWidth)
		|| /iPad|iPhone|iPod/.test(navigator.userAgent))
	{
		return this.each(function () {
			var $input = jQuery(this);

			// Process options
			var input_options = jQuery.extend(true, {}, common_options);
			var format = $input.data('format') || common_options.format;
			if (format)
			{
				input_options.format = format;
			}
			var minDate = $input.attr('min') || $input.data('mindate') || common_options.minDate;
			if (minDate && (minDate = dayjs(minDate)) && minDate.isValid())
			{
				input_options.minDate = minDate.startOf('date');
			}
			var maxDate = $input.attr('max') || $input.data('maxdate') || common_options.maxDate;
			if (maxDate && (maxDate = dayjs(maxDate)) && maxDate.isValid())
			{
				input_options.maxDate = maxDate.endOf('date');
			}
			$input.data('options', input_options);

			var viewDate = parseDate(this.value, input_options);
			if (viewDate)
			{
				// Convert value to YYYY-MM-DD format to be compatible with date type
				this.value = viewDate.format('YYYY-MM-DD');
			}
			this.type = 'date';
			jQuery('[data-toggle="datepicker"][data-target="#' + this.id + '"]').add($input.siblings().find('[data-toggle="datepicker"]')).on('click', function () {
				$input.focus();
				if ('showPicker' in HTMLInputElement.prototype)
				{
					$input[0].showPicker();
				}
			});
		});
	}

	// Initialize the inputs
	return this.each(function () {
		var $input = jQuery(this);
		if ($input.data('datepicker'))
		{
			// If datepicker is already initialized, then return
			return this;
		}
		$input.data('datepicker', true);

		// Process options
		var input_options = jQuery.extend(true, {}, common_options);
		var format = $input.data('format') || common_options.format;
		if (format)
		{
			input_options.format = format;
		}
		var minDate = $input.attr('min') || $input.data('mindate') || common_options.minDate;
		if (minDate && (minDate = dayjs(minDate)) && minDate.isValid())
		{
			input_options.minDate = minDate.startOf('date');
		}
		var maxDate = $input.attr('max') || $input.data('maxdate') || common_options.maxDate;
		if (maxDate && (maxDate = dayjs(maxDate)) && maxDate.isValid())
		{
			input_options.maxDate = maxDate.endOf('date');
		}
		$input.data('options', input_options);
		var input_id = this.id;
		var $toggles = $input.siblings().find('[data-toggle="datepicker"]:not([data-target])');
		if (this.id)
		{
			$toggles = $toggles.add('[data-toggle="datepicker"][data-target="#' + this.id + '"]');
		}
		else
		{
			input_id = 'input-' + Math.floor(Math.random() * 1000000 + 1);
			this.id = input_id;
		}
		$input.toggleClass('datepicker', true);

		var $label = jQuery('label[for="' + input_id + '"]');
		$input.on('change', function () {
			this.value = this.value.replace(/^\s+|\s+$/g, '');
			var input_options = $input.data('options');
			var newDate = parseDate(this.value, input_options);
			var newValue = (newDate && newDate.isValid() && !(input_options.minDate && newDate.isBefore(input_options.minDate)) && !(input_options.maxDate && newDate.isAfter(input_options.maxDate))) ? newDate.format(input_options.format) : '';
			if (this.value != newValue)
			{
				this.value = newValue;
				jQuery(this).trigger('change');
			}
		}).on('inserted.bs.popover', function () {
			jQuery('.popover').find('[data-dismiss="popover"]').on('click', function () {
				$input.popover('hide');
			});
			updateDatePicker($input, input_options);
		}).popover({
			html: true,
			placement: 'bottom',
			sanitize: false,
			title: '<button type="button" class="close mt-n1" data-dismiss="popover">&times;</button>' + (($label.length > 0) ? $label.html() : 'Date'),
			template: '<div id="' + input_id + '-picker-popover" class="popover datepicker-popover bs-popover-bottom" role="tooltip" style="width:' + input_options.popoverWidth + ';"><div class="arrow"></div><h3 class="popover-header"></h3><div id="' + input_id + '-popover-body" class="popover-body border-bottom"></div><div class="popover-footer bg-light text-right px-3 py-2 rounded-lg" hidden="hidden"><button type="button" class="btn btn-secondary btn-sm" title="Close the picker" data-dismiss="popover"><i class="fas fa-times"></i> Close</button></div></div>',
			trigger: (($toggles.length > 0) ? 'manual' : 'click'),
			popperConfig: {
/*
				modifiers: {
					hide: {
						enabled: false
					},
					preventOverflow: {
						enabled: false,
//						boundariesElement: 'window',
						escapeWithReference: true
					}
				},
//				positionFixed: true
*/
			},
			content: function () {
				var options = $input.data('options');
				var viewDate = parseDate($input.val(), options) || dayjs();
				if (options.minDate && viewDate.isBefore(options.minDate, 'date'))
				{
					viewDate = options.minDate;
				}
				else if (options.maxDate && viewDate.isAfter(options.maxDate, 'date'))
				{
					viewDate = options.maxDate;
				}
				$input.data('viewdate', viewDate);
				return '<div id="' + input_id + '-picker-content"></div>';
			}
		});
		$toggles.on('click', function () {
			$input.popover('toggle');
			this.blur();
		});
	});
};

document.addEventListener('DOMContentLoaded', function() {
	jQuery('[data-toggle="datepicker"][data-target]').each(function () {
		jQuery(jQuery(this).data('target')).datepicker();
	});
});

//-------------------------------------
}());
