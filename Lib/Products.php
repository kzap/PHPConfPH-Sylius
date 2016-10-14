<?php

namespace Lib;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\ProductVariant;
use Sylius\Component\Product\Model\Attribute;
use Sylius\Component\Product\Model\AttributeValue;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
                $product->setCode($row->product_id);
                $product->setName($row->product_name);
                $product->setDescription($row->product_description);

                $productVariant = new ProductVariant();
                $productVariant->setPrice((int) $row->product_srp);
                $product->addVariant($productVariant);

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
  
                $product = new Product();
                $product->setCurrentLocale('en');
                $product->setFallbackLocale('en');
                $product->setCode($row->product_id);
                $product->setName($row->product_name);
                $product->setDescription($row->product_description);

                return $product;
            }

            /* free result set */
            $result->close();
        }

        return false;
    }
}
