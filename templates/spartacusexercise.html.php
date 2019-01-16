<link rel="stylesheet" href="/css/gladiator.css">
<div class="jumbotron">
    <div class="container">
        <input type="hidden" id="diffLevel" name="difficultyLvl" value="<?= $difficultyLevel ?>">
        <h1 class="display-3">Spartacus Workout</h1>
    </div>
</div>
<div class="container">
    <h2 id="spartacus-header"></h2>

    <h3 id="next-exercise-loc" class="next-exercise"></h3>
    <div class=row>
        <div id='img-placeholder' class="hidden col-8"></div>

        <div id="count-down-area" tabindex="-1" class="count-down-clock text-info  col-4"></div>
    </div>
</div>
<script type="text/javascript" src="/js/spartacus.js"></script>