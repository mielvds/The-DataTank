<?php/* Copyright (C) 2011 by iRail vzw/asbl
 * Author:  Jan Vansteenlandt <jan aŧ iRail.be>
 * Author:  Pieter Colpaert <pieter aŧ iRail.be>
 * License: AGPLv3
 *
 * This file contains the first frontier that dispaches requests to different method calls. This file will receive the call
 *
 * Notice: If this file reaches more than 100 lines a rewrite is needed
 */
include_once ("printer/PrinterFactory.php");
include_once ("error/Exceptions.class.php");
include_once ("requests/RequestLogger.class.php");
include_once ("error/ErrorHandler.class.php");
include_once ("modules/FederatedModules.php");
include_once ("modules/General/Federated.class.php");
include_once ("Config.class.php");

$methodname;
$format;
$result;
try {
	/*
	 Get the format, keys and values,
	 pass them to our PrinterFactory which returns our formatter, if the formatter exists ofcourse.
	 */

	$format = "";

	if(isset($_GET["format"])) {
		$format = $_GET["format"];
	}
	if($format == "") {
		$format = "Xml";
	}

	//make sure the first letter is uppercase and the rest is lowercase
	$format = ucfirst(strtolower($format));

	/*
	 Check if the method exists in some module and fill in the required parameters.
	 Return an exception if a module or method does not exist. If some required parameters
	 aren't passed, we throw a special exception for that as well.
	 */
	$result;
	if(isset($_GET["module"])) {
		$module = $_GET["module"];

		if(isset($_GET["method"])) {
			$methodname = $_GET["method"];

			if(file_exists("modules/$module/$methodname.class.php")) {
				//get the new method
				include_once ("modules/$module/$methodname.class.php");

				$method = new $methodname();

				// check if the given format is allowed by the method
				// if not, throw an exception and return the allowed formats
				// to the user.
				if(!in_array(strtolower($format), $method -> allowedPrintMethods())) {
					throw new FormatNotAllowedTDTException($format, $method);
				}
			}else if(array_key_exists($module, FederatedModules::$modules)) {
				$method = new Federated($module, $methodname, FederatedModules::$modules[$module]);
			} else {
				throw new MethodOrModuleNotFoundTDTException($module . "/" . $method);
			}
			//execute the method when no error occured
			$result = $method -> call();
		}
	} else {
		throw new MethodOrModuleNotFoundTDTException("No module");
	}
	/*
	 Now print the bloody thing in the preferred format or if none given and if allowed our default format.
	 */
	$rootname = $methodname;
	$rootname = strtolower($rootname);
	$printer = PrinterFactory::getPrinter($rootname, $format, $rootname, $result);
	$printer -> printAll();
} catch(Exception $e) {
	//Oh noes! An error occured! Let's send this to our error handler for logging purposes
	ErrorHandler::logException($e);
}

/*
 We log this request in any case! Even if it's not a valid one.
 */
RequestLogger::logRequest();
?>

