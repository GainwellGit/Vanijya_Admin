<?php
include("api.php");
$ccavenue_api = new CCAvenue_API();

//Get pendingorders list
$pendingorders = array('reference_no' => '16708354258349807112232' , 'order_no'=> '16708354258349807112232');

$response=$ccavenue_api->orderStatusTracker($pendingorders);

print_r($response);
echo 'hellodd';
echo '<br>';
//dom_pseudo_bytes
/*$plaintext = "message to be encrypted";
$cipher = "AES-128-CBC";
if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
	//$ciphertext = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    //$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key='IOGHFX2546878979844', $options=0, $iv, $tag);
echo '<br>';
    echo $ciphertext;
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key='IOGHFX2546878979844', $options=0, $iv, $tag);
    echo $original_plaintext."\n";
}*/

/*$plaintext = "message to be encrypted";
$cipher = "aes-128-gcm";
$key = "UYTRDXCVB6594865865";
if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
    echo $original_plaintext."\n";
}*/

?>
