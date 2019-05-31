<?php

class Helpers
{
    public function toReal($value)
    {
        return number_format($value, 2, ',', '.');
    }

}
