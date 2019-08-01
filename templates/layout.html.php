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
    <input id="language" type="hidden" value="<?= $language ?>">
        <?php include_once "../public/css/vendor/open-iconic-master/sprite/sprite.min.svg"; ?>
        <?php include_once "../public/css/vendor/icomoon/symbol-defs.svg"; ?>
        <header>
            <!-- Fixed navbar -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="/"><?= $layoutContent['siteName'] ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/"><?= $layoutContent['home'] ?><span class="sr-only"><?= $layoutContent['home'] ?></span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownSpartacus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $layoutContent['fitApps'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownSpartacus">
                                <a class="dropdown-item" href="/spartacus"><?= $layoutContent['spartacusWorkout'] ?></a>
                                <a class="dropdown-item" href="/runspeedcalculator"><?= $layoutContent['runCalc'] ?></a>
                                <a class="dropdown-item" href="/fitnesscalculator"><?= $layoutContent['fitCalc'] ?></a>
                                <a class="dropdown-item" href="/pyramid"><?= $layoutContent['pyramid'] ?></a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownUtilities" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $layoutContent['utils'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownUtilities">
                                <a class="dropdown-item" href="/photos"><?= $layoutContent['photos'] ?></a>
                                <a class="dropdown-item" href="/shoppinglist"><?= $layoutContent['shopping'] ?></a>
                                <a class="dropdown-item" href="/todolist"><?= $layoutContent['toDos'] ?></a>
                                <!--Todo: <a class="dropdown-item" href="/">Calendar</a>-->
                                <!--Todo: <a class="dropdown-item" href="/">Notes App</a> -->
                                <!--Todo: <a class="dropdown-item" href="/">Calculator</a> -->
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownPractice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $layoutContent['trifling'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownPractice">
                                <a class="dropdown-item" href="/horoscope"><?= $layoutContent['horoscope'] ?></a>
                                <a class="dropdown-item" href="/distanceconverter"><?= $layoutContent['distConverter'] ?></a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdownHelp" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $layoutContent['help'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownHelp">
                                <a class="dropdown-item" href="/myaccount"><?= $layoutContent['myAccount'] ?></a>
                                <a class="dropdown-item" href="/about"><?= $layoutContent['about'] ?></a>
                                <!--Todo: <a class="dropdown-item" href="/">Get Help</a> -->
                            </div>
                        </li>

                        <?php if ($loggedIn) : ?>
                        <li>
                            <a class="nav-link" href="/logout"><?= $layoutContent['logOut'] ?></a>
                        </li>
                        <?php else : ?>
                        <li>
                            <a class="nav-link" href="/login"><?= $layoutContent['logIn'] ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label id="lblEnglish" class="btn btn-secondary active">
                        <input id="rbEnglish" type="radio" name="english" id="btnEnglish" class="rb-language" autocomplete="off" checked> <?= $layoutContent['english'] ?>
                    </label>
                    <label id="lblSpanish" class="btn btn-secondary">
                        <input id="rbSpanish" type="radio" name="spanish" id="btnSpanish" class="rb-language" autocomplete="off"> <?= $layoutContent['espanol'] ?>
                    </label>
                </div>
            </nav>
        </header>

        <div id="browserSupportModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <h3><?= $layoutContent['badBrowser'] ?></h3>
                    <ul>
                        <li>Chrome 58 <?= $layoutContent['orNewer'] ?></li>
                        <li>Firefox 54 <?= $layoutContent['orNewer'] ?></li>
                        <li>Edge 14 <?= $layoutContent['orNewer'] ?></li>
                        <li>Safari 10 <?= $layoutContent['orNewer'] ?></li>
                        <li>Opera 55 <?= $layoutContent['orNewer'] ?></li>
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
                <span class="text-muted"><?= $layoutContent['copyright'] ?> &copy;</span><span id="currentYear" class="text-muted"></span>
            </div>
        </footer>

        <script type="text/javascript" src="/js/layout.js"></script>

    </body>

</html>