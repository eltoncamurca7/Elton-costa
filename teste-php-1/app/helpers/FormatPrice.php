<?php

namespace App\helpers;

class FormatPrice
{
    public function formatUnitPrice($unit_price)
    {
        $unit_price = str_replace(',', '.', $unit_price);
        return number_format($unit_price, 2, '.', '');
    }
}
