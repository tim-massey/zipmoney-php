<?php
/**
 * @category  ZipMoney
 * @package   ZipMoney_SDK
 * @author    Sagar Bhandari <sagar.bhandari@zipmoney.com.au>
 * @copyright 2015 ZipMoney Payments.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.zipmoney.com.au/
 */

class ZipMoney_Http
{
    private $_baseEndpointUrl = null;

    private $_endpointUrl     = null;

    private $_config          = array();

    private $_httpHeader      = array();


    public function __construct($baseEndpointUrl, $type = "json", $config=null)
    {
        
        if(!$baseEndpointUrl)
            throw new  ZipMoney_Exception_Http("Request endpoint url should be Provided", 1);
            
        $this->_baseEndpointUrl = $baseEndpointUrl;

        if(is_array($config))
            $this->_config   = $config;

    }

    public function get($path)
    {   

        $this->_appendPath($path);

        return $this->_curlRequest('GET');
    }

    public function post($path,$params = null)
    {   

        $this->_appendPath($path);

        return $this->_curlRequest('POST', $params);
      
    }

    public function delete($path)
    {   
        $this->_appendPath($path);

        return $this->_curlRequest('DELETE', $path);
    }

    public function put($path, $params = null)
    { 
        $this->_appendPath($path);

       return $this->_curlRequest('PUT', $params);

    }

    public function getEndPointUrl()
    {

        if(isset($this->_endpointUrl) && !empty($this->_endpointUrl)){
            return $this->_endpointUrl;
        }
        else {
            return false;
        }
    }

    private function _appendPath($path)
    {

        if(!isset($path) || empty($path))             
          throw new  ZipMoney_Exception_Http("Request endpoint path should be provided", 1);
        

        if ($this->_baseEndpointUrl && $path) 
            $this->_endpointUrl = $this->_baseEndpointUrl.ltrim($path, '/');
    }

 
    public function setHttpHeader($headers)
    {   
        if(isset($headers) && !empty($headers))
         $this->_httpHeader = $headers;
    }

    private function _curlRequest($httpMethod, $requestBody = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $httpMethod);
        curl_setopt($curl, CURLOPT_URL, $this->getEndPointUrl());
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        
        if($this->_httpHeader)
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->_httpHeader);

        // curl_setopt($curl, CURLOPT_VERBOSE, true);

        # If SSL flag is true
        if ($this->_config && $this->_config['ssl']){
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_CAINFO, $this->_config['caFile']);
        }

        if(!empty($requestBody)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestBody));
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($this->_config && $this->_config['ssl']){
            if ($httpStatus == 0) {
                throw new ZipMoney_Exception_Http();
            }
        }
        return array('status' => $httpStatus, 'body' => $response);
    }
}
