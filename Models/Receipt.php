<?php

declare(strict_types=1);

namespace App\Models;

class Receipt
{
    /**
     * @var int $id
     */
    protected int $id;

    /**
     * @var int $publisher
     */
    protected int $user_id;

    /**
     * @var string $payment_date
     */
    protected string $payment_date;

    /**
     * @var int $amount
     */
    protected int $amount;


    public function __construct(array $receipt)
    {
        $this->hydrate($receipt);
    }

    /**
     * This method is called when the class is instantiated
     * and assign value for each setter methods
     * 
     * @param array $e
     * @return void
     */
    private function hydrate(array $r): void
    {
        foreach ($r as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method) && !empty($value)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUser_id(): int
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getPayment_date(): string
    {
        return $this->payment_date;
    }

    // SETTERS

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        if (is_int($id) && $id > 0) {
            $this->id = $id;
        }
    }

    /**
     * @param int $amount
     * @return void
     */
    public function setAmount(string $amount): void
    {
        if (is_string($amount) && isset($amount)) {
            $this->amount = $amount;
        }
    }

    /**
     * @param string $date
     * @return void
     */
    public function setPayment_date(string $date): void
    {
        if (is_string($date) && isset($date)) {
            $this->payment_date = $date;
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function setUser_id(int $id): void
    {
        if (is_int($id) && $id > 0) {
            $this->user_id = $id;
        }
    }
}
