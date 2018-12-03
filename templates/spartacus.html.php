<link rel="stylesheet" href="/css/gladiator.css">
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3">Spartacus Workout</h1>
    <div id="gladiator-start-wallpaper" class="gladiator"></div>
  </div>
</div>
<div class="container fill-height">
        <form action="" method="post">
        <div id="spartacusSettings" class="row">
              <div class="col-md-4 mb-3">
                <label for="difficultyLvl">Difficulty Level</label>
                <span class="sr-only">Information about difficulty level options</span>
                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about difficulty level options" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="<ul><li>The <b>Noxii</b> were the least respected gladiators and considered to be fresh meat. They were sentenced to the arena as a death sentence and not expected to survive their first round.  Select <b>Noxii</b> if you are not in above average cardiovascular shape or this is your first time in the arena.</li>
                    <li>The <b>Postulati</b> were veterans of the arena and considered professional gladiators. They drew large crowds to the arena due to their victorious reputations.  Choose <b>Postulati</b> if you are in excellent cardiovascular shape or have survived a series of rounds in the arena as a <b>Noxii</b>, and believe you are ready for greater glory.</li>
                    <li>The <b>Rudiarius</b> were the few elite gladiators whom through many glorious victories in the arena managed to win their freedom.  Choose <b>Rudiarius</b> if you possess an elite level of cardiovascular fitness or you have survived a few rounds in the arena as a <b>Postulati</b>, and believe you are ready for the ultimate glory.</li></ul>">
                

                <select class="custom-select d-block w-100" id="difficultyLvl" name="settings[difficultyLvl]" data-difficultyLvl="<?=$settings['difficultyLvl'] ?? '0'?>" required >
                  <option value="">Choose...</option>
                  <option value="1">Noxii (30 Second Intervals)</option>
                  <option value="2">Postulati (45 Second Intervals)</option>
                  <option value="3">Rudiarius (60 Second Intervals)</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid difficulty level.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="lightWeight">Light Dumbells</label>

                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about choosing a light weight pair of dumbells" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="You will be doing resistance training for your shoulders, triceps, biceps, and upper back.  Choose a relatively light pair of dumbells that will challenge you for 15 to 20 repetitions per set.">
                    
                <span class="sr-only">Information about choosing light dumbells weapons</span>

                <select class="custom-select d-block w-100" id="lightWeight" name="settings[lightWeight]" data-lightweight="<?=$settings['lightWeight'] ?? '0'?>" required>
                  <option value="">Choose...</option>
                  <option value="1">2 Ibs</option>
                  <option value="2">5 Ibs</option>
                  <option value="3">10 Ibs</option>
                  <option value="4">15 Ibs</option>
                  <option value="5">20 Ibs</option>
                  <option value="6">25 Ibs</option>
                  <option value="7">30 Ibs</option>
                  <option value="8">35 Ibs</option>
                  <option value="9">40 Ibs</option>
                  <option value="10">45 Ibs</option>
                  <option value="11">50 Ibs</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a weight selection.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="heavyWeight">Heavy Dumbell</label>

                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about choosing a heavy dumbell" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="You will be doing squats and lunges to work your glutes, thighs, and lower back.  Choose a relatively heavy dumbell that will challenge you for 15 to 20 repetitions per set.">
                <span class="sr-only">Information about choosing a heavy dumbell</span>

                <select class="custom-select d-block w-100" id="heavyWeight" name="settings[heavyWeight]" data-heavyweight="<?=$settings['heavyWeight'] ?? '0'?>" required>
                  <option value="">Choose...</option>
                  <option value="1">30 Ibs</option>
                  <option value="2">35 Ibs</option>
                  <option value="3">40 Ibs</option>
                  <option value="4">45 Ibs</option>
                  <option value="5">50 Ibs</option>
                  <option value="6">55 Ibs</option>
                  <option value="7">60 Ibs</option>
                  <option value="8">65 Ibs</option>
                  <option value="9">70 Ibs</option>
                  <option value="10">75 Ibs</option>
                  <option value="11">80 Ibs</option>
                  <option value="12">85 Ibs</option>
                  <option value="13">90 Ibs</option>
                  <option value="14">95 Ibs</option>
                  <option value="15">100 Ibs</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a weight selection.
                </div>
              </div>
            </div>
            
        <input type="submit" name="submit" value="Start" class="btn btn-primary btn-lg">
        <!-- End Intro -->
        </form>
</div>
<script type="text/javascript" src="/js/horoscope.js"></script>
