<?php

class Order
{
    public $order_id;
    public $user_id;
    public $note;
    public $date;
    public $due_time;
    public $status;
    public function __construct($order_id = null, $user_id = null, $note = null, $date = null, $due_time = null, $status = null)
    {
        if ($order_id !== null) {
            $this->order_id = $order_id;
            $this->user_id = $user_id;
            $this->note = $note;
            $this->date = $date;
            $this->due_time = $due_time;
            $this->status = $status;
        }
    }
    public function getOrderId()
    {
        return $this->order_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDueTime()
    {
        return $this->due_time;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setNote($note): void
    {
        $this->note = $note;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function setDueTime($due_time): void
    {
        $this->due_time = $due_time;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }


}