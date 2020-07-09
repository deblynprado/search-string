<?php include( 'header.php' ); ?>
        <main class="main" role="main">
          <div class="container">
            <form action="search-string.php" method="POST">
              <div class="step-1">
                <label for="input-string">Search for...</label>
                <input type="text" name="input-string" id="input-string" class="input-string" placeholder="String that you want to find" required/>
              </div>
              
              <div class="step-2">
                <label for="websites-textarea">List of websites</label>
                <textarea name="websites-textarea" id="websites-textarea" cols="50" rows="20" placeholder="URL of the page that you want to search, one per line" required></textarea>
              </div>
              
              <div class="submit-area">
                <input type="submit" value="Search">
              </div>
            </form>
          </div>
        </main>
<?php include( 'footer.php' ); ?>