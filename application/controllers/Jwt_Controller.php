
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Jwt_Controller extends REST_Controller {
	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
		parent::__construct();
		

	}
	function login_post(){
			define('SECRET_KEY','Your-Secret-Key');  /// secret key can be a random string and keep in secret from anyone
			define('ALGORITHM','HS512');
			$tokenId    = base64_encode(32);
            $issuedAt   = time();
            $notBefore  = $issuedAt + 10;  //Adding 10 seconds
            $expire     = $notBefore + 7200; // Adding 60 seconds
            $serverName = 'http://localhost/react/'; /// set your domain name
            $data = array(
                'iat'  => $issuedAt,         // Issued at: time when the token was generated
                'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
                'iss'  => $serverName,       // Issuer
                'nbf'  => $notBefore,        // Not before
                'exp'  => $expire,           // Expire
                'data' => array(
					array(
						'id'	=>	1,
						'name'	=>	'aaa',
						'age'	=>	'10'
					),
					array(
						'id'	=>	2,
						'name'	=>	'bbb',
						'age'	=>	'20'
					),
					array(
						'id'	=>	3,
						'name'	=>	'ccc',
						'age'	=>	'60'
					),
					array(
						'id'	=>	4,
						'name'	=>	'ddd',
						'age'	=>	'25'
					)
				)
            ); 

            $secretKey = base64_decode(SECRET_KEY);
                  /// Here we will transform this array into JWT:
          $jwt = Jwt_Controller::encode(
                    $data, //Data to be encoded in the JWT
                    $secretKey, // The signing key
                     ALGORITHM 
                   ); 
          echo $jwt;
          

          echo '<pre>';
          $data = Jwt_Controller::decode($jwt,$secretKey);

			echo json_encode($data);
		}
 

	public static function decode($jwt, $key = null, $verify = true){
        	$tks = explode('.', $jwt);
	        if (count($tks) != 3) {
	            throw new UnexpectedValueException('Wrong number of segments');
	        }
        	list($headb64, $payloadb64, $cryptob64) = $tks;
        if (null === ($header = Jwt_Controller::jsonDecode(Jwt_Controller::urlsafeB64Decode($headb64)))) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        if (null === $payload = Jwt_Controller::jsonDecode(Jwt_Controller::urlsafeB64Decode($payloadb64))
        ) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        $sig = Jwt_Controller::urlsafeB64Decode($cryptob64);
        if ($verify) {
            if (empty($header->alg)) {
                throw new DomainException('Empty algorithm');
            }
            if ($sig != Jwt_Controller::sign("$headb64.$payloadb64", $key, $header->alg)) {
                throw new UnexpectedValueException('Signature verification failed');
            }
        }
        return $payload;
    }

    /**
     * @param object|array $payload PHP object or array
     * @param string       $key     The secret key
     * @param string       $algo    The signing algorithm
     *
     * @return string A JWT
     */
    public static function encode($payload, $key, $algo = 'HS256')
    {
        $header = array('typ' => 'JWT', 'alg' => $algo);

        $segments = array();
        $segments[] = Jwt_Controller::urlsafeB64Encode(Jwt_Controller::jsonEncode($header));
        $segments[] = Jwt_Controller::urlsafeB64Encode(Jwt_Controller::jsonEncode($payload));
        $signing_input = implode('.', $segments);

        $signature = Jwt_Controller::sign($signing_input, $key, $algo);
        $segments[] = Jwt_Controller::urlsafeB64Encode($signature);

        return implode('.', $segments);
    }

    /**
     * @param string $msg    The message to sign
     * @param string $key    The secret key
     * @param string $method The signing algorithm
     *
     * @return string An encrypted message
     */
    public static function sign($msg, $key, $method = 'HS256')
    {
        $methods = array(
            'HS256' => 'sha256',
            'HS384' => 'sha384',
            'HS512' => 'sha512',
        );
        if (empty($methods[$method])) {
            throw new DomainException('Algorithm not supported');
        }
        return hash_hmac($methods[$method], $msg, $key, true);
    }

    /**
     * @param string $input JSON string
     *
     * @return object Object representation of JSON string
     */
    public static function jsonDecode($input)
    {
        $obj = json_decode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            Jwt_Controller::handleJsonError($errno);
        }
        else if ($obj === null && $input !== 'null') {
            throw new DomainException('Null result with non-null input');
        }
        return $obj;
    }

    /**
     * @param object|array $input A PHP object or array
     *
     * @return string JSON representation of the PHP object or array
     */
    public static function jsonEncode($input)
    {
        $json = json_encode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            JWT::handleJsonError($errno);
        }
        else if ($json === 'null' && $input !== null) {
            throw new DomainException('Null result with non-null input');
        }
        return $json;
    }

    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * @param int $errno An error number from json_last_error()
     *
     * @return void
     */
    private static function handleJsonError($errno)
    {
        $messages = array(
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON'
        );
        throw new DomainException(isset($messages[$errno])
            ? $messages[$errno]
            : 'Unknown JSON error: ' . $errno
        );
    }

  }

	?>