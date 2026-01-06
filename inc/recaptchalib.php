<?php
/**
 * reCAPTCHA v2 PHP library
 * Updated for PHP 8.3 compatibility
 */

/**
 * Gets the HTML for reCAPTCHA v2
 * @param string $pubkey Public site key
 * @param string $error Error message (optional)
 * @return string HTML for reCAPTCHA widget
 */
function recaptcha_get_html($pubkey, $error = null, $use_ssl = false) {
    if (empty($pubkey)) {
        die("To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin'>https://www.google.com/recaptcha/admin</a>");
    }

    $html = '<div class="g-recaptcha" data-sitekey="' . htmlspecialchars($pubkey) . '"></div>';
    if ($error) {
        $html = '<div class="g-recaptcha" data-sitekey="' . htmlspecialchars($pubkey) . '" data-error="' . htmlspecialchars($error) . '"></div>';
    }
    $html .= '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    return $html;
}

/**
 * Response object for reCAPTCHA verification
 */
class ReCaptchaResponse {
    public bool $is_valid;
    public ?string $error;
}

/**
 * Verifies the reCAPTCHA response
 * @param string $privkey Private secret key
 * @param string $remoteip User's IP address
 * @param string $response g-recaptcha-response from form
 * @return ReCaptchaResponse
 */
function recaptcha_check_answer($privkey, $remoteip, $challenge, $response) {
    if (empty($privkey)) {
        die("To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin'>https://www.google.com/recaptcha/admin</a>");
    }

    if (empty($response)) {
        $recaptcha_response = new ReCaptchaResponse();
        $recaptcha_response->is_valid = false;
        $recaptcha_response->error = 'missing-input-response';
        return $recaptcha_response;
    }

    // Build POST request to Google's verification endpoint
    $data = [
        'secret' => $privkey,
        'response' => $response,
        'remoteip' => $remoteip
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);

    if ($result === false) {
        $recaptcha_response = new ReCaptchaResponse();
        $recaptcha_response->is_valid = false;
        $recaptcha_response->error = 'verification-failed';
        return $recaptcha_response;
    }

    $json = json_decode($result, true);

    $recaptcha_response = new ReCaptchaResponse();
    $recaptcha_response->is_valid = $json['success'] ?? false;
    if (!$recaptcha_response->is_valid) {
        $recaptcha_response->error = isset($json['error-codes']) ? implode(', ', $json['error-codes']) : 'unknown-error';
    }

    return $recaptcha_response;
}

/**
 * Gets the signup URL for reCAPTCHA
 */
function recaptcha_get_signup_url($domain = null, $appname = null) {
    return "https://www.google.com/recaptcha/admin";
}

// Legacy functions for backward compatibility (deprecated)
function _recaptcha_qsencode($data) {
    return http_build_query($data);
}

function _recaptcha_http_post($host, $path, $data, $port = 80) {
    // Not used in v2
    return ['', ''];
}

define("RECAPTCHA_API_SERVER", "https://www.google.com/recaptcha/api");
define("RECAPTCHA_API_SECURE_SERVER", "https://www.google.com/recaptcha/api");
define("RECAPTCHA_VERIFY_SERVER", "www.google.com");

// Mailhide functions (updated to use openssl instead of mcrypt)
function _recaptcha_aes_pad($val) {
    $block_size = 16;
    $numpad = $block_size - (strlen($val) % $block_size);
    return str_pad($val, strlen($val) + $numpad, chr($numpad));
}

function _recaptcha_aes_encrypt($val, $ky) {
    // Note: Updated to use openssl_encrypt instead of deprecated mcrypt
    if (!function_exists("openssl_encrypt")) {
        die("To use reCAPTCHA Mailhide, you need openssl extension.");
    }
    $iv = str_repeat("\0", 16);
    return openssl_encrypt($val, 'AES-128-CBC', $ky, OPENSSL_RAW_DATA, $iv);
}

function _recaptcha_mailhide_urlbase64($x) {
    return strtr(base64_encode($x), '+/', '-_');
}

function recaptcha_mailhide_url($pubkey, $privkey, $email) {
    if (empty($pubkey) || empty($privkey)) {
        die("To use reCAPTCHA Mailhide, you have to sign up for a public and private key.");
    }

    $ky = pack('H*', $privkey);
    $cryptmail = _recaptcha_aes_encrypt($email, $ky);

    return "https://mailhide.recaptcha.net/d?k=" . $pubkey . "&c=" . _recaptcha_mailhide_urlbase64($cryptmail);
}

function _recaptcha_mailhide_email_parts($email) {
    $arr = preg_split("/@/", $email);

    if (strlen($arr[0]) <= 4) {
        $arr[0] = substr($arr[0], 0, 1);
    } elseif (strlen($arr[0]) <= 6) {
        $arr[0] = substr($arr[0], 0, 3);
    } else {
        $arr[0] = substr($arr[0], 0, 4);
    }
    return $arr;
}

function recaptcha_mailhide_html($pubkey, $privkey, $email) {
    $emailparts = _recaptcha_mailhide_email_parts($email);
    $url = recaptcha_mailhide_url($pubkey, $privkey, $email);

    return htmlentities($emailparts[0]) . "<a href='" . htmlentities($url) .
        "' onclick=\"window.open('" . htmlentities($url) . "', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;\" title=\"Reveal this e-mail address\">...</a>@" . htmlentities($emailparts[1]);
}

?>
