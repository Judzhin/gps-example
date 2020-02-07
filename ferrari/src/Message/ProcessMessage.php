<?php

namespace App\Message;

/**
 * Class ProcessMessage
 * @package App\Message
 */
final class ProcessMessage
{
    /** @var array */
    private $data = [];

    /**
     * ProcessMessage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }
}