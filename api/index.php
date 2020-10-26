<?php
  header( "Access-Control-Allow-Origin: *" );
  header( "Content-Type: application/json; charset=UTF-8" );

  include_once 'search.php';

  $url = isset( $_POST['url'] ) ? $_POST['url'] : '';
  $q = isset( $_POST['q'] ) ? $_POST['q'] : '';

  run( $url, $q );

?>