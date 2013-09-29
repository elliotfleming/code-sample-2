<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts.js"></script>
</head>
<body>

    <div id="container">

        <header>

            <nav>
                <div class="navbar navbar-static-top">
                    <div class="navbar-inner">

                        <div class="inner-wrapper">

                            <ul class="visible-desktop nav pull-right">
                                <li><a href="/" class="btn"><i class="icon-home"></i> Home / <i class="icon-fire"></i> Boils</a></li>
                                <li><a href="/boils/addBoil" class="btn"><i class="icon-plus-sign"></i> Add Boil</a></li>
                                <li><a href="/prices" class="btn"><i class="icon-tag"></i> Prices</a></li>
                            </ul>

                            <!--
                            <ul class="visible-desktop nav pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-th-list"></i> Sort By
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <?php if ($orderByField === 'boiled_price'): ?>
                                            <?php if ($ascDesc === 'asc'): ?>
                                                <li>
                                                    <a href="/prices/sortby/boiled_price/desc">Price <i class="icon-arrow-up"></i></a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="/prices/sortby/boiled_price/asc">Price <i class="icon-arrow-down"></i></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <li>
                                                <a href="/prices/sortby/boiled_price/asc">Price <i class="icon-arrow-down"></i></a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if ($orderByField === 'timestamp'): ?>
                                            <?php if ($ascDesc === 'asc'): ?>
                                                <li>
                                                    <a href="/prices/sortby/timestamp/desc">Last Update <i class="icon-arrow-up"></i></a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="/prices/sortby/timestamp/asc">Last Update <i class="icon-arrow-down"></i></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <li>
                                                <a href="/prices/sortby/timestamp/asc">Last Update <i class="icon-arrow-down"></i></a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </li>
                            </ul>
                            -->

                            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>

                            <div href="/"><a class="brand" href="/"></a></div>

                            <div class="visible-phone nav-collapse collapse navbar-responsive-collapse">
                                
                                <!--<span class="white">Sort By</span>-->

                                <ul class="nav">
                                    <li><a href="/" class="btn"><i class="icon-home"></i> Home / <i class="icon-fire"></i> Boils</a></li>
                                    <li><a href="/boils/addBoil" class="btn"><i class="icon-plus-sign"></i> Add Boil</a></li>
                                    <li><a href="/prices" class="btn"><i class="icon-tag"></i> Prices</a></li>
                                </ul>

                                <!--
                                <ul class="nav">
                                    
                                    <?php if ($orderByField === 'boiled_price'): ?>
                                        <?php if ($ascDesc === 'asc'): ?>
                                            <li>
                                                <a href="/prices/sortby/boiled_price/desc">Price <i class="icon-arrow-up"></i></a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="/prices/sortby/boiled_price/asc">Price <i class="icon-arrow-down"></i></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <li>
                                            <a href="/prices/sortby/boiled_price/asc">Price <i class="icon-arrow-down"></i></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($orderByField === 'timestamp'): ?>
                                        <?php if ($ascDesc === 'asc'): ?>
                                            <li>
                                                <a href="/prices/sortby/timestamp/desc">Last Update <i class="icon-arrow-up"></i></a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a href="/prices/sortby/timestamp/asc">Last Update <i class="icon-arrow-down"></i></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <li>
                                            <a href="/prices/sortby/timestamp/asc">Last Update <i class="icon-arrow-down"></i></a>
                                        </li>
                                    <?php endif; ?>

                                </ul>
                                -->

                            </div>

                        </div>

                    </div>
                </div>
            </nav>

        </header>

        <div id="content" class="container-fluid">

            