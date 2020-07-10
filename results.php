<?php
include( 'header.php' );
include( 'search-string.php' );
?>

<main role="main">
  <div class="container">
    <p class="search-term">You searched for: <span class="term"><?php echo $searchString; ?></span> in <?php echo get_totalWebsites(); ?> pages.</p>
    
    <div class="results">
      <?php if( get_found() ) : ?>
      <div class="sucess-results">
        <p class="search-success">Found in <?php the_found(); ?> websites. ✅ </p>
        <ul>
            <?php foreach( get_found() as $address ) : ?>
              <li>
                <a href="<?php echo $address ?>" target="_blank" rel="noopener noreferrer"><?php echo $address ?></a>
              </li>
            <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <?php if( get_notFound() ) : ?>
        <div class="search-not-found">
          <p>Not found in <?php the_notFound() ?> pages 🚫</p>
          <ul>
            <?php foreach( get_notFound() as $address ) : ?>
              <li>
                <a href="<?php echo $address ?>" target="_blank" rel="noopener noreferrer"><?php echo $address ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if( get_invalidAddress() ) : ?>
        <div class="search-invalid-address">
          <p><?php the_invalidAddress() ?> URLs need to be checked again ⚠️ </p>
          <ul>
            <?php foreach( get_invalidAddress() as $address ) : ?>
              <li>
                <a href="<?php echo $address ?>" target="_blank" rel="noopener noreferrer"><?php echo $address ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>
<?php include( 'footer.php' ); ?>