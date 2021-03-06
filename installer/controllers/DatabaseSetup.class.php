<?php
/**
 * Installation step: database setup
 *
 * @copyright (C) 2011 by iRail vzw/asbl
 * @license AGPLv3
 * @author Jens Segers
 */

class DatabaseSetup extends InstallController {
    
    public function index() {
        include_once(dirname(__FILE__)."/../../Config.class.php");
        include_once(dirname(__FILE__)."/../../includes/rb.php");
        
        $queries["errors"] = "CREATE TABLE IF NOT EXISTS `errors` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `time` bigint(20) DEFAULT NULL,
              `user_agent` varchar(255) DEFAULT NULL,
              `ip` varchar(255) DEFAULT NULL,
              `url_request` varchar(255) DEFAULT NULL,
              `format` varchar(24) DEFAULT NULL,
              `error_message` text,
              `error_code` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["feedback_messages"] = "CREATE TABLE IF NOT EXISTS `feedback_messages` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `url_request` varchar(255) DEFAULT NULL,
              `msg` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["foreign_relation"] = "CREATE TABLE IF NOT EXISTS `foreign_relation` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `main_object_id` bigint(20) NOT NULL,
              `foreign_object_id` bigint(20) NOT NULL,
              `main_object_column_name` varchar(50) NOT NULL,
              `foreign_object_column_name` varchar(50) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `main_object_id` (`main_object_id`),
              KEY `foreign_object_id` (`foreign_object_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["generic_resource"] = "CREATE TABLE IF NOT EXISTS `generic_resource` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `resource_id` bigint(20) NOT NULL,
              `type` varchar(40) NOT NULL,
              `documentation` varchar(512) NOT NULL,
              `print_methods` varchar(60) NOT NULL,
              `timestamp` int(11) unsigned DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `resource_id` (`resource_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["generic_resource_csv"] = "CREATE TABLE IF NOT EXISTS `generic_resource_csv` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `gen_resource_id` bigint(20) NOT NULL,
              `uri` varchar(128) NOT NULL,
              `resource_id` set('1') DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `gen_resource_id` (`gen_resource_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["generic_resource_db"] = "CREATE TABLE IF NOT EXISTS `generic_resource_db` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `gen_resource_id` bigint(20) NOT NULL,
              `db_name` varchar(128) NOT NULL,
              `db_table` varchar(256) NOT NULL,
              `host` varchar(256) NOT NULL,
              `port` int(11) DEFAULT NULL,
              `db_type` varchar(20) NOT NULL,
              `db_user` varchar(50) NOT NULL,
              `db_password` varchar(50) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `gen_resource_id` (`gen_resource_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["package"] = "CREATE TABLE IF NOT EXISTS `package` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `package_name` varchar(255) NOT NULL,
              `timestamp` bigint(20) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["published_columns"] = "CREATE TABLE IF NOT EXISTS `published_columns` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `generic_resource_id` bigint(20) NOT NULL,
              `column_name` varchar(50) NOT NULL,
              `is_primary_key` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `generic_resource_id` (`generic_resource_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["remote_resource"] = "CREATE TABLE IF NOT EXISTS `remote_resource` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `resource_id` bigint(20) NOT NULL,
              `package_name` varchar(64) NOT NULL,
              `base_url` varchar(50) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `resource_id` (`resource_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["requests"] = "CREATE TABLE IF NOT EXISTS `requests` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `time` bigint(20) DEFAULT NULL,
              `user_agent` varchar(255) DEFAULT NULL,
              `ip` varchar(40) DEFAULT NULL,
              `url_request` varchar(512) DEFAULT NULL,
              `package` varchar(64) DEFAULT NULL,
              `resource` varchar(64) DEFAULT NULL,
              `format` varchar(24) DEFAULT NULL,
              `subresources` varchar(128) DEFAULT NULL,
              `reqparameters` varchar(128) DEFAULT NULL,
              `allparameters` varchar(164) DEFAULT NULL,
              `requiredparameter` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";    
        
        $queries["resource"] = "CREATE TABLE IF NOT EXISTS `resource` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `resource_name` varchar(255) NOT NULL,
              `package_id` varchar(255) NOT NULL,
              `creation_timestamp` bigint(20) NOT NULL,
              `last_update_timestamp` bigint(20) NOT NULL,
              `type` varchar(60) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `package_id` (`package_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $queries["info"] = "CREATE TABLE IF NOT EXISTS `info` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `value` varchar(255) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `name` (`name`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        
        $tables = array();
        foreach($queries as $table=>$query) {
            $tables[$table] = "failed";
        }
        
        try {
            R::setup(Config::$DB, Config::$DB_USER, Config::$DB_PASSWORD);
            
            foreach($queries as $table=>$query) {
                R::exec($query);
                $tables[$table] = "passed";
            }
            
            if(!$this->installer->installedVersion()) {
                $info = R::dispense("info");
                $info->name = "version";
                $info->value = $this->installer->version();
                R::store($info);
            }
            else {
                $info = R::findOne('info','name=:name LIMIT 1', array(":name"=>"version"));
                $info->value = $this->installer->version();
                R::store($info);
            }
            
            $data["status"] = "passed";
            $data["tables"] = $tables;
        }
        catch(Exception $e) {
            $data["status"] = "failed";
            $data["tables"] = $tables;
            $data["message"] = $e->getMessage();
            $this->installer->nextStep(FALSE);
        }
        
        $this->view("database_setup", $data);
    }
    
}