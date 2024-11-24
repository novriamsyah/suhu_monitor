<?php

namespace App\Helper;

class CurrencyHelper
{
    /**
     * Mengonversi angka ke format IDR (Rupiah).
     *
     * @param  int  $amount
     * @return string
     */
    public static function formatIDR($amount)
    {
        return 'Rp. ' . number_format($amount, 0, ',', '.');
    }
}
