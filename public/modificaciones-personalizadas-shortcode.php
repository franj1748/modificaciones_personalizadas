<?php

// Código corto para obtener el usuario actual.
add_shortcode( 'usuario', '_modper_obtener_usuario');
function _modper_obtener_usuario(){

    // Se obtiene el ID del usuario actual
    $member_ID = get_current_user_id();

    // Si no hay ningún usuario registrado, memberID será 0
    if($member_ID != 0){
      // Se obtiene la información completa del usuario mediante su ID
      $member_Info = get_userdata($member_ID);
      $miembro_Rol = $member_Info->roles;
      $miembro_actual = $miembro_Rol[0];
      // De la información obtenida, sólo se toma el nombre de usuario 
      $member_Login_Name = $member_Info->first_name;
      $member_Login_Last = $member_Info->last_name;
      if($member_Login_Name == ""){
        $member_Login_Name = $member_Info->user_login;
      }
      ob_start();
      ?>
      <p id="wp_usuario" class="wp_usuario_res">
          <?php echo 'Rol de usuario: '.$miembro_actual.'<br> Nombre: '.$member_Login_Name.' '.$member_Login_Last; ?>
      </p>
      <?php
      $salida = ob_get_contents();
      ob_end_clean();
      return $salida;
    }else{
      return 'No hay ningún usuario registrado';
    }
}

add_shortcode( 'user_gravatar', '_modper_obtener_gravatar');
function _modper_obtener_gravatar(){

  // Se obtiene el ID del usuario actual
  $member_ID = get_current_user_id();
  
  // Si no hay ningún usuario registrado, memberID será 0
  if($member_ID != 0){
    
    // Se obtiene la imagen del avatar del usuario conectado.
    $url_avatar = get_avatar_url($member_ID);
    ob_start();
    ?>
    <img alt="gravatar" src="<?php echo $url_avatar; ?>" style="width: 50%;"><br><br>
    <?php
    $salida = ob_get_contents();
    ob_end_clean();
    return $salida;
  }else{
      return 'No hay ningún usuario registrado';
  }
}

add_shortcode( 'user_admin_color', '_modper_obtener_admin_color');
function _modper_obtener_admin_color(){

  // Se obtiene el ID del usuario actual
  $member_ID = get_current_user_id();
  
  // Si no hay ningún usuario registrado, memberID será 0
  if($member_ID != 0){
    
      $member_Info = get_userdata($member_ID);
      $miembro_theme_color = $member_Info->admin_color;
    ob_start();
    ?>
    <p><?php echo $miembro_theme_color; echo get_user_option( 'admin_color' ) ?></p><br><br>
    <?php
    $salida = ob_get_contents();
    ob_end_clean();
    return $salida;
  }else{
      return 'No hay ningún usuario registrado';
  }
}
// Se obtiene el rol del usuario conectado para verificar si se trata de un vendedor y aplicar estilos en caso que lo sea
/*add_action('admin_enqueue_scripts', 'cdm_obtener_rol');
function cdm_obtener_rol(){
  // Se obtiene la información completa del usuario mediante su ID
  $miembro_ID = get_current_user_id();
  // De la información obtenida, sólo se toma el rol de usuario 
  $miembro_Info = get_userdata($miembro_ID);
  $miembro_Rol = $miembro_Info->roles;
  $miembro_vendedor = $miembro_Rol[0];
  if($miembro_vendedor === "dc_vendor"){
    // Agrega estilos a la cabecera del front
    add_action( 'admin_head', function () { 

      ?>
        <style id='79660115'>
            
        </style>
      <?php 

    });
  }
}/*