<link rel="stylesheet" href="/css/pyramid.css">
<input id="language" type="hidden" value="<?= $language?>">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
    </div>
</div>
<div class="container fill-height">
    <h2>
        <?=$exerciseName?>
    </h2>
    <div class="row font-weight-bold">
        <div class="col-4"><?= $content['set'] ?></div>
        <div class="col-4"><?= $content['weight'] ?></div>
        <div class="col-4"><?= $content['repetitions'] ?></div>
    </div>
    <div class="row">
        <div class="col-4">1</div>
        <div class="col-4">
            <?=$tenReps?>
        </div>
        <div class="col-4">10</div>
    </div>
    <div class="row">
        <div class="col-4">2</div>
        <div class="col-4">
            <?=$eightReps?>
        </div>
        <div class="col-4">8</div>
    </div>
    <div class="row">
        <div class="col-4">3</div>
        <div class="col-4">
            <?=$sixReps?>
        </div>
        <div class="col-4">6</div>
    </div>
    <div class="row">
        <div class="col-4">4</div>
        <div class="col-4">
            <?=$fourReps?>
        </div>
        <div class="col-4">4</div>
    </div>
    <div class="row">
        <div class="col-4">5</div>
        <div class="col-4">
            <?=$threeReps?>
        </div>
        <div class="col-4">3</div>
    </div>
    <div class="row">
        <div class="col-4">6</div>
        <div class="col-4">
            <?=$twoReps?>
        </div>
        <div class="col-4">2</div>
    </div>
    <div class="row">
        <div class="col-4">7</div>
        <div class="col-4">
            <?=$sixReps?>
        </div>
        <div class="col-4">6</div>
    </div>
</div>
<script type="text/javascript" src="/js/pyramid.js"></script>