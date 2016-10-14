<?php

namespace Lib;

use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\ProductVariant;
use Sylius\Component\Core\Model\ProductVariantImage;

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

                $product = $this->createProduct($row);
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
  
                $product = $this->createProduct($row);

                return $product;
            }

            /* free result set */
            $result->close();
        }

        return false;
    }

    protected function createProduct($row)
    {
    	$product = new Product();
        $product->setCurrentLocale('en');
        $product->setFallbackLocale('en');
        $product->setCode($row->product_id);
        $product->setName($row->product_name);
        $product->setDescription($row->product_description);

        $productVariant = new ProductVariant();
        $productVariant->setPrice((int) $row->product_srp);
        
        // add image
        $productVariantImage = new ProductVariantImage();
        $productVariantImage->setPath($row->product_image);
        $productVariant->addImage($productVariantImage);

        $product->addVariant($productVariant);

        return $product;
    }
}
