<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
      .card{
        width: 300px;
        height: auto;
      }
    </style>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Tony</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../vendor/home.php">Home</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">View Products</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href='../vendor/addProducts.php'>Add products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../api/logout.php">Log out</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Product Management</h2>
    
        <!-- Product List -->
        <div id="productList" class="d-flex flex-wrap gap-2">
          <!-- Products will be dynamically inserted here -->
        </div>
      </div>
    
      <!-- Modal for Update Product -->

            <div class="container" id="updateModel">
              <img src="" class="rounded img-fluid w-25" alt="" id="updateImg">
              <form id="updateProductForm" action="../vendor/update.php" method="post">
                <input type="hidden" id="updateProductId" name="productid">
                <div class="form-group">
                  <label for="updateProductPrice">Price</label>
                  <input type="number" class="form-control" id="updateProductPrice" name="price" required>
                </div>
                <div class="form-group">
                  <label for="updateProductDescription">Description</label>
                  <input type="text" class="form-control" id="updateProductDescription" name="discription" required>
                </div>
                <div class="d-flex mt-2 justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
              </form>
              <button id="cancelUpdate"  class="btn mt-1 btn-danger">Cancel</button>

            </div>


      <script>
        const updateModel=document.getElementById('updateModel')
        const productList=document.getElementById('productList')
        // Fetch and render product list from server
        function fetchProductList() {
          const result=fetch('http://localhost/vendor/productList.php')
          result.then(e=>e.json().
          then(e=>renderProductList(e))
          .catch(e=>console.log(e))
          )
        }
    
        // Function to render product list
        function renderProductList(products) {
            document.getElementById('productList').classList.add('d-flex')
            document.getElementById('productList').classList.remove('d-none')
            document.getElementById('updateModel').classList.remove('d-block')
            document.getElementById('updateModel').classList.add('d-none')

          const productList = document.getElementById('productList');
          productList.innerHTML = '';
    
          products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'card mb-3';
            productCard.innerHTML = `
              <div class="p-3 card d-flex flex-column gap-0">
                <img class="img-fluid rounded w-100 h-auto"  src="../shared/images/${product.img}" alt="">
                <h5 class="card-title">${product.productName}</h5>
                <div class="mb-0 d-flex"><p class="fw-bold me-1">Price: </p>$${product.price}</div>
                <p class="my-0 fw-bold">Description:</p>
                <p class=" mt-0 text-wrap">${product.discription}</p>
                <div class="d-flex gap-2 justify-content-between">
                    <button class="btn btn-primary updateBtn" data-id="${product.productid}" data-img="${product.img}" data-price="${product.price}" data-discription="${product.discription}">Update</button>
                    <a href="delete.php?pid=${product.productid}" class="btn btn-danger deleteBtn" ">Delete</a>
                </div>
              </div>
            `;
            productList.appendChild(productCard);
          });
        }
    
        // Fetch and render product list on page load
        fetchProductList();
    
        // Event listener for update buttons
          document.addEventListener('click', function(event) {
          if (event.target.classList.contains('updateBtn')) {
            const productId = event.target.getAttribute('data-id');
            const price=event.target.getAttribute('data-price');
            const image=event.target.getAttribute('data-img')
            const discription=event.target.getAttribute('data-discription');
            console.log(productId,price,discription)
            document.getElementById('productList').classList.remove('d-flex')
            document.getElementById('productList').classList.add('d-none')
            document.getElementById('updateModel').classList.add('d-block')
            document.getElementById('updateModel').classList.remove('d-none')
            document.getElementById('updateProductId').value = productId;
            document.getElementById('updateProductPrice').value = price;
            document.getElementById('updateProductDescription').value = discription;
            document.getElementById('updateImg').src="../shared/images/"+image
          
            }
            })
        
            document.getElementById('cancelUpdate').addEventListener('click',()=>{
                document.getElementById('updateModel').classList.remove('d-block')
                document.getElementById('updateModel').classList.add('d-none')
                document.getElementById('productList').classList.add('d-flex')
                document.getElementById('productList').classList.remove('d-none')
            })
      </script>
</body>
</html>