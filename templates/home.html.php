<link rel="stylesheet" href="/css/home.css">
<input id="language" type="hidden" value="<?= $language?>">
<div class="container">
    <img class="mb-2 logo" src="/css/images/brand-logo-template.svg" alt="BWW Apps">
</div>

<div class="container fill-height">
    <div class="row">
        <?php if (!$loggedIn) : ?>
            <div class="alert alert-secondary" role="alert"><?= $content['registerTxt'] ?><a href="/login"><?= $content['clickLogin'] ?></a><?= $content['ifNotRegistered'] ?><a href="/user/register"><?= $content['clickAndRegister'] ?></a>
            </div>
        <?php endif; ?>
        <div class="col-md-4">
            <h2><?= $content['fitnessApps'] ?></h2>
            <p><?= $content['fitAppsDesc'] ?></p>
        </div>
        <div class="col-md-4">
            <h2><?= $content['utilityApps'] ?></h2>
            <p><?= $content['utilityAppsDesc'] ?></p>
        </div>
        <div class="col-md-4">
            <h2><?= $content['triflingApps'] ?></h2>
            <p><?= $content['triflingAppsDesc'] ?></p>
        </div>
    </div>
    <hr>
</div>