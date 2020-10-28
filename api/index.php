<?php
  header( "Access-Control-Allow-Origin: *" );
  header( "Content-Type: application/json; charset=UTF-8" );

  include_once 'search-string.php';
  
  if ($_SERVER['REQUEST_METHOD'] != 'POST') :
    set_response( 405, $validation['method_not_allowed'] );
    return;
  endif;

  if ( isset( $_POST['url'] ) ) :
    if ( !is_array( $_POST['url'] ) ) :
      set_response( 406, $validation['invalid_url'] );
      return;
    endif;
  else :
    set_response( 406, $validation['empty_url'] );
    return;
  endif;

  if ( !isset( $_POST['q'] )) :
    set_response( 406, $validation['empty_q'] );
    return;
  endif;

  $url = isset( $_POST['url'] ) ? $_POST['url'] : '';
  $q = isset( $_POST['q'] ) ? $_POST['q'] : '';

  run( $url, $q );

?>