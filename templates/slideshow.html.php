<link rel="stylesheet" href="/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="/css/photogallery.css">
<?php if ($loggedIn): ?>

<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php $length = count($photos);?>
    <?php for ($i = 0; $i < $length; $i++): ?>
        <?php if ($i == 0): ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="active"></li>
        <?php else: ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>"></li>
        <?php endif;?>
    <?php endfor;?>
  </ol>


  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  <?php $index = 0;?>
    <?php foreach ($photos as $photo): ?>

    <?php if ($index == 0): ?>
        <div class="carousel-item active">
            <img class="d-block w-100" src="/uploads/<?=$photo['name']?>" alt="<?=htmlspecialchars($photo['caption'], ENT_QUOTES, 'UTF-8')?>" style="max-width:414;">
        <div class="carousel-caption">
            <h3><?=htmlspecialchars($photo['caption'], ENT_QUOTES, 'UTF-8')?></h3>
        </div>
        </div>
    <?php else: ?>
        <div class="carousel-item">
            <img src="/uploads/<?=$photo['name']?>" alt="<?=htmlspecialchars($photo['caption'], ENT_QUOTES, 'UTF-8')?>">
        <div class="carousel-caption">
            <h3><?=htmlspecialchars($photo['caption'], ENT_QUOTES, 'UTF-8')?></h3>
        </div>
        </div>
    <?php endif;?>

    <?php $index++;?>
    <?php endforeach;?>
  </div>

  <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
</div>
</div>


<?php endif;?>
<script type="text/javascript" src="/js/vendor/util.js"></script>
<script type="text/javascript" src="/js/vendor/carousel.js"></script>