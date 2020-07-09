<?php
$searchString = isset( $_POST['input-string'] ) ? $_POST['input-string'] : "";
$websiteList = isset( $_POST['websites-textarea'] ) ? $_POST['websites-textarea'] : "";
$pages = explode( "\n", str_replace( "\r", "", $websiteList ) );

$totalWebsites = count( $pages );
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
  echo $invalidAddress;
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
  echo $notFound;
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
  echo $found;
}

function clean_address( $url ) {
  $url = strtolower( $url );
  $http = strpos( $url, "http://" );
  $https = strpos( $url, "https://" );
  
  if( $http === false && $https === false ) :
    $newUrl = "http://" . $url;
    return $newUrl;
  endif;
  
  return $url;
}

function search_in_page( $url, $sourceString, $searchString ) {
  if ( strpos( $sourceString, $searchString ) == false ) :
    set_notFound( $url );
    else :
      set_found( $url );
    endif;
  }

  function sslProtocol( $url ) {
    $url = str_replace( "http://", "https://", $url );
    return $url;
  }

  function get_status( $url ) {
    $source = curl_init( $url );
    curl_setopt( $source, CURLOPT_URL, $url );
    curl_setopt( $source, CURLOPT_HEADER, true );
    curl_setopt( $source, CURLOPT_NOBODY, true );
    curl_setopt( $source, CURLOPT_RETURNTRANSFER, true );
    curl_exec( $source );
    $pageStats = curl_getinfo( $source, CURLINFO_HTTP_CODE );
    curl_close ( $source );
    
    return $pageStats;
  }
  
  function returnSource( $url ) {
    $source = curl_init( $url );
    curl_setopt( $source, CURLOPT_RETURNTRANSFER, true );
    curl_exec( $source );
    $sourceString = curl_exec( $source );
    curl_close ( $source );
    
    return $sourceString;
  }
  
  foreach ( $pages as $url ) :
    $pageStats = get_status( clean_address( $url ) );
    
    if( 200 === $pageStats ) :
      $sourceString = returnSource( $url );
      search_in_page( $url, $sourceString, $searchString  );
    elseif( 301 === $pageStats || 302 === $pageStats) :
      $url = sslProtocol( $url );
      $sourceString = returnSource( $url );
      search_in_page( $url, $sourceString, $searchString  );
    else : 
      set_invalidAddress( $url );
    endif;
  endforeach;

echo "FOUND " . count( get_found() ) . "<br>";
var_dump( get_found() );

echo "NOT FOUND " . count( get_notFound() ) . "<br>";
var_dump( get_notFound() );

echo "INVALID " . count( get_invalidAddress() )  . "<br>";
var_dump( get_invalidAddress() );