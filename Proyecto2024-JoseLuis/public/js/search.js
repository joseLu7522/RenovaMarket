document.addEventListener("DOMContentLoaded", function () {
    const searchBar = document.querySelector("#search-bar");
    const products = document.querySelectorAll(".product-card");
    const sortHighToLowButton = document.getElementById("sort-high-to-low");
    const sortLowToHighButton = document.getElementById("sort-low-to-high");
    const productList = document.getElementById("product-list");

    searchBar.addEventListener("input", function () {
        const searchTerm = searchBar.value.trim().toLowerCase();

        products.forEach(function (product) {
            const productName = product
                .querySelector(".product-name")
                .textContent.toLowerCase();
            const productDescription = product
                .querySelector(".product-description")
                .textContent.toLowerCase();

            if (
                productName.includes(searchTerm) ||
                productDescription.includes(searchTerm)
            ) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    });

    sortHighToLowButton.addEventListener("click", function () {
        const sortedProducts = Array.from(productList.children).sort((a, b) => {
            const priceA = parseFloat(
                a.querySelector(".product-price").textContent.replace("€", "")
            );
            const priceB = parseFloat(
                b.querySelector(".product-price").textContent.replace("€", "")
            );
            return priceB - priceA;
        });

        productList.innerHTML = "";
        sortedProducts.forEach((product) => {
            productList.appendChild(product);
        });
    });

    sortLowToHighButton.addEventListener("click", function () {
        const sortedProducts = Array.from(productList.children).sort((a, b) => {
            const priceA = parseFloat(
                a.querySelector(".product-price").textContent.replace("€", "")
            );
            const priceB = parseFloat(
                b.querySelector(".product-price").textContent.replace("€", "")
            );
            return priceA - priceB;
        });

        productList.innerHTML = "";
        sortedProducts.forEach((product) => {
            productList.appendChild(product);
        });
    });



});
