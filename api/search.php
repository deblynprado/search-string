<?php

require( '../vendor/zebra_curl.php' );

$searchString = "";
$json = array();
$json['result'] = array();

function run( $result, $string ) {
  global $searchString; 
  global $json; 
  $searchString = $string;

  $curl = new Zebra_cURL();
  $curl->threads = 20;
  $curl->get( $result, 'search_string' );

  http_response_code( 200 );
  echo json_encode( $json );
}

function search_string( $result ) {
  global $searchString; 
  global $json; 

  if ( $result->response[1] == CURLE_OK ) :
    if ( $result->info['http_code'] == 200 ) :
      $pageContent = $result->body;
      array_push( $json['result'], set_item_result( 
        $result->info['url'], 
        $searchString,
        search_in_page( $result->info['url'], $pageContent, $searchString ) ? "found" : "not_found" ) );
      else :
        array_push( $json['result'], set_item_result( $result->info['url'],  $searchString, "not_found" ) );
    endif;
  else :
    array_push( $json['result'], set_item_result( $result->info['url'],  $searchString, "not_found" ) );
  endif;
}

function search_in_page( $url, $sourceString, $searchString ) {
  $sourceString = mb_strtolower( $sourceString );
  $searchString = mb_strtolower( $searchString );

  if ( stripos( $sourceString, $searchString ) == false ) :
    return false;
  else :
    return true;
  endif;
}

function set_item_result( $url, $stringSearch, $status ) {
  return array(
    "url" => $url,
    "string_search" => $stringSearch,
    "status" => $status
  );
}


?>