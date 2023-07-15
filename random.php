<!DOCTYPE html>
<html>
<head>
  <title>Random Product Images</title>
  <style>
    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      display: inline-block;
      margin: 10px;
      text-align: center;
    }
    article {
  --img-scale: 1.001;
  --title-color: black;
  --link-icon-translate: -20px;
  --link-icon-opacity: 0;
  position: relative;
  border-radius: 16px;
  box-shadow: none;
  background: #fff;
  transform-origin: center;
  transition: all 0.4s ease-in-out;
  overflow: hidden;
}

article a::after {
  position: absolute;
  inset-block: 0;
  inset-inline: 0;
  cursor: pointer;
  content: "";
}

/* basic article elements styling */
article h2 {
  margin: 0 0 18px 0;
  font-family: "Bebas Neue", cursive;
  font-size: 1.9rem;
  letter-spacing: 0.06em;
  color: var(--title-color);
  transition: color 0.3s ease-out;
}

figure {
  margin: 0;
  padding: 0;
  aspect-ratio: 16 / 9;
  overflow: hidden;
}

article img {
  max-width: 100%;
  transform-origin: center;
  transform: scale(var(--img-scale));
  transition: transform 0.4s ease-in-out;
}

.article-body {
  padding: 24px;
}

article a {
  display: inline-flex;
  align-items: center;
  text-decoration: none;
  color: #28666e;
}

article a:focus {
  outline: 1px dotted #28666e;
}

article a .icon {
  min-width: 24px;
  width: 24px;
  height: 24px;
  margin-left: 5px;
  transform: translateX(var(--link-icon-translate));
  opacity: var(--link-icon-opacity);
  transition: all 0.3s;
}

/* using the has() relational pseudo selector to update our custom properties */
article:has(:hover, :focus) {
  --img-scale: 1.1;
  --title-color: #28666e;
  --link-icon-translate: 0;
  --link-icon-opacity: 1;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
}


/************************ 
Generic layout (demo looks)
**************************/

*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 48px 0;
  font-family: "Figtree", sans-serif;
  font-size: 1.2rem;
  line-height: 1.6rem;
  background-image: linear-gradient(45deg, #7c9885, #b5b682);
  min-height: 100vh;
}

.articles {
  display: grid;
  max-width: 1200px;
  margin-inline: auto;
  padding-inline: 24px;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 24px;
}

@media screen and (max-width: 960px) {
  article {
    container: card/inline-size;
  }
  .article-body p {
    display: none;
  }
}

@container card (min-width: 380px) {
  .article-wrapper {
    display: grid;
    grid-template-columns: 100px 1fr;
    gap: 16px;
  }
  .article-body {
    padding-left: 0;
  }
  figure {
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  figure img {
    height: 100%;
    aspect-ratio: 1;
    object-fit: cover;
  }
}

.sr-only:not(:focus):not(:active) {
  clip: rect(0 0 0 0); 
  clip-path: inset(50%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap; 
  width: 1px;
}
  </style>
</head>
<body>
  <ul id="product-list">
    <li>
      <img src="" width="100" height='100' alt="Product Image">
      <p>Product 1</p>
    </li>
    <li>
      <img src="" width="100" height='100' alt="Product Image">
      <p>Product 2</p>
    </li>
    <li>
      <img src="" width="100" height='100' alt="Product Image">
      <p>Product 3</p>
    </li>
    <!-- Add more product items as needed -->
  </ul>

  <section class="articles">
  <article>
    <div class="article-wrapper">
      <figure>
        <img src="https://picsum.photos/id/1011/800/450" alt="" />
      </figure>
      <div class="article-body">
        <h2>This is some title</h2>
        <p>
          Curabitur convallis ac quam vitae laoreet. Nulla mauris ante, euismod sed lacus sit amet, congue bibendum eros. Etiam mattis lobortis porta. Vestibulum ultrices iaculis enim imperdiet egestas.
        </p>
        <a href="#" class="read-more">
          Read more <span class="sr-only">about this is some title</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </a>
      </div>
    </div>
  </article>

  <script>
    // Array of random image URLs
    var imageUrls = [
      "pic_forApp/restuarents/1.jpg",
      "pic_forApp/restuarents/2.jpg",
      "pic_forApp/restuarents/3.jpg",
      "pic_forApp/restuarents/4.jpg",
      "pic_forApp/restuarents/5.jpg",
      "pic_forApp/restuarents/6.jpg",
      "pic_forApp/restuarents/7.jpg",
      // Add more image URLs as needed
    ];


    // Get the product list element
    var productList = document.getElementById("product-list");

    // Iterate over each product item
    var productItems = productList.getElementsByTagName("li");
    for (var i = 0; i < productItems.length; i++) {
      // Generate a random index to select a random image URL
      var randomIndex = Math.floor(Math.random() * imageUrls.length);

      // Set the src attribute of the image element
      var imgElement = productItems[i].getElementsByTagName("img")[0];
      imgElement.src = imageUrls[randomIndex];
    }


    $(document).ready(function() {
  $('.add-to-cart').click(function() {
    var productId = $(this).data('product-id');
    
    $.ajax({
      url: 'add_to_cart.php', // Replace with your server-side script URL
      method: 'POST',
      data: { productId: productId },
      success: function(response) {
        // Update the quantity in the UI
        var cartQuantity = parseInt($('#cart-quantity').text());
        $('#cart-quantity').text(cartQuantity + 1);
        
        // Show a success message
        alert('Product added to cart!');
      },
      error: function() {
        alert('Error occurred. Please try again.');
      }
    });
  });
});

  </script>
</body>
</html>


