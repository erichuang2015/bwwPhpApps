<link rel="stylesheet" href="/css/home.css">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
        <div class="container">
          <h1 class="display-3">BWW Apps</h1>
          <em>Helping you get things done</em>
        </div>
</div>

<div class="container fill-height">
        <!-- Example row of columns -->
        <div class="row">
        <?php if (!$loggedIn) : ?>
          <div class="alert alert-secondary" role="alert">
            If you have registered with this site please login for the optimal experience <a href="/login">click here to log in</a>.  If you haven't registered please do so <a href="/user/register">Click here to register an account</a>
          </div>
            <?php endif; ?>
          <div class="col-md-4">
            <h2>Fitness Apps</h2>
            <p>If you enjoy physical fitness activities as much as I do then you may find any or all of my fitness apps useful. The Spartacus Workout is a great workout for buring fat and getting cut.  The Run Speed Calculator can help you determine the pace you need to maintain to meet your long distance running goals.  The Fitness Calculator can help you calculate your body fat percentage and BMI.  Whereas, the pyrmamid workout is a great strength trainging alternative to the popular 5x5 routine.</p>
          </div>
          <div class="col-md-4">
            <h2>Utility Apps</h2>
            <p>These apps are meant to help you get things done, and enjoy a better quality of life. The photo viewer is a simple photo gallery which allows you to upload and view your photos.  The To Do List, Shopping List, Calendar, and Calculator apps all do exactly what you would infer by their respective names.  The notes app is a tool where you can store your notes in the cloud and have them available with you wherever you go as long as you have a browser and an internet connection.</p>
          </div>
          <div class="col-md-4">
            <h2>Practice Apps</h2>
            <p>These apps of little real world value, and I only wrote them to pracice my coding skills. However, the Horoscope Generator my provide some entertainment value if you are looking for a laugh.</p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->