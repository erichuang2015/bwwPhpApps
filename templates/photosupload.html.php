<link rel="stylesheet" href="/css/photogallery.css">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">Photo Gallery Upload</h1>
    </div>
</div>

<?php if (!empty($error)): ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2>Your photo could not be uploaded. Please check the following:<br> <?=$error?></h2>
    </div>
</div>
<?php endif;?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="image">Select the photo to upload</label>
                <span class="sr-only">Information about available activities for this app.</span>
                <img src="/css/vendor/open-iconic-master/svg/info.svg"
                    alt="Information about available activities for this app." width="12px" height="12px"
                    data-container="body" data-toggle="popover" data-placement="right"
                    data-content="<ul><li>You may upload jpg or png files.  Other file types are not supported.</li>
                        <li>File size cannot exceed 4MB.</li>
                        <li>You may upload a total of 10 images.</li></ul>">
                <input id="userfile" name="userfile[]" class="btn btn-secondary form-control" type="file" value="" multiple="" required autofocus>
                <div class="invalid-feedback"><span id="userFileError"></span></div>
                <div id="captionDiv" class="col-md-4 mb-3">
                    <label for="caption">Caption:</label>
                    <span class="sr-only">Information about caption.</span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about caption." width="12px"
                        height="12px" data-container="body" data-toggle="popover" data-placement="right"
                        data-content="Provide an <b>optional</b> description of your image. Must be 55 characters or less.">
                    <input id="caption" name="caption" type="text" css="form-control text" placeholder="optional"
                        size="55" maxlength="55" autocomplete="off">
                </div>
            </div>
        </div>
        <input id="submitBtn" name="submit" type="submit" class="btn btn-primary" disabled>
        <button id="cancelBtn" class="btn btn-secondary" style="display: none">Cancel</button>
        <em class="photo-limit">I'm sorry for limiting your uploads to only 10 images. I'm providing this service for
            free, but the web storage costs me money. To keep the the cost of storage for this site at a level I can
            afford it is necessary to limit the amount of images that are uploaded.</em>
    </form>
</div> <!-- /container -->
<hr>
<script type="text/javascript" src="/js/photogallery.js">
</script>