<div class="col-sm-3">
  <div class="left-sidebar">
    <h2>Category</h2>
    <?php $categories = $user->fetch_categories(); ?>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

      <?php foreach ($categories as $item) :?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title"><a href="shop.php?cat=<?php echo $item['Id'];?>"><?php echo $item['Name'];?></a></h4>
        </div>
      </div>
      <?php endforeach; ?>
    </div><!--/category-products-->

  <?php $brands = $user->fetch_brands(); ?>

    <div class="brands_products"><!--brands_products-->
      <h2>Brands</h2>
      <div class="brands-name">
        <ul class="nav nav-pills nav-stacked">
          <?php foreach ($brands as $item) :?>
          <li><a href="shop.php?brand=<?php echo $item['Brand'];?>"> <span class="pull-right">(<?php echo $item['NUM'];?>)</span><?php echo $user->getBrand($item['Brand']);?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div><!--/brands_products-->
   </div>
</div>
