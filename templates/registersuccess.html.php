<link rel="stylesheet" href="/css/registersuccess.css">
<input id="language" type="hidden" value="<?= $language?>">
<!-- Todo: add error banner for scenarios where the confirmation fails -->
<div class="jumbotron">
    <div class="container">
        <h1><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div class="container fill-height">
    <div class="alert alert-primary" role="alert">
        <h2><?= $content['instructionsTxt'] ?></h2>
    </div>
</div>