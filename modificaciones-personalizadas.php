<?php

/**
 * @package           modificaciones_personalizadas
 * @author            Francisco Elis
 * @copyright         2022 Acceso Web
 * @license           GPL-2.0-or-later
 * @link              https://github.com/franj1748/modificaciones_personalizadas.git
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Modificaciones personalizadas
 * Plugin URI:        https://github.com/franj1748/modificaciones_personalizadas.git
 * Description:       Personalice su instalación de WordPress, en el backend o el frontend, sin manipular los archivos del núcleo.     
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Francisco Elis
 * Author URI:        https://www.linkedin.com/in/francisco-elis-24506b209
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       modificaciones_personalizadas
 */

// Si este archivo se llama directamente por cualquier otra instancia que no sea WordPress, abortar.
if (!defined('WPINC')){
	die;
}

/**
 * Definición de las constantes para la versión del plugin y la ruta completa.
 */
define( 'MODPER_VERSION', '1.0.0' );
define('MODPER_RUTA', plugin_dir_path(__FILE__));

/**
* Activación del plugin.
*/
function _modper_activate_plugin(){
	require_once MODPER_RUTA.'includes/class-modificaciones-personalizadas-activator.php';
}

/**
* Desactivación del plugin.
*/
function _modper_deactivate_plugin(){
	require_once MODPER_RUTA.'includes/class-modificaciones-personalizadas-deactivator.php';
}

register_activation_hook( __FILE__, '_modper_activate_plugin');
register_deactivation_hook( __FILE__, '_modper_deactivate_plugin');

/**
 * Archivos requeridos al iniciar el plugin. 
 */
function _modper_plugin_init(){
      
  require_once MODPER_RUTA.'public/modificaciones-personalizadas-shortcode.php';
  require_once MODPER_RUTA.'admin/partials/register-plugin-settings.php';
}
add_action( 'init', '_modper_plugin_init' );

/**
 * Incrustar scripts JS en el panel de administración.
 */
function _modper_add_script_wp_admin(){
    wp_enqueue_script('js-admin-modper', plugins_url('admin/js/modificaciones-personalizadas-admin.js', __FILE__));
    wp_enqueue_script('sweetalert-admin-modper', plugins_url('admin/js/sweetalert.min.js', __FILE__));
}
add_action('admin_footer', '_modper_add_script_wp_admin');

/**
 * Incrustar scripts JS en el frontend.
 */
function _modper_add_script_wp_public(){
	wp_register_script('js-user-modper', plugins_url( 'public/js/modificaciones-personalizadas-public.js', __FILE__ ), array(), '1.0.0', true); 
	wp_enqueue_script( 'js-user-modper');
  // Enviar cualquier variable PHP a JavaScript al registrar el archivo. 
  $options = get_option('modper_options');
	wp_localize_script ( 'js-user-modper' ,  'MODPER_const' ,  
    array ( 
      'slugs'   => __ ($options['modper_slug']),
      'valores' => __ ($options['modper_valores'])
    ) 
  ) ; 
}
add_action( 'wp_enqueue_scripts', '_modper_add_script_wp_public');

/**
 * Incrustar estilos al panel de administración.
*/
add_action('admin_enqueue_scripts', '_modper_add_style_wp_admin');
function _modper_add_style_wp_admin(){
    wp_enqueue_style('style-admin-modper', plugins_url('admin/css/modificaciones-personalizadas-admin.css', __FILE__));
}

/**
 * Incrustar estilos al frontend
*/
add_action('wp_enqueue_scripts', '_modper_add_style_wp_public');
function _modper_add_style_wp_public(){
    wp_register_style( 'style-user-modper', plugins_url( 'public/css/modificaciones-personalizadas-public.css', __FILE__ ), array(), '20120208', 'all' );
    wp_enqueue_style( 'style-user-modper' );
}

/* Incluir cdn de Bootstrsp */
/* Bootstrap CSS */
/*function bootstrap_css() {
	wp_enqueue_style( 'bootstrap_css', 
    'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css', 
    array(), 
    '5.2.0'
  ); 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_css');

/* Bootstrap JS y dependencia popper */
/*function bootstrap_js() {
	wp_enqueue_script( 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js', 
    array('jquery','popper_js'), 
    '5.2.0', 
		true
	); 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_js');*/