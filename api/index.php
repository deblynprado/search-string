<?php
  header( "Access-Control-Allow-Origin: *" );
  header( "Content-Type: application/json; charset=UTF-8" );

  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code( 405 );
    echo json_encode( array(
      "status" => 405,
      "message" => "Request method not allowed.",
    ) );
    return;
  }

  if ( isset( $_POST['url'] ) ) {
    if ( !is_array( $_POST['url'] ) ) {
      http_response_code( 406 );
      echo json_encode( array(
        "status" => 406,
        "message" => "Expects parameter url to be array",
      ) );
      return;
    }
  }

  include_once 'search.php';

  $url = isset( $_POST['url'] ) ? $_POST['url'] : '';
  $q = isset( $_POST['q'] ) ? $_POST['q'] : '';

  run( $url, $q );

?>