<?php //netteCache[01]000236a:2:{s:4:"time";s:21:"0.64214100 1264470766";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:81:"/Users/romcok/Sites/projekty/nette-treeview/htdocs/../app/templates/@layout.phtml";i:2;i:1264469459;}}}?><?php
// file …/templates/@layout.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, 'bec66ebca4'); unset($_extends);

if (isset($presenter, $control) && $presenter->isAjax()) { LatteMacros::renderSnippets($control, $_cb, get_defined_vars()); }

if (SnippetHelper::$outputAllowed) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<meta name="description" content="TreeView - Nette Framework Example"><?php if (isset($robots)): ?>
	<meta name="robots" content="<?php echo TemplateHelpers::escapeHtml($robots) ?>">
<?php endif ?>

	<title>TreeView - Nette Framework Example</title>

	<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/jquery-ui-1.7.2.custom/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/jquery-ui-1.7.2.custom/js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/jquery.nette.js"></script>

	<script type="text/javascript">
	    $("a.ajax").live("click", function (event) {
		event.preventDefault();
		$.get(this.href);
	    });
	</script>

	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/screen.css" type="text/css">
	<link rel="stylesheet" media="print" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/css/print.css" type="text/css">
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/js/jquery-ui-1.7.2.custom/css/ui-lightness/jquery-ui-1.7.2.custom.css" type="text/css">
	<link rel="shortcut icon" href="<?php echo TemplateHelpers::escapeHtml($basePath) ?>/favicon.ico" type="image/x-icon">

	<style type="text/css">
		body {
			margin: 0;
			padding 0;
		}
	
		div {
			padding: .2em 1em;
		}
	
		#header {
			background: #EEE;
			border-bottom: 1px #DDD solid;
		}
	
		h1 {
			color: #0056ad;
			font-size: 30px;
		}
	
		h2 {
			color: gray;
			font-size: 20px;
		}
		
		.active {
			font-weight: bold;
		}
		
	    ul li {
		margin: 0px;
		padding: 0px;
		list-style-type: none;
		line-height: 16px;
	    }

	    a {
		text-decoration: none;
		color: #000;
	    }

	    a:hover {
		text-decoration: underline;
	    }
	</style>
</head>

<body>
	<?php foreach ($iterator = $_cb->its[] = new SmartCachingIterator($flashes) as $flash): ?><div class="flash <?php echo TemplateHelpers::escapeHtml($flash->type) ?>"><?php echo TemplateHelpers::escapeHtml($flash->message) ?></div><?php endforeach; array_pop($_cb->its); $iterator = end($_cb->its) ?>


	<?php } LatteMacros::callBlock($_cb, 'content', $template->getParams()) ;if (SnippetHelper::$outputAllowed) { ?>
</body>
</html>
<?php
}
