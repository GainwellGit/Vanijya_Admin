<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MySoapServer extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model(''); //load your models here

        $this->load->library("Nusoap_lib"); //load the library here
        $this->nusoap_server = new soap_server();
        $this->nusoap_server->configureWSDL("MySoapServer", "urn:MySoapServer");
        $this->nusoap_server->register(
                "echoTest", array("tmp" => "xsd:string"), array("return" => "xsd:string"), "urn:MySoapServer", "urn:MySoapServer#echoTest", "rpc", "encoded", "Echo test"
        );

        /**
         * To test whether SOAP server/client is working properly
         * Just echos the input parameter
         * @param string $tmp anything as input parameter
         * @return string returns the input parameter
         */
        function echoTest($tmp) {
            if (!$tmp) {
                return new soap_fault('-1', 'Server', 'Parameters missing for echoTest().', 'Please refer documentation.');
            } else {
                return "from MySoapServer() : $tmp";
            }
        }
    }

    function index() {
        $this->nusoap_server->service(file_get_contents("php://input")); //shows the standard info about service
    }
}