<?php define( 'ROOT', 'http://tests/') ?>

<?php include( 'header.php' ); ?>
        <main class="main" role="main">
        <div id="loading-modal" class="modal-window">
          <div>
            <h1>We're performing your search!</h1>
            <p>Please, be patient. This can take a while</p>
            <p class="detective">🕵️‍♂️</p>
          </div>
        </div>

          <div class="container">
            <form action="results.php" method="POST" id="strings-search">
              <div class="step-1">
                <label for="input-string">Search for...</label>
                <input type="text" name="input-string" id="input-string" class="input-string" placeholder="String that you want to find" required/>
              </div>
              
              <div class="step-2">
                <label for="websites-textarea">List of websites</label>
                <textarea name="websites-textarea" id="websites-textarea" cols="50" rows="20" placeholder="URL of the page that you want to search, one per line" required></textarea>
              </div>
              
              <div class="submit-area">
                <a class="btn-submit" href="#loading-modal" onclick="document.getElementById('strings-search').submit();">Search</a>
              </div>
            </form>
          </div>
        </main>
<?php include( 'footer.php' ); ?>