<?php if ( empty($similar_products) ): ?>
  <div class="col-xs-12">
      <div class="alert alert-warning">
        <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No items found...
      </div>
  </div>

<?php else: ?>

<?php foreach ($suit_products as $item) :?>
<div class="col-sm-3">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img alt="product 1" src="assets/uploads/<?php echo $item['Image'];?>">
                <h2>Ksh <?php echo $item['Price'];?></h2>
                <p><?php echo $item['Name'];?></p>
                <a ref="<?php echo $item['Id'];?>" class="btn btn-default add-cart-button" href="cart.php"><i class="fa fa-shopping-cart"></i>Add to cart</a>
            </div>
            <div class="product-overlay">
                <div class="overlay-content">
                    <h2>Ksh <?php echo $item['Price'];?></h2>
                    <p><?php echo $item['Name'];?></p>
                    <a ref="<?php echo $item['Id'];?>" class="btn btn-default add-cart-button" href="cart.php"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="product-details.php?id=<?php echo $item['Id'];?>"><i class="fa fa-plus-square"></i>View More</a></li>
            </ul>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php endif;?>
