<?php
/*
Plugin Name:neocart
Plugin URI: 
Description: 
Version: 1.0
Author: Amirul Momenin 
Author URI: 
License: GPL
*/
ob_start(); // line 1
session_start(); // line 2
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

add_action('admin_menu', 'cart_add_pages'); 
function cart_add_pages() {
	add_menu_page("Products", "Products", "activate_plugins", "products", "admin_products");
}

function admin_products() { 
    include_once dirname(__FILE__) . '/admin/products/products.php';
}
/* Runs when plugin is activated */
register_activation_hook(__FILE__,'neocart_install'); 
/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'neocart_remove' );
function neocart_install()
 {  
    //create page
    create_page("products");
	
	/* Creates new database field */
	global $neocart_db_version;
	$neocart_db_version = "1.0";
    global $wpdb;
    global $neocart_db_version;

  
	 
	$table_name = $wpdb->prefix."products";   
    $sql1 = "CREATE TABLE $table_name(
		  id int(10) NOT NULL AUTO_INCREMENT,
		  brand_name varchar(125) NOT NULL,	
		  price decimal(10,2) NOT NULL,	
		  discount decimal(10,2) NOT NULL,		  
		  description text NOT NULL,
		  file_products varchar(256) NOT NULL,
		  date_created datetime NOT NULL,
		  status enum('active','inactive') NOT NULL,
		  PRIMARY KEY (id)
     );";

				
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql1);	
	
    add_option("neocart_db_version", $neocart_db_version);
	
	//create page
	//include_once dirname(__FILE__) . '/create-page.php';
	
}
function create_page($title)
{
    global $wpdb; 
	
	//Products
    $the_page_title = $title;
    $the_page_name = $title;
	
    delete_option("my_plugin_page_title");
    add_option("my_plugin_page_title", $the_page_title, '', 'yes');
	
    delete_option("my_plugin_page_name");
    add_option("my_plugin_page_name", $the_page_name, '', 'yes');
	
    delete_option("my_plugin_page_id");
    add_option("my_plugin_page_id", '0', '', 'yes');
	
    $the_page = get_page_by_title( $the_page_title );
    if ( ! $the_page ) {
        $_p = array();
        $_p['post_title'] = $the_page_title;
        $_p['post_content'] = "[".$title."]";
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1);
        $the_page_id = wp_insert_post( $_p );
    }
}

function neocart_remove()
{
    global $wpdb;	

    
	$table_name = $wpdb->prefix."products";   
	$sql = "DROP TABLE ". $table_name;
	$wpdb->query($sql);
	
	//remove page
	global $wpdb;

    $the_page_title = get_option( "my_plugin_page_title" );
    $the_page_name = get_option( "my_plugin_page_name" );
    $the_page_id = get_option( 'my_plugin_page_id' );
    if( $the_page_id ) {
        wp_delete_post( $the_page_id ); 
    }
    delete_option("my_plugin_page_title");
    delete_option("my_plugin_page_name");
    delete_option("my_plugin_page_id");
}

//short code Products
function products_sort_code_func( $atts ) {
	include_once dirname(__FILE__) . '/products.php';
}
add_shortcode( 'products', 'products_sort_code_func' );
?>
