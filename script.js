let currentPage = 1;

async function loadProducts(page) {
    const response = await fetch(`get_products.php?page=${page}`);
    const products = await response.json();

    const productsContainer = document.getElementById('products');
    products.forEach(product => {
        const card = `
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="${product.image_url}" class="card-img-top" alt="${product.name}">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text">${product.description}</p>
                        <p class="text-success">${product.price} €</p>
                    </div>
                </div>
            </div>
        `;
        productsContainer.innerHTML += card;
    });
}

document.getElementById('loadMore').addEventListener('click', () => {
    currentPage++;
    loadProducts(currentPage);
});

// Charger la première page au chargement
loadProducts(currentPage);
