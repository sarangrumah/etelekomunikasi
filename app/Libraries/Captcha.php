<?php

namespace App\Libraries;

use App\Models\Provinsi;
class Captcha
{
    function generate()
    {
        session_start();

        // Generate captcha code
        $provinsi = Provinsi::inRandomOrder()->first();
        $captcha_code = $provinsi->name;
        // Assign captcha in session
        session(['CAPTCHA_CODE' => $captcha_code]);
        // Create captcha image
        $layer = imagecreatetruecolor(252, 37);
        $captcha_bg = imagecolorallocatealpha($layer, 0, 0, 0, 127);
        imagefill($layer, 0, 0,$captcha_bg);
        imagesavealpha($layer, true);
        $captcha_text_color = imagecolorallocate($layer, 255, 255, 255);
        imagestring($layer, 10, 10, 10, $captcha_code, $captcha_text_color);
        header("Content-type: image/jpeg");
        imagepng($layer);
    }
}
