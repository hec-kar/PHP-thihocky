<?php


class Shop
{
    public $shop_id;
    public $name;
    public $address;
    public $image;
    public function __construct($shop_id = null, $name = null, $address = null, $image = null)
    {
        if ($shop_id !== null) {
            $this->shop_id = $shop_id;
            $this->name = $name;
            $this->address = $address;
            $this->image = $image;
        }
    }

    /**
     * Get the value of shop_id
     */
    public function getShop_id()
    {
        return $this->shop_id;
    }

    /**
     * Set the value of shop_id
     *
     * @return  self
     */
    public function setShop_id($shop_id)
    {
        $this->shop_id = $shop_id;

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
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address): self
    {
        $this->address = $address;

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