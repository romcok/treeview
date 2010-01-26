<?php

class TreeViewRenderer extends Object implements ITreeViewRenderer
{
    /** @var TreeView */
    protected $tree;

    public $wrappers = array(
	'tree' => array(
	    'container' => 'div'
	),
	'nodes' => array(
	    'container' => 'ul'
	),
	'node' => array(
	    'icon' => null,
	    'container' => 'li'
	),
	'link' => array(
	    'node' => 'a',
	    'collapse' => 'a',
	    'expand' => 'a',
	    '.ajax' => 'ajax',
	),
    );

    public function render(TreeView $tree)
    {
	if($this->tree !== $tree) {
	    $this->tree = $tree;
	}
	$snippetId = $this->tree->getSnippetId();
	$html = $this->renderNodes($this->tree->getNodes(), 'tree container');
	if($this->tree->isControlInvalid() && $this->tree->getPresenter()->isAjax()) {
	    $this->tree->getPresenter()->getPayload()->snippets[$snippetId] = (string)$html;
	}
	if(!$this->tree->getPresenter()->isAjax()) {
	    $treeContainer = $this->getWrapper('tree container');
	    $treeContainer->id = $snippetId;
	    $treeContainer->add($html);
	    return $treeContainer;
	}
    }

    public function renderNodes($nodes, $wrapper = 'nodes container')
    {
	$nodesContainer = $this->getWrapper('nodes container');
	foreach($nodes as $n) {
	    $child = $this->renderNode($n);
	    if(null !== $child) {
		$nodesContainer->add($child);
	    }
	}
	return $nodesContainer;
    }

    public function renderNode(TreeViewNode $node)
    {
	$nodes = $node->getNodes();
	$snippetId = $node->getSnippetId();
	$nodeContainer = $this->getWrapper('node container');
	$nodeContainer->id = $snippetId;
	if(count($nodes) > 0) {
	    switch($node->getState()) {
		case TreeViewNode::EXPANDED:
		    $stateLink = $this->renderLink($node['stateLink'], 'link collapse');
		    break;
		case TreeViewNode::COLLAPSED:
		    $stateLink = $this->renderLink($node['stateLink'], 'link expand');
		    break;
	    }
	    $nodeContainer->add($stateLink);
	}
	else {
	    $icon = $this->getWrapper('node icon');
	    if(null !== $icon) {
		$nodeContainer->add($icon);
	    }
	}
	$link = $this->renderLink($node['nodeLink']);
	$nodeContainer->add($link);
	$this->tree->onNodeRender($this->tree, $node, $nodeContainer);
	if(TreeViewNode::EXPANDED === $node->getState() && count($nodes) > 0) {
	    $nodesContainer = $this->renderNodes($nodes);
	    if(null !== $nodesContainer) {
		$nodeContainer->add($nodesContainer);
	    }
	}
	$html = isset($nodeContainer) ? $nodeContainer : $nodesContainer;
	if($node->isInvalid()) {
	    $this->tree->getPresenter()->getPayload()->snippets[$snippetId] = (string)$html;
	}
	return $html;
    }

    public function renderLink(TreeViewLink $link, $wrapper = 'link node')
    {
	$el = $this->getWrapper($wrapper);
	if($link->useAjax) {
	    $class = $el->class;
	    $ajaxClass = $this->getValue('link .ajax');
	    if(!empty($class) && !empty($ajaxClass)) {
		$ajaxClass = $class . ' ' . $ajaxClass;
	    }
	    $el->class = $ajaxClass;

	}
	$el->setText($link->getLabel());
	$el->href($link->getUrl());
	return $el;
    }

    protected function getWrapper($name)
    {
	$data = $this->getValue($name);
	return $data instanceOf Html ? clone $data : Html::el($data);
    }

    protected function getValue($name)
    {
	$name = explode(' ', $name);
	$data =& $this->wrappers[$name[0]][$name[1]];
	return $data;
    }
}