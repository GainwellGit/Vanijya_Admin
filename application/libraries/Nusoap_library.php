<?php
require_once('lib/nusoap'.EXT);
require_once('lib/class.wsdlcache'.EXT);
class Nusoap_library
{
    function Nusoap_librarys()
    {
        require_once('lib/nusoap'.EXT);
    }

    function soaprequest($api_url, $api_username, $api_password, $service, $params,$xml)
    {
            if ($api_url != '' && $service != '' ){
                $wsdl = $api_url; //.'?wsdl';
                 // $wsdl = $api_url;
                 
                $params = $xml;
               //  $params = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions"> <soapenv:Header/><soapenv:Body><urn:ZFM_API_GET_CUSTOMER_DETAILS><I_MOBILE>9871895284</I_MOBILE><T_CUSTOMER><item><KUNNR>?</KUNNR><NAME1>?</NAME1><STR_SUPPL1>?</STR_SUPPL1><STR_SUPPL2>?</STR_SUPPL2><STR_SUPPL3>?</STR_SUPPL3><CITY1>?</CITY1><POST_CODE1>?</POST_CODE1><BEZEI>?</BEZEI><STCD3>?</STCD3></item></T_CUSTOMER></urn:ZFM_API_GET_CUSTOMER_DETAILS></soapenv:Body></soapenv:Envelope>';
               // echo $wsdl;

              /*  Name: DT_PlaceOrders
                Binding: DT_PlaceOrdersBinding
                Endpoint: https://qapps.gainwellindia.com:443/gcpl/migrated/pmkitQa/index.php
                SoapAction: https://qapps.gainwellindia.com/gcpl/migrated/pmkitQa/index.php/DT_PlaceOrders*/

              /*  $server = new nusoap_server(); // Create a instance for nusoap server
                $server->configureWSDL("DT_PlaceOrders","urn:tipl.com:002:PMKStockInformation");
                $server->register(
                    "DT_PlaceOrders", // name of function
                    array("name"=>"xsd:string"),  // inputs
                    array("return"=>"xsd:integer")   // outputs
                );

                $server->service(file_get_contents("php://input"));*/
                $options = array(
                       'soap_version' => SOAP_1_1,
                       'trace'      => true,
                       'exceptions' => true,
                       'encoding' => 'UTF-8',
                       'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
                       'cache_wsdl' => WSDL_CACHE_DISK,
                       'login' => $api_username,     // <- username here, i got the right one
                       'password' =>$api_password  // <- same
                    );

                $endPoint =  'http://10.131.51.204/XISOAPAdapter/MessageServlet';
              //  $cliente = new nusoap_client('http://piqa:50000/XISOAPAdapter/MessageServlet?wsdl','wsdl','','','','');
               /* $numbers = array('1234567890','0987654321');
                $sv1 = array();
                foreach ($numbers as $index => $number) {
                    $sv1[] = new soapval('Number', 'xsd:string', $number);
                }
                $params = array('TelemarketerId'=>'****', 'WashOnlyUserId'=>'****', 'TelemarketerPassword'=>'****', 'ClientReferenceId'=>'****', 'NumbersToWash'=>$sv1);*/

                $wsdl_location= realpath('lib/sapwsdl.wsdl');
                $wsdl_cache = new nusoap_wsdlcache("lib/"); // for caching purposes
                $wsdl_obj = $wsdl_cache->get($wsdl_location);
                var_dump($wsdl_obj);
                echo "wsdl_obj-pop";
                if (empty($wsdl_obj)) {
                  $wsdl_obj = new wsdl($wsdl_location);
                  $wsdl_fetch = $wsdl_obj->fetchWSDL($wsdl_location);
                  echo "<pre>";
                  var_dump($wsdl_fetch);
                  echo "</br>wsdl_fetch---d ";
                  print_r($wsdl_obj);
                  echo "</pre> endHere";
                  $wsdl_cache->put($wsdl_obj); 
                }
                $cliente = new nusoap_client($wsdl_obj,'wsdl');

                $cliente->setCredentials($api_username,$api_password,$authtype = 'basic');
                $cliente->soap_defencoding  = 'utf-8'; 
                $cliente->decode_utf8       = false; 
                $cliente->xml_encoding      = 'utf-8';
                $cliente->setEndpoint($endPoint);
                $cliente->setHeaders(
                                '<wsse:Security xmlns:wsse="http://hiddenurl.xsd">'.
                                '<wsse:UsernameToken>'.
                                '<wsse:Username>'.$api_username.'</wsse:Username>'.
                                '<wsse:Password Type="http://hiddenurl#PasswordText">'.$api_password.'</wsse:Password>'.
                                '</wsse:UsernameToken>'.
                                '</wsse:Security>'
                                );
              //  $cliente->operations =  array('soap' => 'soap');
                /*
                    Include_once (' soap/nusoap.php '); $client = new Nusoap_client (' http://127.0.0.1:10000 ', ' WSDL '); $client->soap_ defencoding = ' utf-8 '; $client->decode_utf8 = false; $client->xml_encoding = ' utf-8 '; $sContent =settohexstring (' Test send data ');//String to 16 binary $param=array ("susername" = ' xx ', "ssender" = ' 051000000000 ', ' srecvs ' = ') 13851400500 ', ' Nrecvcount ' =>1, ' scontent ' = = $sContent, ' Nfeetype ' =>0); $result = $client->call (' ns__ SendMessage ', $param);p Rint_r ($client->geterror ()). "
";p Rint_r ($result);

                */
                $err = $cliente->getError();
                if ($err) { echo 'Error en Constructor' . $err ; }

                $response = $cliente->call('DT_PlaceOrders',$params,'','', false,true);  //OK
                echo 'response - print_r 1- <br>' ; 
                           print_r($cliente);
                echo 'client - client error- <br>' ; 

                           print_r($cliente->error_str);
                 echo 'response - response 1-<br>' ; 

                           print_r($response);
                return $response;


                $client = new nusoap_client($wsdl, 'wsdl');
                $client->setCredentials($api_username,$api_password,$authtype = 'any');
                $error = $client->getError();
                             
                echo 'client - print_r-<br>' ; 
                           print_r($client);
                if ($error) {
                    echo "\nSOAP Error\n".$error."\n";
                    return false;
                }else{
                    $result = $client->call($service, $params);
                    echo 'library-<br>';
                     var_dump($result);
                     if ($result) {                        
                        if ($client->fault){
                          echo 'print_r-<br>' ; 
                           print_r($result);
                            return false;
                        } else {
                            //$result_arr = json_decode($result, true);
                            //var_dump($result_arr);
                            //$return_array = $result_arr['result'];
                            return $result;
                        }
                    }else{
                            return false;
                    }
                }
            }
    }
}