<!-- <link rel="stylesheet" href="/css/photogallery.css"> -->
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">Photo Gallery Upload</h1>
    </div>
</div>

<?php if (!empty($error)): ?>
    <div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2>Your photo could not be uploaded.  Please check the following:<br> <?=$error?></h2>
    </div>
</div>
<?php endif;?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="image">Select the photo to upload</label>
                <span class="sr-only">Information about available activities for this app.</span>
                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about available activities for this app."
                    width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right"
                    data-content="<ul><li>Upload allows you to add new photos to your collection.</li>
                        <li>Delete allows you to remove photos from your collection.</li>
                        <li>View Slideshow allows you to watch your photos appear and disapear from the screen in a graphically pleasing manner.</li></ul>">
                <input id="userfile" name="userfile[]" type="file" value="" multiple=""><!-- add a regex to only allow file extensions of png and jpg -->
                <div class="invalid-feedback">
                    Please select a valid option.
                </div>
                <div class="col-md-4 mb-3">
                    <label for="caption">Caption:</label>
                    <span class="sr-only">Information about caption.</span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about caption." width="12px"
                        height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Provide an <b>optional</b> description of your image. Must be less than 100 characters.">
                    <input id="caption" name="caption" type="text" placeholder="optional" size="100" maxlength="100">
                </div>
            </div>
        </div>
        <input name="submit" type="submit" class="btn btn-primary btn-lg">
        <hr>
    </form>
</div> <!-- /container -->
<script type="text/javascript" src="/js/photogallery.js">
</script>