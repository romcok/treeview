<?php //netteCache[01]000245a:2:{s:4:"time";s:21:"0.62821300 1264470766";s:9:"callbacks";a:1:{i:0;a:3:{i:0;a:2:{i:0;s:5:"Cache";i:1;s:9:"checkFile";}i:1;s:90:"/Users/romcok/Sites/projekty/nette-treeview/htdocs/../app/templates/Homepage/default.phtml";i:2;i:1264469436;}}}?><?php
// file …/templates/Homepage/default.phtml
//

$_cb = LatteMacros::initRuntime($template, NULL, '0b7583b3b4'); unset($_extends);


//
// block content
//
if (!function_exists($_cb->blocks['content'][] = '_cbbf1cb892188_content')) { function _cbbf1cb892188_content($_cb) { extract(func_get_arg(1))
;if (SnippetHelper::$outputAllowed) { ?>

<div id="header">
	<h1>TreeView</h1>

	<h2>Nette Framework example.</h2>
</div>

<br />

<?php } if ($_cb->foo = SnippetHelper::create($control, "message")) { $_cb->snippets[] = $_cb->foo ;if (isset($site)): ?>
	<div class="ui-widget ui-state-highlight ui-corner-all">
		You clicked on "<?php echo TemplateHelpers::escapeHtml($site->name) ?>" link in tree view example.
	</div>
<?php endif ;array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { } if ($_cb->foo = SnippetHelper::create($control, "mode")) { $_cb->snippets[] = $_cb->foo ?>
	Modes: 	<a href="<?php echo TemplateHelpers::escapeHtml($control->link("mode!", array(TreeView::EXPANDED))) ?>" class="ajax<?php if ($mode==TreeView::EXPANDED): ?> active<?php endif ?>">Expanded</a> | <a href="<?php echo TemplateHelpers::escapeHtml($control->link("mode!", array(TreeView::AJAX))) ?>" class="ajax<?php if ($mode==TreeView::AJAX): ?> active<?php endif ?>">Ajax</a>
<?php array_pop($_cb->snippets)->finish(); } if (SnippetHelper::$outputAllowed) { ?>

<?php } $control->getWidget("tree")->render() ;if (SnippetHelper::$outputAllowed) { 
}}

//
// end of blocks
//

if ($_cb->extends) { ob_start(); }
elseif (isset($presenter, $control) && $presenter->isAjax()) { LatteMacros::renderSnippets($control, $_cb, get_defined_vars()); }

if (SnippetHelper::$outputAllowed) {
} if (!$_cb->extends) { call_user_func(reset($_cb->blocks['content']), $_cb, $template->getParams()); }  
}

if ($_cb->extends) { ob_end_clean(); LatteMacros::includeTemplate($_cb->extends, get_defined_vars(), $template)->render(); }
