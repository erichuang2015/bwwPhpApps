<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="/css/vendor/bootstrap.min.css">
		<link rel="stylesheet" href="/css/main.css">
		<script type="text/javascript" src="/js/vendor/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="/js/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap.bundle.min.js"></script>
		
		<title><?= $title ?></title>
	</head>
	<body>
	<header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">BWW PHPApps</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">Home</span></a>
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="" id="dropdownSpartacus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fitness Apps</a>
							<div class="dropdown-menu" aria-labelledby="dropdownSpartacus">
								<a class="dropdown-item" href="/spartacus">Spartacus Workout</a>
								<a class="dropdown-item" href="/">Run Speed Calculator</a>
								<a class="dropdown-item" href="/">Fitness Calculator (Body Fat, BMI, ect.)</a>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="" id="dropdownUtilities" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utility Apps</a>
							<div class="dropdown-menu" aria-labelledby="dropdownUtilities">
								<a class="dropdown-item" href="/">Photo Viewer</a>
								<a class="dropdown-item" href="/">To Do List</a>
								<a class="dropdown-item" href="/">Shopping List</a>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="" id="dropdownPractice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Practice Apps</a>
							<div class="dropdown-menu" aria-labelledby="dropdownPractice">
								<a class="dropdown-item" href="/">Horoscopes Generator</a>
								<a class="dropdown-item" href="/">Distance Converter</a>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="" id="dropdownJokes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Jokes</a>
							<div class="dropdown-menu" aria-labelledby="dropdownJokes">
								<a class="dropdown-item" href="/joke/list">Jokes List</a>
								<a class="dropdown-item" href="/joke/edit">Add a new Joke</a>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="" id="dropdownHelp" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help</a>
							<div class="dropdown-menu" aria-labelledby="dropdownHelp">
								<a class="dropdown-item" href="/">Settings</a>
								<a class="dropdown-item" href="/">My Account</a>
								<a class="dropdown-item" href="/">About</a>
							</div>
						</li>

			<?php if ($loggedIn) : ?>
			<li>
				<a class="nav-link" href="/logout">Log out</a>
			</li>
			<?php else : ?>
			<li>
			<a class="nav-link" href="/login">Log in</a>
			</li>
			<?php endif; ?>
          </ul>
        </div>
      </nav>
    </header>

	<!-- Begin page content -->
	<main role="main">
	<?= $output ?>
	</main>

	<footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer>
	</body>
</html>