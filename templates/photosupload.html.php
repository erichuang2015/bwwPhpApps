<link rel="stylesheet" href="/css/photogallery.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="errorFileType" type="hidden" value="<?= $content['errorFileType'] ?>">
<input id="errorSelectImg" type="hidden" value="<?= $content['errorSelectImg'] ?>">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>

<?php if (!empty($error)): ?>
<div class="container fill-height">
    <div class="alert alert-danger" role="alert">
        <h2><?= $content['serverErrorMsg'] ?><br> <?=$error?></h2>
    </div>
</div>
<?php endif;?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="image"><?= $content['lblSelectPhoto'] ?></label>
                <span class="sr-only"><?= $content['activitiesAvailSrTxt'] ?></span>
                <img src="/css/vendor/open-iconic-master/svg/info.svg"
                    alt="<?= $content['activitiesAvailSrTxt'] ?>" width="12px" height="12px"
                    data-container="body" data-toggle="popover" data-placement="right"
                    data-content="<?= $content['fileTypeContentList'] ?>">
                <input id="userfile" name="userfile[]" class="btn btn-secondary form-control" type="file" value="" multiple="" required autofocus>
                <div class="invalid-feedback"><span id="userFileError"></span></div>
                <div id="captionDiv" class="col-12 form-group">
                    <label for="caption"><?= $content['caption'] ?></label>
                    <span class="sr-only"><?= $content['aboutCaptionSrTxt'] ?></span>
                    <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="<?= $content['aboutCaptionSrTxt'] ?>" width="12px"
                        height="12px" data-container="body" data-toggle="popover" data-placement="right"
                        data-content="<?= $content['optionalDescriptionContent'] ?>">
                    <input id="caption" name="caption" type="text" css="form-control text" placeholder="<?= $content['placeholderOptional'] ?>"
                           maxlength="55" autocomplete="off">
                </div>
            </div>
        </div>
        <input id="submitBtn" name="submit" type="submit" class="btn btn-primary" value="Submit" disabled>
        <button id="cancelBtn" class="btn btn-secondary" style="display: none"><?= $content['btnCancel'] ?></button>
        <em class="photo-limit"><?= $content['sorryForLimitedStorage'] ?></em>
    </form>
</div> <!-- /container -->
<script type="text/javascript" src="/js/photogallery.js">
</script>