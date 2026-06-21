<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';

class Midtrans
{
    public function __construct()
    {
        $CI = &get_instance();

        $CI->load->config('midtrans');

        \Midtrans\Config::$serverKey = $CI->config->item('server_key');
        \Midtrans\Config::$clientKey = $CI->config->item('client_key');
        \Midtrans\Config::$isProduction = $CI->config->item('is_production');

        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }
}
