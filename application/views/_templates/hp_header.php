<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="<?php echo HP_ASSETS_PATH;?>ico/favicon.png">
    <title>My Website</title>
    <!-- Style Sheets -->
    <link href="<?php echo HP_CSS_PATH;?>adder.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HP_CSS_PATH;?>prettify.css" rel="stylesheet" type="text/css">
    <link href="<?php echo HP_CSS_PATH;?>custom.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Header -->
<header id="main-header">
    <div class="site-width">
        <!-- Mini contact info -->
        <ul class="ft-left">
            <li><i class="fa fa-map-marker"></i> 4671 Wallburger, London, UK</li>
            <li><i class="fa fa-mobile"></i> (+21) 555 444 1234</li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:lol@lol.com">support@tosol.co.uk</a></li>
        </ul>
        <!-- Site options -->
        <ul class="ft-right">
            <li><a href="#" class="btn"><?php $this->L->prnt("head_language"); ?> <i class="fa fa-caret-down"></i></a></li>
            <li><a href="#" class="btn red"><?php $this->L->prnt("head_login"); ?> <i class="fa fa-sign-in"></i></a></li>
        </ul>
    </div>
</header>

<!-- Main Navigation -->
<nav id="main-nav">
    <div class="site-width">
        <a href="index.html" id="site-logo"><img src="<?php echo HP_ASSETS_PATH; ?>logo-1.png" alt="The Oxford School of Language"></a>
        <ul>
            <li><a href="#"><?php $this->L->prnt("menu_home"); ?></a></li>
            <li><a href="#"><?php $this->L->prnt("menu_course_info"); ?></a></li>
            <li><a href="#"><?php $this->L->prnt("menu_price"); ?></a></li>
            <li><a href="#"><?php $this->L->prnt("menu_blog"); ?></a></li>
            <li><a href="#"><?php $this->L->prnt("menu_contact"); ?></a></li>
        </ul>
    </div>
</nav>