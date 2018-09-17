
function doNoticeSend(notice_id) {
	if (confirm('Подтвердите действие на Рассылку!')) {
		
	}
}

function doUpdateLeasingData() {
	$.LoadingOverlay('show');
	$.ajax({
		url: '/api/data-process',
		method: 'get',
		success: function() {
			noty({
			    text: 'Данные обновлены',
			    timeout: 3000,
			}).show();
			$.LoadingOverlay('hide');
		},
		error: function() {
			noty({
			    text: 'Ошибка обновления',
			    timeout: 3000,
			}).show();
			$.LoadingOverlay('hide');
		}
	});
}

function doUpdateCommunalData() {
	$.LoadingOverlay('show');
	$.ajax({
		url: '/api/communal-process',
		method: 'get',
		success: function() {
			noty({
			    text: 'Данные обновлены',
			    timeout: 3000,
			}).show();
			$.LoadingOverlay('hide');
		},
		error: function() {
			noty({
			    text: 'Ошибка обновления',
			    timeout: 3000,
			}).show();
			$.LoadingOverlay('hide');
		}
	});
}

$(function() {
	$('[data-toggle="leasing"]').on('click', function() {
		doUpdateLeasingData();
	});

	$('[data-toggle="communal"]').on('click', function() {
		doUpdateCommunalData();
	});
});
