<!-- <link rel="stylesheet" href="/css/photogallery.css"> -->
<div class="jumbotron fill-height">
  <div class="container fill-height">
    <h1 class="display-3">Photo Gallery</h1>
    <!-- if not logged in display the below: -->
    <!-- <p>
      This app allows you to upload your photos and view them in a slide show. 
    </p> -->
    <?php if (!$loggedIn) : ?>
    <span class="alert alert-warning" role="alert">You must be logged in to be able to use this app.</span>
    <?php endif; ?>
    

  </div>
</div>

<div class="container">
<?php if ($loggedIn) : ?>
<form action="" method="post">
  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="optionChoice">What would you like to do?</label>
      <span class="sr-only">Information about available activities for this app.</span>
      <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about available activities for this app."
        width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<ul><li>Upload allows you to add new photos to your collection.</li>
                        <li>Delete allows you to remove photos from your collection.</li>
                        <li>View Slideshow allows you to watch your photos appear and disapear from the screen in a graphically pleasing manner.</li></ul>">

      <select class="custom-select d-block w-100" id="optionChoice" name="choice" required>
        <option value="">Choose...</option>
        <option value="1">Upload Photos</option>
        <option value="2">Delete Photos</option>
        <option value="3">View Slideshow</option>
      </select>
      <div class="invalid-feedback">
        Please select a valid option.
      </div>
    </div>
  </div>
  <input name="submit" type="submit" class="btn btn-primary btn-lg">
  <hr>
</form>
  <?php endif; ?>
</div> <!-- /container -->
<script type="text/javascript" src="/js/photogallery.js"></script>