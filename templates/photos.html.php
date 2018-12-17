<link rel="stylesheet" href="/css/photogallery.css">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">Photo Gallery</h1>
        <!-- if not logged in display the below: -->
        <!-- <p>
      This app allows you to upload your photos and view them in a slide show.
    </p> -->
        <?php if (!$loggedIn): ?>
        <span class="alert alert-warning" role="alert">You must be logged in to be able to use this app.</span>
        <?php endif;?>


    </div>
</div>

<div class="container">
    <?php if ($loggedIn): ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="optionChoice">What would you like to do?</label>
                <span class="sr-only">Information about available activities for this app.</span>
                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about available activities for this app."
                    width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right"
                    data-content="<ul><li>Upload allows you to add new photos to your collection.</li>
                        <li>Delete allows you to remove photos from your collection.</li>
                        <li>View Slideshow allows you to watch your photos appear and disapear from the screen in a graphically pleasing manner.</li></ul>">

                <select class="custom-select d-block w-100" id="optionChoice" name="choice" required>
                    <option value="">Choose...</option>
                    <option value="1">Upload Photos</option>
                    <option value="2">View Slideshow</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid option.
                </div><!-- /invalid-feedback -->
                <input name="submit" type="submit" class="btn btn-primary btn-lg">
            </div><!-- /col-md-4 mb-3 -->
        </div><!-- /row -->
    </form>
</div> <!-- /container -->

<hr>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <?php foreach ($photos as $photo): ?>
            <form action="" method="post" class="img-card">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img class="card-img-top" src="uploads/<?=$photo['name']?>" alt="<?=$photo['caption']?>" width="350" height="500">
                        <div class="card-body">
                            <p class="card-text">
                                <?=htmlspecialchars($photo['caption'], ENT_QUOTES, 'UTF-8')?>
                            </p>
                            <input type="hidden" name="id" value="<?=$photo['id']?>">
                            <input type="hidden" name="userid" value="<?=$photo['userid']?>">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <input name="rotate" type="submit" class="btn btn-sm btn-outline-secondary" value="Rotate">
                                    <input name="delete" type="submit" class="btn btn-sm btn-outline-secondary" value="Delete">
                                </div><!-- /btn-group -->
                            </div><!-- /d-flex justify-content-between align-items-center -->
                        </div><!-- /card-body -->
                    </div><!-- /card mb-4 shadow-sm -->
                </div><!-- /col-md-4 -->
            </form>
            <?php endforeach;?>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /album py-5 bg-light -->

<?php endif;?>

<script type="text/javascript" src="/js/photogallery.js"></script>