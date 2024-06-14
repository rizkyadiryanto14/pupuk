<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans
{
	public function __construct()
	{
		// Set server key
		\Midtrans\Config::$serverKey = 'SB-Mid-server-EypGHr0pVcQ5Hkc-N8qGIn03';
		// Set ke mode production atau sandbox
		\Midtrans\Config::$isProduction = false;
		// Optional, set true untuk sanitasi input
		\Midtrans\Config::$isSanitized = true;
		// Optional, set true untuk enable 3D Secure
		\Midtrans\Config::$is3ds = true;
	}

	/**
	 * @param $params
	 * @return string
	 * @throws Exception
	 */

	public function getSnapToken($params): string
	{
		return \Midtrans\Snap::getSnapToken($params);
	}
}

