<?php


class OrderDetail
{
    public $order_id;
    public $product_id;
    public $quantity;

    public function __construct($order_id = null, $product_id = null, $quantity = null)
    {
        if ($order_id !== null) {
            $this->order_id = $order_id;
            $this->product_id = $product_id;
            $this->quantity = $quantity;
        }
    }

    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }


}