


<?php
/*
Plugin Name: Taksitlendirme
Plugin URI: https:iyzico.com
Description: Ürün için Taksitlendirme tablosunu gösterir
Version: 0.0.1
Author: Feyzullah Demir
Author URI: https:iyzico.com
License: GNU
*/


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

register_activation_hook(__FILE__ , 'creating_plugin_table');


require_once ('wpAdminTaksit.php');





require_once ('wpProductTab.php');




?>