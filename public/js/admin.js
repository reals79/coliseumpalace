
function doClientLogin(api_token) {
	localStorage.setItem('api_token', api_token);
	window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token;
	location.href = 'http://my.coliseumpalace.test';
}

function doNoticeSend(notice_id) {
	if (confirm('Подтвердите действие на Рассылку!')) {
		
	}
}