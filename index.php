<?php
include('includes/application_top.php');

use \Lib\Products as Products;

// code goes here
$productsApp = new Products($mysqli);
$products = $productsApp->getAllProducts();
?>
<?php include('includes/header.php'); ?>
<header>
	<h1>My Awesome Store</h1>
</header>
<div class="container-fluid well">
	<div class="row">
	<?php foreach ($products as $product): ?>
		<div class="col-md-4" align="center">
			<img src="<?php echo $product->getImage()->getPath(); ?>" class="img-responsive" alt="Responsive image" style="width: 300px; height: 250;" />
			<strong><?php echo $product->getName(); ?></strong><br />
			<br />
			<h3>PHP <?php echo number_format($product->getPrice()); ?></h3>
			<br />
			<!--
			<a href="/cart.php?action=add_to_cart&product_id=<?php echo $product->getCode(); ?>" class="btn btn-success">
				Add To Cart
			</a>
			-->
			<form action="/cart" method="POST">
				<select name="qty">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
				<button class="btn btn-success">Add To Cart</button>
				<input type="hidden" name="product_id" value="<?php echo $product->getCode(); ?>" />
				<input type="hidden" name="action" value="add_to_cart" />
			</form>

		</div>
	<?php endforeach; ?>
	</div>
</div>
<?php include('includes/footer.php'); ?>