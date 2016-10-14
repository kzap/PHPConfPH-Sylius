<?php
include('includes/application_top.php');

use \Lib\Products;
use \Lib\Order;
use Sylius\Component\Core\Model\OrderItem;
use Sylius\Component\Core\Model\OrderItemUnit;

// code goes here
$order = new Order();

if (isset($_GET['action']) == 'add_to_cart' && isset($_GET['product_id'])) {
    $productsApp = new Products($mysqli);
    $product = $productsApp->getProductById($_GET['product_id']);

	$item = new OrderItem();
	$item->setUnitPrice(123); // fake price

	// get QTY
	$qty = 1;
    if (isset($_GET['qty']) && $_GET['qty']) {
        $qty = (int) $_GET['qty'];
    }

    // add 1 unit per qty
    for ($i = 0; $i < $qty; $i++) {
        $itemUnit = new OrderItemUnit($item);
        $item->addUnit($itemUnit);    
    }

	$order->addItem($item);
}

$orderItems = $order->getItems();

?>
<?php include('includes/header.php'); ?>
<header>
	<h1>My Cart</h1>
</header>
<div class="container-fluid well">
	<div class="row">
        <h2># of Cart Items: <?php echo $order->getTotalQuantity(); ?></h2><br />
        <h2>Cart Total: PHP <?php echo $order->getItemsTotal(); ?></h2>
    </div>
</div>
<?php include('includes/footer.php'); ?>