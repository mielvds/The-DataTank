<?php 
/**
 * This class is returns the number of queries/errors made on/in the API/methods per day.
 *
 * @package The-Datatank/modules/TDTInfo
 * @copyright (C) 2011 by iRail vzw/asbl
 * @license AGPLv3
 * @author Pieter Colpaert   <pieter@iRail.be>
 * @author Jan Vansteenlandt <jan@iRail.be>
 */

class Queries extends AResource{
    // must be set! Contains the value of the module that needs to be analysed.
    private $module; 
    // if set only look at certain data from a certain method within the given module.
    private $resource;
    private $queryResults;

    public static function getParameters(){
	return array("module" => "Name of a module that needs to be analysed, must be set !",
		     "resource" => "Name of a resource within the given module, is not required.",
	);
    }

    public static function getRequiredParameters(){
        return array("module");
    }

    public function setParameter($key,$val){
        if($key == "module"){
            $this->module = $val;
        }elseif($key == "resource"){
            $this->resource = $val;
        }
    }

    private function getData() {
        R::setup(Config::$DB, Config::$DB_USER, Config::$DB_PASSWORD);
        /* Send a query to the server */
	$requeststable = "requests";
	$errorstable = "errors";
	
	// to make a correct query we need to find out if the resource is set, if not
	// we cannot use it in our query
	$clausule;
	$params = array();
	
	if(isset($this->resource)){
	    $clausule = "module=:module and resource=:resource";
	    $params = array(':module' => $this->module, ':resource' => $this->resource);
	}else{
	    $clausule = "module=:module";
	    $params = array(':module' => $this->module);
	}
	
	/*
	 * Simple count of the amount of errors and requests
	 */
        $requests = R::getAll(
            "select count(1) as amount, time from $requeststable where $clausule GROUP BY from_unixtime(time,'%D %M %Y')",
	    $params
        );
	
	/*
	 * Errors are trickier to query, because we do not know even if a resource is specified along with 
	 * the request, if that resource is to be found in a certain url_request that returned an error
	 * because the error might just be a wrong resource call. So, where only taking the module in consideration !
	 */
	$regexp = Config::$HOSTNAME.$this->module;
	$errors = R::getAll(
            "select count(1) as amount,time from $errorstable where url_request regexp :regexp GROUP BY from_unixtime(time,'%D %M %Y')"
	    ,array(':regexp' => $regexp)
        );
	
        $this->queryResults = new stdClass();
        $this->queryResults->requests = $requests;
        $this->queryResults->errors = $errors;
	
    }

    public function call(){
        $this->getData();
        return $this->queryResults;
    }

    public static function getAllowedPrintMethods(){
        return array("json","xml", "jsonp", "php", "html");
    }

    public static function getDoc(){
        return "Lists the number of queries(requests/errors) to this datatank"
            . "instance per day";
    }
}
?>
