


<?php
/*
Plugin Name: ıyzico taksitlendirme
Plugin URI: https://wordpress.org/plugins/iyzi-taksit-new
Description: Ürün için Taksitlendirme tablosunu gösterir
Version: 0.0.1
Author: Feyzullah Demir
Author URI: https:iyzico.com
License: GNU
*/

class IyzicoTaksitTag
{
	 protected static $instance;
       
        public static function getInstance() {

            if (self::$instance === null ) {
                self::$instance = new self();
            }

            return self::$instance;
        }



	


public static function iyzicoActive(){
global $wpdb;
$charset = $wpdb->get_charset_collate();
$tableName = $wpdb->prefix."taksit";
$sql = "CREATE TABLE $tableName (
id INT(55) NOT NULL AUTO_INCREMENT ,
İnstBank varchar(255) NOT NULL ,
instNumber INT(55) NOT NULL ,
instPrice INT(55) NOT NULL ,
instStatus ENUM('0','1') NOT NULL ,
UNIQUE KEY id (id)
) $charset;";
require_once (ABSPATH. "wp-admin/includes/upgrade.php");

dbDelta($sql);


}

public static function iyziDeactivation(){



            global $wpdb;
            $tableName = $wpdb->prefix."taksit";
            $charset = $wpdb->get_charset_collate();
            

            $sql = "DROP TABLE IF EXISTS $tableName;";
            $wpdb->query($sql);
           
            flush_rewrite_rules();
}



}

require_once ('wpAdminTaksit.php');

require_once ('wpProductTab.php');

IyzicoTaksitTag::getInstance();
register_activation_hook(__FILE__ , 'iyzicoActive');
register_deactivation_hook( __FILE__, 'iyziDeactivation' );







?>
