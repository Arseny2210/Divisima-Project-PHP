document.querySelector('.load-more').addEventListener('click', e => {
	e.target.textContent = 'Loading ...'
	fetch('productsHandler', {
		method: 'GET',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			credentials: 'same-origin',
			'X-Requested-With': 'XMLHttpRequest',
		},
	})
		.then(resp => resp.text())
		.then(data => console.log(data))
		.finally(() => (e.target.textContent = 'LOAD MORE'))
})
