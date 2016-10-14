<?php

namespace Lib;

use Sylius\Component\Core\Model\Product;

/**
 * @author andre@enthropia.com
 */
class Products
{
    protected $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function getAllProducts()
    {
        if ($result = $this->mysqli->query('SELECT * FROM `Products` WHERE 1')) {
        	$products = array();

            while ($row = $result->fetch_object()) {

                $product = new Product();
                $product->setCurrentLocale('en');
                $product->setFallbackLocale('en');
                $product->setName($row->product_name);
                $product->setDescription($row->product_description);

                $products[] = $product;
            }

            /* free result set */
            $result->close();

            return $products;
        }

        return false;
    }

    public function getProductById($id)
    {
        if ($result = $this->mysqli->query(sprintf('SELECT * FROM `Products` WHERE `product_id` = %s', $id))) {
        	
        	if ($row = $result->fetch_object()) {
                dump($row);
/*
                $product = new Product();
                $product->setCurrentLocale('en');
                $product->setFallbackLocale('en');
                $product->setName($row->product_name);
                $product->setDescription($row->product_description);

                return $product;
*/
            }

            /* free result set */
            $result->close();
        }

        return false;
    }
}