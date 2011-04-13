<?php
require_once('../classes/recaptcha/recaptchalib.php');
 
$privatekey = "6LeToMESAAAAACwMLmZbFeO-dOkzZVCTZmUBmTHD";
 
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if ($resp->is_valid) {
	echo "success";
} else {
	echo "error";
}