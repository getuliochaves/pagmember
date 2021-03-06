<?php
/*
Plugin Name: PagMember
Plugin URI: http://www.pagmember.com
Description: Plugin de integração com o Hotmart e PagSeguro para área de Membros. Após a aprovação do pagamento, gera o usuário e a senha para o cliente e envia para o email automaticamente.
Version: 5.93
Author: Getulio Chaves
Author URI: http://www.geracaodigital.com
License: GPLv2
*/
include_once('updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
		$config2 = array(
			'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
			'proper_folder_name' => 'PagMember', // this is the name of the folder your plugin lives in
			'api_url' => 'https://api.github.com/repos/getuliochaves/PagMember', // the GitHub API url of your GitHub repo
			'raw_url' => 'https://raw.github.com/getuliochaves/PagMember/master', // the GitHub raw url of your GitHub repo
			'github_url' => 'https://github.com/getuliochaves/PagMember', // the GitHub url of your GitHub repo
			'zip_url' => 'https://github.com/getuliochaves/PagMember/zipball/master', // the zip url of the GitHub repo
			'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
			'requires' => '3.0', // which version of WordPress does your plugin require?
			'tested' => '4.9.8', // which version of WordPress is your plugin tested up to?
			'readme' => 'README.md', // which file to use as the readme for the version number
			'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
		);
		new WP_GitHub_Updater_PagMember($config2);
	}
?>
<?php
global $wpdb;
add_filter( 'plugin_action_links', 'LinkConfiguracaoPagMember', 10, 2 );
add_filter( 'plugin_row_meta', 'LinkAlternativosPagmember', 10, 2 );
function LinkConfiguracaoPagMember($links, $file) {	static $this_plugin; if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__); if ( $file == $this_plugin ){$settings_link = '<a href="admin.php?page=pagmember">' . __('Configurações', 'pagmember') . '</a>'; array_unshift( $links, $settings_link );} return $links; } function LinkAlternativosPagmember( $links, $file ) { $base = plugin_basename(__FILE__); if ( $file == $base ) {$links[] = '<a href="admin.php?page=pagmember">' . __( 'Configurações','pagmember' ) . '</a>';	}return $links;	}

add_action('admin_menu', 'menu_pagMember');
function menu_pagMember(){
add_menu_page('PagMember - Plugin de Membros', 'PagMember', 'level_10', 'pagmember', 'supercore',plugins_url("logo.png", __FILE__), 40);
}
function supercore(){
include_once('assets/inc_supercore.php');
}
?>
