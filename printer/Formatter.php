<?php

require_once 'XML/Serializer.php';

class Formatter {
    static function format($rootname, $format, $object, $version) {
        if ($format == "Json") {
            return Formatter::format_json($rootname, $object, $version);
        } else if ($format == "Jsonp") {
            return Formatter::format_jsonp($rootname, $object, $version);
        } else if ($format == "Xml") {
            return Formatter::format_xml($rootname, $object, $version);
        } else if ($format == "Kml") {
            return Formatter::format_kml($rootname, $object, $version);
        } else if ($format == "Php") {
             return Formatter::format_php($rootname, $object, $version);
        } else {
            return Formatter::format_fail($rootname, $object, $version);
        }
    }

    static function format_json($rootname, $object, $version) {
        $hash = get_object_vars($object);
        $hash['version'] = $version;
        $hash['timestamp'] = 0;
        return json_encode($hash);
    }
    
    static function format_jsonp($rootname, $object, $version) {
        
    }

    static function format_xml($rootname, $object, $version) {
        $hash = get_object_vars($object);
        $hash['version'] = $version;
        $hash['timestamp'] = 0;

        $options = array (
            'addDecl' => TRUE,
            'encoding' => 'utf-8',
            'indent' => '  ',
            'rootName' => 'data',
            "defaultTagName"  => "item",
        ); 
        $serializer = new XML_Serializer($options);
        $status = $serializer->serialize($hash);
        return $serializer->getSerializedData();
    }

    static function format_kml($rootname, $object, $version) {
        /*echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";*/

    }

    static function format_php($rootname, $object, $version) {
        return var_dump($object);
    }

    static function format_fail($rootname, $object, $version) {
        return 'epic fail';
    }
}
