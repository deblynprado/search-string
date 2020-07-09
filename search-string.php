<?php
$searchString = isset( $_POST['input-string'] ) ? $_POST['input-string'] : "";
$websiteList = isset( $_POST['websites-textarea'] ) ? $_POST['websites-textarea'] : "";
$pages = explode( "\n", str_replace( "\r", "", $websiteList ) );
$totalWebsites = count( $pages );
$invalidAddress = array();

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

function check_stats() {

}

function search_in_page() {
  
}

foreach ( $pages as $url ) :
  clean_address( $url );
  $source = curl_init( $url );
  curl_setopt( $source, CURLOPT_RETURNTRANSFER, true );  
  $sourceString = curl_exec( $source );
  $pageStats = curl_getinfo( $source,  CURLINFO_HTTP_CODE );
  
  if( 200 === $pageStats ) :
    if ( strpos( $sourceString, $searchString ) == false ) { 
      #echo $searchString . ' not exists in the URL ' . $url . '<br>'; 
    }
    
    else { 
      #echo $searchString . ' exists in the URL <br>'; 
    }
    else :
      array_push( $invalidAddress, $url );
  endif;
endforeach;