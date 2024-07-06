<?php
include '../customer/header.php';
?>

<div class="container mt-5">
    <h2>Products</h2>

    <!-- Product List -->
    <div id="productList" class="d-flex flex-wrap gap-2">
        <!-- Products will be dynamically inserted here -->
    </div>
</div>

<script>
    function fetchProductList() {
          const result=fetch('http://localhost/customer/getproducts.php')
          result.then(e=>e.json().
          then(e=>renderProductList(e))
          .catch(e=>console.log(e))
          )
        }
    
        // Function to render product list
        function renderProductList(products) {

          const productList = document.getElementById('productList');
          productList.innerHTML = '';
    
          products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'card mb-3';
            productCard.innerHTML = `
              <div class="p-3 card h-100 d-flex flex-column gap-0">
                <img class="img-fluid rounded w-100 h-100"  src="../shared/images/${product.img}" alt="">
                <h5 class="card-title">${product.productName}</h5>
                <div class="mb-0 d-flex"><p class="fw-bold me-1">Price: </p>$${product.price}</div>
                <p class="my-0 fw-bold">Description:</p>
                <p class=" mt-0 text-wrap">${product.discription}</p>
                <div class="ms-auto text-right">
                    <a href="addcart.php?pid=${product.productid}" class="btn btn-primary " ">Add to cart</a>
                </div>
              </div>
            `;
            productList.appendChild(productCard);
          });
        }
    
        // Fetch and render product list on page load
        fetchProductList();
</script>