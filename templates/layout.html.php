<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.css">
        <link rel="stylesheet" href="/css/main.css">
        <script type="text/javascript" src="/js/vendor/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/js/vendor/moment-develop/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script type="text/javascript" src="/js/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>
        <script type="text/javascript" src="/js/vendor/modernizr-custom.js"></script>
        <script type="text/javascript" src="/js/Utils.js"></script>
        <title><?= $title ?></title>
    </head>

    <body>
        <?php include_once "../public/css/vendor/open-iconic-master/sprite/sprite.min.svg"; ?>
        <?php include_once "../public/css/vendor/icomoon/symbol-defs.svg"; ?>
        <header>
            <!-- Fixed navbar -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="/">BWW Apps</a>
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
                                <a class="dropdown-item" href="/runspeedcalculator">Run Speed Calculator</a>
                                <a class="dropdown-item" href="/fitnesscalculator">Fitness Calculator (Body Fat, BMI,
                                    ect.)</a>
                                <a class="dropdown-item" href="/pyramid">Pyramid Workout</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownUtilities" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utility Apps</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownUtilities">
                                <a class="dropdown-item" href="/photos">Photo Viewer</a>
                                <a class="dropdown-item" href="/shoppinglist">Shopping List</a>
                                <a class="dropdown-item" href="/todolist">To Do List</a>
                                <!--Todo: <a class="dropdown-item" href="/">Calendar</a>-->
                                <!--Todo: <a class="dropdown-item" href="/">Notes App</a> -->
                                <!--Todo: <a class="dropdown-item" href="/">Calculator</a> -->
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownPractice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trifling Apps</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownPractice">
                                <a class="dropdown-item" href="/horoscope">Horoscope Generator</a>
                                <a class="dropdown-item" href="/distanceconverter">Distance Converter</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownHelp" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownHelp">
                                <a class="dropdown-item" href="/myaccount">My Account</a>
                                <a class="dropdown-item" href="/about">About</a>
                                <!--Todo: <a class="dropdown-item" href="/">Get Help</a> -->
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
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label id="lblEnglish" class="btn btn-secondary active">
                        <input id="rbEnglish" type="radio" name="english" id="btnEnglish" class="rb-language" autocomplete="off" checked> English
                    </label>
                    <label id="lblSpanish" class="btn btn-secondary">
                        <input id="rbSpanish" type="radio" name="spanish" id="btnSpanish" class="rb-language" autocomplete="off"> Español
                    </label>
                </div>
            </nav>
        </header>

        <div id="browserSupportModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <h3>Your browser does not support modern JavaScript. Therefore, it cannot process the code for this website. Please use one of the following modern browsers to access this site:</h3>
                    <ul>
                        <li>Chrome 58 (or newer)</li>
                        <li>Firefox 54 (or newer)</li>
                        <li>Edge 14 (or newer)</li>
                        <li>Safari 10 (or newer)</li>
                        <li>Opera 55 (or newer)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Begin page content -->
        <main role="main">
            <?= $output ?>
        </main>

        <footer class="footer">
            <div class="container">
                <span class="text-muted">Copyright &copy;</span><span id="currentYear" class="text-muted"></span>
            </div>
        </footer>

        <script type="text/javascript" src="/js/layout.js"></script>

    </body>

</html>