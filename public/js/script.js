// Переключение категорий и получение товаров по этой категории
document.querySelector('.product-filter-menu').addEventListener('click', e => {
	e.preventDefault()
	if (e.target.matches('a')) {
		document
			.querySelector('.product-filter-menu a.active')
			.classList.remove('active')
		e.target.classList.add('active')
		const categoryId = e.target.dataset.id
		categoryProductsHandler(categoryId)
	}
})
// Подгрузка товаров на главной
document.querySelector('.load-more').addEventListener('click', e => {
	e.target.innerHTML = `Loading...<div class="spinner-border spinner-border-sm ml-2" role="status">
        <span class="visually-hidden"></span>
      </div>`
	const start = document.querySelectorAll('.products .product-wrapper').length

	const categoryId = document.querySelector('.product-filter-menu a.active')
		.dataset.id
	// productsHandler(start, e.target);
	categoryProductsHandler(categoryId, start, e.target)
})

function renderProducts(data) {
	let output = ''
	data.forEach(product => {
		output += `
        <div class="col-lg-3 col-sm-6 product-wrapper">
          <div class="product-item" data-id="${
						product.id
					}" data-category="<?= ${product.category_id}">
            <div class="pi-pic">
              ${
								product.discount > 0
									? '<div class="tag-sale">ON SALE</div>'
									: ''
							}
              <img src="${WWW}/img/product/${product.image}" alt="product">
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
										.toFixed(2)
										.toString()
										.replace('.', ',')}
                  `
										: `$${product.price.replace('.', ',')}`
								}
              </h6>
              <p>${product.name}</p>
            </div>
          </div>
        </div>
        `
	})

	document.querySelector('.products').insertAdjacentHTML('beforeend', output)
}

// Fetch queries

function categoryProductsHandler(categoryId, start, loadMore) {
	let body = JSON.stringify(
		start
			? {
					categoryId: Number(categoryId),
					start: Number(start),
			  }
			: { categoryId: Number(categoryId) }
	)

	fetch('categoryProductsHandler', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
			credentials: 'same-origin',
			'X-Requested-With': 'XMLHttpRequest',
		},
		body: body,
	})
		.then(resp => {
			if (!resp.ok) {
				;('Ошибка запроса к серверу. Попробуйте позже')
			}
			return resp.json()
		})
		.then(data => {
			if (!data) {
				throw new Error(
					'Ошибка получения товаров по категории. Попробуйте позже'
				)
			} else {
				if (!start) {
					// проверяет Load more..... Или перекл кат
					document.querySelector('.products').innerHTML = ''
					if (data.length === 0) {
						document.querySelector('.products').innerHTML =
							'<h3>Товары закончились :(</h3>'
						// document.querySelector('.load-more').remove()
					} else {
						renderProducts(data)
					}
				} else {
					renderProducts(data)
				}
			}
		})
		.catch(err => {
			if (PROD) {
				alert(err)
			} else {
				console.error(err)
			}
		})
		.finally(() => {
			if (loadMore) {
				loadMore.textContent = 'LOAD MORE'
			}
		})
}
