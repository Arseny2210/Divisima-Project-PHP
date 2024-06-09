document.querySelector('.load-more').addEventListener('click', e => {
	e.target.innerHTML = `Loading... <div class="spinner-border ml-2" role="status">
  <span class="visually-hidden"></span>
</div>`

	const start = document.querySelector('.products').children.length
	fetch('productsHandler', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			credentials: 'same-origin',
			'X-Requested-With': 'XMLHttpRequest',
		},
		body: start,
	})
		.then(resp => resp.json())
		.then(data => {
			let output = ''
			data.forEach(product => {
				output += `	<div class="col-lg-3 col-sm-6">
				<div class="product-item" data-id="${product.id}" data-category="${
					product.category_id
				}">
					<div class="pi-pic">
					${product.discount > 0 ? '<div class="tag-sale">ON SALE</div>' : ''}
						<img src="${WWW}/img/product/${product.image}" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>
						${
							product.discount > 0
								? `
								<s>$${product.price.replace('.', ',')}</s>
								<br>
								$${(product.price - (product.price / 100) * product.discount)
									.toString()
									.replace('.', ',')}
							`
								: `$${product.price.replace('.', ',')}`
						}
						</h6>
						<p>${product.name}</p>
					</div>
				</div>
			</div>`
			})
			document
				.querySelector('.products')
				.insertAdjacentHTML('beforeend', output)
		})
		.catch(err => {
			if (PROD) {
				alert('Ошибка. Попробуйте позже')
			} else {
				console.error('Не пришли 4 товара. script.js ' + err)
			}
		})
		.finally(() => (e.target.textContent = 'LOAD MORE'))
})
