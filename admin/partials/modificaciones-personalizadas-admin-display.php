<?php

require_once MODPER_RUTA.'public/modificaciones-personalizadas-shortcode.php';

if(!current_user_can('manage_options'))  {
	wp_die(__('No tienes suficientes permisos para ver esta página.', 'modificaciones_personalizadas'));
};


if(!isset($_GET['tab'])){
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options';
}else{
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options';
}

function change_footer_admin(){

	$url= $_SERVER["REQUEST_URI"];
	$tagline = explode('?', $url);
	$page_tagline = explode('&', $tagline[1]);

	if ($page_tagline[0] === 'page=modificaciones_personalizadas'){
		echo 'Hecho con ♥ por <a href="https://www.linkedin.com/in/francisco-elis-24506b209" target="_blank">Francisco Elis</a> | <a href="https://accesoweb.online/portafolios/" target="_blank">Acceso Web</a> © 2022';
	} 
}
add_filter('admin_footer_text', 'change_footer_admin');

/**
 * Proporcionar una vista del área de administración para el plugin.
 *
 * Este archivo se utiliza para marcar los aspectos del complemento orientados al administrador.
 *
 * @link       https://github.com/franj1748/modificaciones_personalizadas.git
 * @since      1.0.0
 * @package    modificaciones_personalizadas
 */
?>
<!-- Este archivo debe consistir principalmente en HTML con un poco de PHP. -->
<div class="wrap">
	<h1 class="titulo-superior" style="display: inline;"><?php echo esc_html_e(get_admin_page_title(), 'modificaciones_personalizadas'); ?></h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox cdm-postbox-container">
						<h2 class="titulo-cabecera">
							<span>
								<?php 
									esc_attr_e('Sobre el plugin', 'modificaciones_personalizadas'); 
								?>
							</span>
						</h2>
						<div class="inside">
							<p class="inside-p">
								<?php 
									esc_attr_e('Aquí podrás configurar tus opciones personalizadas para modificar WordPress, bien sea en el panel de administración, el frontend u otro plugin, sin alterar el código fuente original. Estas modificaciones no se perderán al actualizar WordPress. Gracias por confiar en mis servicios.', 'modificaciones_personalizadas'); 
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox cdm-postbox-container">
						<h2>
							<span>
								<?php
									echo _modper_obtener_usuario();
                                    echo _modper_obtener_gravatar();
									esc_attr_e('¿Necesitas soporte?', 'modificaciones_personalizadas'); 
								?>
							</span>
						</h2>
						<div class="inside">
							<a target="_blank" href="https://www.linkedin.com/in/francisco-elis-24506b209">
								<button type="button" class="button-primary">
									<?php 
										esc_attr_e('Chatea conmigo en Linkedin', 'modificaciones_personalizadas'); 
									?>
								</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox cdm-postbox-container">
						<div class="inside">
							<h2 class="nav-tab-wrapper">
								<a href="?page=modificaciones_personalizadas&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>">General</a>
								<a href="?page=modificaciones_personalizadas&tab=other_options" class="nav-tab <?php echo $active_tab == 'other_options' ? 'nav-tab-active' : ''; ?>">Contacto</a>
							</h2>
                            <form method="POST" action="options.php" id="setting">
								<?php
								if($active_tab == 'general_options' || $active_tab == ''){
									settings_fields('modificaciones_personalizadas'); 
									do_settings_sections('modificaciones_personalizadas'); 
									submit_button(__('Guardar Cambios', 'modificaciones_personalizadas')); 
								} else {
									?>
										<div id="poststuff">
											<div id="post-body" class="metabox-holder columns-2">
												<div id="post-body-content">
													<div class="meta-box-sortables ui-sortable">
														<div class="postbox cdm-postbox-container">
															<h2 class="titulo-cabecera">
																<span>
																	<?php 
																		esc_attr_e('¿Quieres contratar otro de mis servicios?', 'modificaciones_personalizadas'); 
																	?>
																</span>
															</h2>
															<div class="inside">
																<?php 
																	esc_attr_e('Escríbeme a este', 'modificaciones_personalizadas');
																?>
																<a href="<?php echo esc_url('mailto:admin@accesoweb.online?subject=Quiero%20información%20de%20sus%20servicios.')?>">
																	<?php 
																		esc_attr_e('correo.', 'modificaciones_personalizadas');
																	?>
																</a>
																<br class="clear">
																<br class="clear">
																<?php 
																	esc_attr_e('Conoce más de mi trabajo', 'modificaciones_personalizadas');
																?>
																<a href="<?php echo esc_url('https://accesoweb.online/portafolios/')?>">
																	<?php 
																		esc_attr_e('aquí.', 'modificaciones_personalizadas');
																	?>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php
								} 
							?>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>
</div>













<!-- <h2 class="titulo-cabecera"><span><?php esc_attr_e( 'Configuración', 'modificaciones_personalizadas' ); ?></span></h2> -->
<!-- <div class="d-flex">
	<div class="flex-grow-1 m-1 item-slider">
		<div class="border border-1 rounded highlight-texts">
			<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row"><label for="slug">Slug</label></th>
						<td>
							<textarea class="w-100 regular-text" name="slug" id="slug" placeholder="Slug de cada campo en el orden de aparición, separados por coma" value='<?=get_option('modper_slug')?>'></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="valores">Valores</label></th>
						<td>
							<textarea class="w-100 regular-text" name="valores" id="valores" placeholder="Valor de cada campo en el orden de aparición, separados por coma" value='<?=get_option('modper_valores')?>'></textarea>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="d-flex justify-content-center mt-3">
		<button type="submit" form="setting" class="button-primary">Guardar</button>
	</div>
</div> -->

<!-- // Actualizar opciones cuando se crean desde el formulario sin utilizar la API de opciones de WordPress
/* if(!empty($_POST)){ 
    
    update_option('modper_slug', $_POST['slug']);
    update_option('modper_valores', $_POST['valores']);
    echo("<div class='notice notice-success is-dismissible inline' style='padding: 10px'><p>¡Opciones guardadas!</p></div>");
}; */

// Obtener URL de la página actual
/* if(!isset($URL_actual)){

	$URL_actual = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}; */ -->