<?php

namespace MovieSearch\Helper;

/**
 * @codeCoverageIgnore
 */
class ShuffleService
{
    public function shuffle(array $data)
    {
        shuffle($data);
        return $data;
    }
}