<link rel="stylesheet" href="/css/gladiator.css">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">Spartacus Workout</h1>
        <div id="gladiator-start-wallpaper" class="gladiator"></div>
        <!-- Intro -->
        <h2 id="spartacus-header">Click below to start your training</h2>

        <div id="spartacusSettings" class="row">
              <div class="col-md-4 mb-3">
                <label for="difficultyLvl">Difficulty Level</label>
                <span class="sr-only">Information about difficulty level options</span>
                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about difficulty level options" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<ul><li>The <b>Noxii</b> were the least respected gladiators and considered to be fresh meat. They were sentenced to the arena as a death sentence and not expected to survive their first round.  Select <b>Noxii</b> if you are not in above average cardiovascular shape or this is your first time in the arena.</li>
                    <li>The <b>Postulati</b> were veterans of the arena and considered professional gladiators. They drew large crowds to the arena due to their victorious reputations.  Choose <b>Postulati</b> if you are in excellent cardiovascular shape or have survived a series of rounds in the arena as a <b>Noxii</b>, and believe you are ready for greater glory.</li>
                    <li>The <b>Rudiarius</b> were the few elite gladiators whom through many glorious victories in the arena managed to win their freedom.  Choose <b>Rudiarius</b> if you possess an elite level of cardiovascular fitness or you have survived a few rounds in the arena as a <b>Postulati</b>, and believe you are ready for the ultimate glory.</li></ul>">
                

                <select class="custom-select d-block w-100" id="difficultyLvl" required>
                  <option value="">Choose...</option>
                  <option value="0">Noxii (30 Second Intervals)</option>
                  <option value="1">Postulati (45 Second Intervals)</option>
                  <option value="2">Rudiarius (60 Second Intervals)</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid difficulty level.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lightWeight">Light Dumbells</label>

                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about choosing a light weight pair of dumbells" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="You will be doing resistance training for your shoulders, triceps, biceps, and upper back.  Choose a relatively light pair of dumbells that will challenge you for 15 to 20 repetitions per set.">
                    
                <span class="sr-only">Information about choosing light dumbells weapons</span>

                <select class="custom-select d-block w-100" id="lightWeight" required>
                  <option value="">Choose...</option>
                  <option value="2">2 Ibs</option>
                  <option value="5">5 Ibs</option>
                  <option value="10">10 Ibs</option>
                  <option value="15">15 Ibs</option>
                  <option value="20">20 Ibs</option>
                  <option value="25">25 Ibs</option>
                  <option value="30">30 Ibs</option>
                  <option value="35">35 Ibs</option>
                  <option value="40">40 Ibs</option>
                  <option value="45">45 Ibs</option>
                  <option value="50">50 Ibs</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a weight selection.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="heavyWeight">Heavy Dumbell</label>

                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about choosing a heavy dumbell" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="You will be doing squats and lunges to work your glutes, thighs, and lower back.  Choose a relatively heavy dumbell that will challenge you for 15 to 20 repetitions per set.">
                <span class="sr-only">Information about choosing a heavy dumbell</span>

                <select class="custom-select d-block w-100" id="heavyWeight" required>
                  <option value="">Choose...</option>
                  <option value="30">30 Ibs</option>
                  <option value="35">35 Ibs</option>
                  <option value="40">40 Ibs</option>
                  <option value="45">45 Ibs</option>
                  <option value="50">50 Ibs</option>
                  <option value="55">55 Ibs</option>
                  <option value="60">60 Ibs</option>
                  <option value="65">65 Ibs</option>
                  <option value="70">70 Ibs</option>
                  <option value="75">75 Ibs</option>
                  <option value="80">80 Ibs</option>
                  <option value="85">85 Ibs</option>
                  <option value="90">90 Ibs</option>
                  <option value="95">95 Ibs</option>
                  <option value="100">100 Ibs</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a weight selection.
                </div>
              </div>
            </div>
            <?php if ($loggedIn) : ?>
              <hr class="mb-4">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
              </div>
              <hr class="mb-4">
            <?php endif; ?>

        <h3 id="next-exercise-loc" class="next-exercise"></h3>
        <div class=row>
            <div id='img-placeholder' class="hidden col-8"></div>
            
            <div id="count-down-area" class="count-down-clock text-info  col-4"></div>
        </div>
        
        <button id='btn-start' class="btn btn-primary btn-lg" onclick="startBtnEventHandler();">Start</button>
        <!-- End Intro -->
        
    </div>
</div>
<script type="text/javascript" src="/js/spartacus.js"></script>
