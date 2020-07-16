<?php
require( 'vendor/zebra_curl.php' );
$searchString = isset( $_POST['input-string'] ) ? $_POST['input-string'] : "";
$websiteList = isset( $_POST['websites-textarea'] ) ? $_POST['websites-textarea'] : "";
$allPages = explode( "\n", str_replace( "\r", "", $websiteList ) );

$totalWebsites = count( $allPages );
function get_totalWebsites() {
  global $totalWebsites;
  return $totalWebsites;
}

$invalidAddress = array();
function get_invalidAddress() {
  global $invalidAddress;
  return $invalidAddress;
}

function set_invalidAddress( $url ) {
  global $invalidAddress;
  array_push( $invalidAddress, $url );
}

function the_invalidAddress() {
  global $invalidAddress;
  echo count( $invalidAddress );
}

$validAddress = array();
function get_validAddress() {
  global $validAddress;
  return $validAddress;
}

function set_validAddress( $url ) {
  global $validAddress;
  array_push( $validAddress, $url );
}

function the_validAddress() {
  global $validAddress;
  echo count( $validAddress );
}

$notFound = array();
function get_notFound() {
  global $notFound;
  return $notFound;
}

function set_notFound( $url ) {
  global $notFound;
  array_push( $notFound, $url );
}

function the_notFound() {
  global $notFound;
  echo count( $notFound );
}

$found = array();
function get_found() {
  global $found;
  return $found;
}

function set_found( $url ) {
  global $found;
  array_push( $found, $url );
}

function the_found() {
  global $found;
  echo count( $found );
}

function search_in_page( $url, $sourceString, $searchString ) {
  $sourceString = mb_strtolower( $sourceString );
  $searchString = mb_strtolower( $searchString );

  if ( stripos( $sourceString, $searchString ) == false ) :
    set_notFound( $url );
    else :
      set_found( $url );
    endif;
  }

function search_string( $result ) {
  if ( $result->response[1] == CURLE_OK ) :
    if ( $result->info['http_code'] == 200 ) :
      $pageContent = $result->body;
      global $searchString;
      search_in_page( $result->info['url'], $pageContent, $searchString );
      else :
        set_invalidAddress( $result->info['url'] );
    endif;
  else :
      set_invalidAddress( $result->info['url'] );
  endif;
  }

  $curl = new Zebra_cURL();
  $curl->threads = 20;
  $curl->get( $allPages, 'search_string' );