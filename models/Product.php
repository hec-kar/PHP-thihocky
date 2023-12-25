<?php

class Product
{
    public $product_id;
    public $name;
    public $description;
    public $shop_id;
    public $quantity;
    public $price;
    public $type;
    public $image;


    public function __construct($product_id = null, $name = null, $description = null, $shop_id = null, $quantity = null, $price = null, $type = null, $image = null)
    {
        if ($product_id !== null) {
            $this->product_id = $product_id;
            $this->name = $name;
            $this->description = $description;
            $this->shop_id = $shop_id;
            $this->quantity = $quantity;
            $this->price = $price;
            $this->type = $type;
            $this->image = $image;
        }
    }


    /**
     * Get the value of product_id
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProductId($product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of shop_id
     */
    public function getShopId()
    {
        return $this->shop_id;
    }

    /**
     * Set the value of shop_id
     */
    public function setShopId($shop_id): self
    {
        $this->shop_id = $shop_id;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
?>