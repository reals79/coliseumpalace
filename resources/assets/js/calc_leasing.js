var leasing_percent = 0.012; // Процентная ставка (%)
var leasing_period = 60; // Срок (в месяцах)
var leasing_period_pay = 3; // Период выплат (в месяцах)
var leasing_initial_rate = 20; // Первоначальный взнос (%)

var leasing_percent_period = (leasing_percent / ((leasing_period_pay == 1) ? 12 : 4)) / 100;

import Inputmask from 'inputmask';
var moment = require('moment');

$(function() {
	var im = new Inputmask();
	im.mask($(':input'));

	$('[data-toggle="calc_leasing"]').on('click', function() {
		calc_leasing();
	});

	$('#app_price').keypress(function(e) {
		if (e.which == 13)
			calc_leasing();
	});

	$.ajax({
		url: '/get-settings',
		dataType: 'json',
		success: function(obj) {
			if (obj) {
				leasing_percent = _.find(obj, ['name', 'leasing_percent']).value;
				leasing_period = _.find(obj, ['name', 'leasing_period']).value;
				leasing_period_pay = _.find(obj, ['name', 'leasing_period_pay']).value;
				leasing_initial_rate = _.find(obj, ['name', 'leasing_initial_rate']).value;
				//console.log(leasing_percent, leasing_period, leasing_period_pay, leasing_initial_rate);
			}
		}
	});
});

Math.roundBy = function (n, decimalPlaces) {
    var scale = Math.pow(10, decimalPlaces);
    return Math.round(scale * n) / scale;
};

function pmt(stavka, months, summa, n_period) {
	//var k = (stavka * Math.pow(1 + stavka, months) / (Math.pow(1 + stavka, months) - 1)) * summa;
	var k = (-summa * Math.pow(1 + stavka, months)) / (1 + stavka * 0) / ((Math.pow(1 + stavka, months) - 1) / stavka);
	//var k = (summa*stavka) / (1-(Math.pow(1+stavka, -months)));

	if (n_period && n_period > 0) {
		var principal = 0;
		var capital = summa;
		for (var i = 1; i <= n_period; ++i) {
			principal = Math.roundBy((k - (-capital * stavka)), 2);
			capital += principal;
		}
		k = principal;
	}

	return k;
}

function calc_leasing() {
	$('#calculator_process').toggleClass('d-none');
	var app_price = $('#app_price').val();
	var table_obj = $('#results > table tbody');
	var table_footer_obj = $('#results > table tfoot');
	table_obj.empty();
	table_footer_obj.empty();

	var initial_amount = app_price * (leasing_initial_rate / 100);

	var formattedAmount = Inputmask.format(initial_amount, { alias: 'numeric', groupSeparator: ',', digits: 0, autoGroup: true });
	$('#results #initial_amount span').html('&euro; ' + formattedAmount);

	var balance_pay = app_price - initial_amount;

	var total_period = Math.round(leasing_period / leasing_period_pay);

	var period_date = moment();
	var old_balance = 0;
	var total_leasing = 0
	var total_leasing_period = 0
	var total_stavka = 0

	for (var n_period = 1; n_period <= total_period; n_period++) {
		
		period_date.add(leasing_period_pay, 'months');

		var pay_leasing = Math.round(pmt(leasing_percent_period, total_period, -balance_pay));
		var pay_leasing_period = pmt(leasing_percent_period, total_period, -balance_pay, n_period);
		var pay_stavka = pay_leasing - pay_leasing_period;

		old_balance += pay_leasing_period;
		var pay_balance = balance_pay - old_balance;

		total_leasing += pay_leasing;
		total_leasing_period += pay_leasing_period;
		total_stavka += pay_stavka;

		var str_row = '<tr>\
					   <td class="text-center">' + n_period + '</td>\
					   <td class="text-center">' + period_date.format('DD.MM.YYYY') + '</td>\
					   <td class="text-right">' + Inputmask.format(pay_leasing, { alias: 'numeric', groupSeparator: ',', digits: 2, autoGroup: true, digitsOptional: false }) + '</td>\
					   <td class="text-right">' + Inputmask.format(pay_balance, { alias: 'numeric', groupSeparator: ',', digits: 2, autoGroup: true, digitsOptional: false }) + '</td>\
					   </tr>';
		table_obj.append(str_row);
	}
	var str_row_footer = '<tr class="font-weight-bold">\
				   <td></td>\
				   <td class="text-right">Всего:</td>\
				   <td class="text-right">' + Inputmask.format(total_leasing, { alias: 'numeric', groupSeparator: ',', digits: 2, autoGroup: true, digitsOptional: false }) + '</td>\
				   <td class="text-right"></td>\
				   </tr>';
	table_footer_obj.append(str_row_footer);
	$('#calculator_process').toggleClass('d-none');
}