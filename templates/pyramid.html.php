<link rel="stylesheet" href="/css/pyramid.css">
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Pyramid Workout</h1>
    </div>
</div>
<div class="container fill-height">
    <form action="" method="post">
        <label for="max">Enter your 1RM:</label>
        <span class="sr-only">Information about 1RM - 1 rep max</span>
        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about 1RM - 1 rep max" width="12px"
            height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="1RM stands for one repetion maximum.  In other words, it is the maximum amount of weight you can lift one time.">
            <input id="max" name="max" type="number" min="10" max="1200" value="<?= $max ?? "" ?>" required>
        <input id="submit" name="submit" type="submit" class="btn btn-primary">
    </form>
</div>
<script type="text/javascript" src="/js/pyramid.js"></script>