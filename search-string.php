<?php
$searchString = isset( $_POST['input-string'] ) ? $_POST['input-string'] : "";
$websiteList = isset( $_POST['websites-textarea'] ) ? $_POST['websites-textarea'] : "";
$pages = explode( "\n", str_replace( "\r", "", $websiteList ) );
$totalWebsites = count( $pages );
$invalidAddress = array();
$notFound = array();
$found = array();

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
    global $notFound;
    array_push( $notFound, $url );
  else :
    global $found;
    array_push( $found, $url );
  endif;
}

foreach ( $pages as $url ) :
  clean_address( $url );
  $source = curl_init( $url );
  curl_setopt( $source, CURLOPT_RETURNTRANSFER, true );  
  $sourceString = curl_exec( $source );
  $pageStats = curl_getinfo( $source,  CURLINFO_HTTP_CODE );
  
  if( 200 === $pageStats ) :
    search_in_page( $url, $sourceString, $searchString  );    
    else :
      array_push( $invalidAddress, $url );
  endif;
endforeach;

echo "String " . $searchString . " searched in " . count( $pages ) . " websites <br>";
echo "• Found in " . count( $found ) . "<br>";
echo "• Not foudn in " . count( $notFound ) . "<br>";
foreach( $notFound as $uri ) :
  echo $uri . "<br>";
endforeach;
echo "• " . count( $invalidAddress ) . " Invalid Addresses found <br>";
foreach( $invalidAddress as $uri ) :
  echo $uri . "<br>";
endforeach;