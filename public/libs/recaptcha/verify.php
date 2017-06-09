<form action="" method="post">
<?php

require_once('public/libs/recaptcha/recaptchalib.php');

$publickey = "6LeGnyMUAAAAAB650V5WA_pVlZiclcuS4ETj7IcB";
$privatekey = "6LeGnyMUAAAAAAN8gaER26lP52BFdnvD6u91EnYf";

$resp = null;
$error = null;


if (isset($_POST["recaptcha_response_field"])){
    $resp = recaptcha_check_answer ($privatekey,
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]);

    if ($resp->is_valid) {
        $_SESSION['checkCaptcha'] = "OK";
        echo "<script>window.location = '?page=registro'</script>";
    } else {
        $_SESSION['checkCaptcha'] = "BAD";
        echo recaptcha_get_html($publickey, $error);
    }
}else{
    echo recaptcha_get_html($publickey, $error);
}

?>
    <br/>
    <input type="submit" class="btn btn-info" value="Verificar"/>
</form>