<?php

declare(strict_types=1);


namespace App\Models\User;

class PremiumUser
{
    /**
     * @var int $user_id
     */
    protected int $user_id;

    /**
     * @var int $id
     */
    protected int $id;

    /**
     * @var string $sbc_start
     */
    protected string $sbc_start; // subscription start

    /**
     * @var string $sbc_end
     */
    protected string $sbc_end; // subscription end


    public function __construct(array $user)
    {
        $this->hydrate($user);
    }

    private function hydrate(array $news): void
    {
        foreach ($news as $key => $value) {
            $method = 'get' . ucfirst($key);

            if (method_exists($this, $method)) {
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
     * @return string
     */
    public function getSubscription_start()
    {
        $date = new \DateTime($this->sbc_start);
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getSubscription_end(): string
    {
        $date = new \DateTime($this->sbc_end);
        return $date->format('Y-m-d H:i:s');
    }

    // SETTERS

    /**
     * @return nuul|void
     */
    public function setSubscription_start(string $date = '')
    {
        if (empty($date)) {
            $date = new \DateTime();
            $this->sbc_start = $date->format('Y-m-d H:i:s');
            return null;
        }

        $date = new \DateTime($date);
        $this->sbc_start = $date->format('Y-m-d H:i:s');
    }

    /**
     * @return null|void
     */
    public function setSubscription_end(string $date = '')
    {
        if (empty($date)) {
            $start = new \DateTime($this->sbc_start);
            $interval = new \DateInterval('P0Y1M0DT0H0M0S');
            $end = $start->add($interval);

            $this->sbc_end = $end;
            return null;
        }

        $date = new \DateTime($date);
        $this->sbc_end = $date->format('Y-m-d H:i:s');
    }

    /**
     * @return null|void
     */
    public function setUser_id(int $id)
    {
        if (!is_int($id) || $id <= 0) {
            return null;
        }

        $this->user_id = $id;
    }

    /**
     * @return null|void
     */
    protected function setId(int $id)
    {
        if (!is_int($id) || $id <= 0) {
            return;
        }

        $this->id = $id;
    }
}
