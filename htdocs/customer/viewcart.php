<?php 
include '../customer/authenticate.php';
include '../customer/header.php';

?>
<div class="container mt-5">
    <h2>Your Cart</h2>

    <!-- Product List -->
    <div id="productList" class="d-flex flex-wrap gap-2">
        <!-- Products will be dynamically inserted here -->
    </div>
</div>

<script>
    function fetchProductList() {
          const result=fetch('http://localhost/customer/getcartproducts.php')
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
              <div class="card-body">
                <img class="img-fluid rounded" width=100 height=100 src="../shared/images/${product.img}" alt="">
                <h5 class="card-title">${product.productName}</h5>
                <p class="card-text">Price: $${product.price}</p>
                <p class="card-text">Description: ${product.discription}</p>
                <div class="ms-auto text-right">
                    <a href="removecart.php?cartid=${product.cartid}" class="btn btn-danger " ">Remove</a>
                </div>
              </div>
            `;
            productList.appendChild(productCard);
          });
        }
    
        // Fetch and render product list on page load
        fetchProductList();
</script>