<?php

namespace App\Helpers;

class TokenHelper
{
    /**
     * Format digit token into groups of 4 characters.
     *
     * @param string $token
     * @return string
     */
    public static function formatToken($token)
    {
        // Hapus spasi dari token untuk memastikan hanya digit
        $cleanedToken = str_replace(' ', '', $token);

        // Format token menjadi 4 digit terpisah
        return wordwrap($cleanedToken, 4, '-', true);
    }

    /**
     * Clean token by removing spaces.
     *
     * @param string $token
     * @return string
     */
    public static function cleanToken($token)
    {
        return str_replace(' ', '', $token);
    }
}
