<link rel="stylesheet" href="/css/photogallery.css">
<input id="language" type="hidden" value="<?= $language?>">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
        <!-- if not logged in display the below: -->
        <!-- <p>
      This app allows you to upload your photos and view them in a slide show.
    </p> -->
        <?php if (!$loggedIn) : ?>
            <span class="alert alert-warning" role="alert"><?= $content['mustBeLoggedIn'] ?></span>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <?php if ($loggedIn) : ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="optionChoice"><?= $content['labelOptions'] ?></label>
                    <span class="sr-only"><?= $content['optionsScreenReaderTxt'] ?></span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['optionsScreenReaderTxt'] ?>" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<?= $content['optionsList'] ?>">
                    <select class="custom-select d-block w-100" id="optionChoice" name="choice" required>
                        <option value=""><?= $content['choose'] ?></option>
                        <option value="1"><?= $content['optionUpload'] ?></option>
                        <option value="2"><?= $content['optionViewSlideShow'] ?></option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $content['selectErrorTxt'] ?>
                    </div><!-- /invalid-feedback -->
                    <input id="submit" name="submit" type="submit" class="btn btn-primary btn-lg" value="<?= $content['submitBtnTxt'] ?>" disabled>
                </div><!-- /col-md-4 mb-3 -->
            </div><!-- /row -->
        </form>
    </div> <!-- /container -->

    <hr>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($photos as $photo) : ?>
                    <form action="" method="post" class="img-card">
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" src="uploads/<?= $photo['name'] ?>" alt="<?= $photo['caption'] ?>" width="350" height="500">
                                <div class="card-body">
                                    <p class="card-text">
                                        <?= htmlspecialchars($photo['caption'], ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                    <input type="hidden" name="id" value="<?= $photo['id'] ?>">
                                    <input type="hidden" name="userid" value="<?= $photo['userid'] ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <input name="rotate" type="submit" class="btn btn-sm btn-outline-secondary" value="<?= $content['rotate'] ?>">
                                            <input name="delete" type="submit" class="btn btn-sm btn-outline-secondary" value="<?= $content['delete'] ?>">
                                        </div><!-- /btn-group -->
                                    </div><!-- /d-flex justify-content-between align-items-center -->
                                </div><!-- /card-body -->
                            </div><!-- /card mb-4 shadow-sm -->
                        </div><!-- /col-md-4 -->
                    </form>
                <?php endforeach; ?>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /album py-5 bg-light -->

<?php endif; ?>

<script type="text/javascript" src="/js/photogallery.js"></script>