<?
if (!isset($page_head_title) || $page_head_title=="") $page_head_title = "ChinoVieza.com - The matches of 2014 FIFA World Cup Brazil";
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$page_head_title?></title>

<!--                       CSS                       -->

<!-- Reset Stylesheet -->
<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/reset.css" type="text/css" media="screen" />

<!-- Main Stylesheet -->
<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/style.css" type="text/css" media="screen" />

<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/red.css" type="text/css" media="screen" />

<!-- Colour Schemes

Default colour scheme is green. Uncomment prefered stylesheet to use it.

<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/blue.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/red.css" type="text/css" media="screen" />

-->

<!-- Internet Explorer Fixes Stylesheet -->

<!--[if lte IE 7]>
<link rel="stylesheet" href="<?= base_url() . "assets/" ?>resources/css/ie.css" type="text/css" media="screen" />
<![endif]-->

<!--                       Javascripts                       -->

<!-- jQuery -->
<script type="text/javascript" src="<?= base_url() . "assets/" ?>resources/scripts/jquery-1.3.2.min.js"></script>

<!-- jQuery Configuration -->
<script type="text/javascript" src="<?= base_url() . "assets/" ?>resources/scripts/simpla.jquery.configuration.js"></script>

<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="<?= base_url() . "assets/" ?>resources/scripts/facebox.js"></script>

<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="<?= base_url() . "assets/" ?>resources/scripts/jquery.wysiwyg.js"></script>

<!-- Internet Explorer .png-fix -->

<!--[if IE 6]>
    <script type="text/javascript" src="<?= base_url() . "assets/" ?>resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
    <script type="text/javascript">
	DD_belatedPNG.fix('.png_bg, img, li');
</script>
<![endif]-->