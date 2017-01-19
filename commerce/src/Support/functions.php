<?php

if ( ! function_exists('money')) {
    /**
     * Arrange for a flash message.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return \Laracasts\Flash\FlashNotifier
     */
    function money($price, $decimals = 2)
    {

        $setting = \Leafr\Core\Setting::class;

        if( $setting::find('money_format')->value == 'european' ) 
        {
            return number_format($price, $decimals, ',' , '.') . ' ' . $setting::find('currency')->value ;
        }

        return number_format($price, $decimals) . ' ' . $setting::find('currency')->value ;
    }
}
