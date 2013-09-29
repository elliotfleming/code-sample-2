<!DOCTYPE html>
<!--[if IE 9]><html class="ie9 ie"><![endif]-->
<!--[if lte IE 8]><html class="ie8 ie"><![endif]-->
<![if !IE]><html lang="en-US"><![endif]>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700|Oswald:400,700">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCR_K9rWCY2Deu6LS_oLMlHCi5zXsarBQQ&sensor=false"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>

    <div id="container">

        <header>

            <nav>
                <div class="navbar navbar-static-top">
                    <div class="navbar-inner">

                        <div class="inner-wrapper">

                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            
                            <div href="/"><a class="brand" href="/"></a></div>

                            <div class="nav-collapse collapse">
                                <ul class="nav pull-right">
                                    <li <?php if (uri_string() == '') echo 'class="active"' ?>><a href="/" class="btn"><i class="icon-fire <?php if (uri_string() == '') echo ' icon-white' ?>"></i> Boils</a></li>
                                    <li <?php if (uri_string() == 'boils/addBoil') echo 'class="active"' ?>><a href="/boils/addBoil" class="btn"><i class="icon-plus-sign <?php if (uri_string() == 'boils/addBoil') echo ' icon-white' ?>"></i> Add Boil</a></li>
                                    <li <?php if (uri_string() == 'prices') echo 'class="active"' ?>><a href="/prices" class="btn"><i class="icon-tag <?php if (uri_string() == 'prices') echo ' icon-white' ?>"></i> Prices</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </nav>

            <?php if (strpos(uri_string(), 'auth') !== 0): ?>

                <div class="auth">
                    <div class="inner">
                        <?php if (!$logged_in): ?>
                            <div class="toggle-form">
                                <?= form_open('/auth/login_via_ajax', 'class="form-inline"'); ?>
                                    <input type="text" class="input" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" maxlength="80" required="required">
                                    <input type="password" class="input-small" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>" maxlength="100" required="required">
                                    <label for="remember_me" class="checkbox">
                                        <input type="checkbox" id="remember_me" name="remember_me" value="1" <?= set_checkbox('remember_me', 1) ?>> Remember Me
                                    </label>
                                    <input type="submit" name="login_user" class="btn btn-primary" value="Sign In">
                                    <a href="/auth/register" class="btn">Register</a>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="toggle-form">
                                <span>Logged in as <b><?= $email ?></b></span>
                                <a href="/auth" class="btn btn-info">Account</a>
                                <?php if (strpos(uri_string(), 'admin') !== 0 && strpos(uri_string(), 'account') !== 0): ?>
                                    <a href="/auth/logout_via_ajax" class="btn btn-danger logout-via-ajax">Logout</a>
                                <?php else: ?>
                                    <a href="/auth/logout" class="btn btn-danger">Logout</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="logged-out">
                            <?= form_open('/auth/login_via_ajax', 'class="form-inline"'); ?>
                                <input type="text" class="input" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" maxlength="80" required="required">
                                <input type="password" class="input-small" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>" maxlength="100" required="required">
                                <label for="remember_me" class="checkbox">
                                    <input type="checkbox" id="remember_me" name="remember_me" value="1" <?= set_checkbox('remember_me', 1) ?>> Remember Me
                                </label>
                                <input type="submit" name="login_user" class="btn btn-primary" value="Sign In">
                                <a href="/auth/register" class="btn">Register</a>
                            </form>
                        </div>
                        <div class="logged-in">
                            <span>Logged in as <b class="email"></b></span>
                            <a href="/auth" class="btn btn-info">Account</a>
                            <?php if (strpos(uri_string(), 'admin') !== 0 && strpos(uri_string(), 'account') !== 0): ?>
                                <a href="/auth/logout_via_ajax" class="btn btn-danger logout-via-ajax">Logout</a>
                            <?php else: ?>
                                <a href="/auth/logout" class="btn btn-danger">Logout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="auth-toggle">
                    <i class="icon-user"></i> <i class="icon-arrow-down"></i>
                </div>

            <?php endif; ?>

            <?php if (!empty($status_messages)): ?>
                <div class="inner-wrapper message standard-message">
                    <?= $status_messages ?>
                </div>
            <?php endif; ?>
            <div class="inner-wrapper message hide"></div>

        </header>

        <div id="content" class="container-fluid">
        
            