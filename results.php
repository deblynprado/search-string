<?php
include( 'header.php' );
include( 'search-string.php' );
?>

<main role="main">
  <div class="container">
    <p class="search-term">You searched for: <span class="term"><?php echo $searchString; ?></span> in <?php echo get_totalWebsites(); ?> pages.</p>
    
    <div class="sucess-results">
      <p class="search-success">String was found in <?php the_found(); ?> websites. ✅ </p>
    </div>

    <div class="unsucessfull-results">
      <?php if( get_notFound() ) : ?>
        <div class="search-not-found">
          <p>String wasn't found in <?php the_notFound() ?> pages </p>
          <pre>
            <?php foreach( get_notFound() as $address ) : 
              echo "<br>" . $address;
            endforeach;
            ?>
          </pre>
        </div>
      <?php endif; ?>

      <?php if( get_invalidAddress() ) : ?>
        <div class="search-invalid-address">
          <p><?php the_invalidAddress() ?> URLs seems to be incorrect </p>
          <pre>
            <?php foreach( get_invalidAddress() as $address ) : 
              echo "<br>" . $address;
            endforeach;
            ?>
          </pre>
        </div>
      <?php endif; ?>

    </div>
  </div>
</main>
<?php include( 'footer.php' ); ?>