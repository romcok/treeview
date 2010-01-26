<?php

/**
 * TreeView control
 *
 * Copyright (c) 2009, 2010 Roman Novák
 *
 * This source file is subject to the New-BSD licence.
 *
 * For more information please see http://nettephp.com
 *
 * @copyright  Copyright (c) 2009, 2010 Roman Novák
 * @license    New-BSD
 * @link       http://nettephp.com/cs/extras/treeview
 * @version    0.6.0a
 */

/**
 * TreeView node.
 *
 * @author     Roman Novák
 * @copyright  Copyright (c) 2009, 2010 Roman Novák
 * @package    nette-treeview
 */
class TreeViewNode extends Control
{
    const COLLAPSED = 0;
    const EXPANDED = 1;

    /** @var mixed */
    protected $dataRow;

    /** @var int */
    protected $state;

    /** @var bool */
    protected $loaded = false;

    /** @var bool */
    protected $invalid = false;

    function __construct(IComponentContainer $parent = null, $name = null, &$dataRow = null)
    {
	$this->setDataRow($dataRow);
	parent::__construct($parent, $name);
    }

    /********** handlers **********/

    function handleExpand()
    {
	$this->invalidate();
	$this->expand();
    }

    function handleCollapse()
    {
	$this->invalidate();
	$this->collapse();
    }

    protected function getDataRows()
    {
	$ds = clone $this->treeView->dataSource;
	if(null === $ds) {
	    throw new InvalidStateException('Missing data source.');
	}
	elseif($ds instanceOf IDataSource) {
	    $parent = $this->getParent();
	    if($parent instanceOf TreeViewNode && !empty($this->dataRow)) {
		$ds->where('%n=%i', $this->treeView->parentColumn, $this->dataRow[$this->treeView->primaryKey]);
	    }
	    else {
		$ds->where('%n IS NULL', $this->treeView->parentColumn);
	    }
	    $dataRows = $ds->fetchAssoc($this->treeView->primaryKey);
	}
	else {
	    throw new InvalidStateException('DataSource must implement IDataSource interface.');
	}
	return $dataRows;
    }

    protected function load()
    {
	if(!$this->loaded) {
	    $this->loaded = true;
	    $dataRows = TreeView::EXPANDED !== $this->treeView->mode ? $this->getDataRows() : $this->treeView->getDataRows();
	    foreach($dataRows as $dataRow) {
		if((empty($this->dataRow) && empty($dataRow->parentId)) || (!empty($this->dataRow) && $this->dataRow->id === $dataRow->parentId)) {
		    $name = $dataRow[$this->treeView->primaryKey];
		    $node = new TreeViewNode($this, $name, $dataRow);
		    $node['nodeLink'] = clone $this['nodeLink'];
		    if(TreeView::EXPANDED === $this->treeView->mode && 
		    (($this->treeView->rememberState && !$node->isSessionState()) ||
		    !$this->treeView->rememberState)) {
			$node->expand();
		    }
		}
	    }
	}
    }

    public function signalReceived($signal)
    {
	$parent = $this->getParent();
	if($parent instanceOf TreeViewNode) {
	    $parent->expand();
	}
	parent::signalReceived($signal);
    }

    protected function createComponent($name)
    {
	$this->load();
	return parent::createComponent($name);    
    }

    protected function createComponentStateLink($name)
    {
	switch($this->getState()) {
	    case self::EXPANDED:
		$destination = 'collapse';
		$labelKey = '-';
		break;
	    case self::COLLAPSED:
		$destination = 'expand';
		$labelKey = '+';
		break;
	}

	return new TreeViewLink($destination, $labelKey, null, $this->getTreeView()->useAjax, $this);
    }

    public function getNodes()
    {
	$this->load();
	return $this->getComponents(false, 'TreeViewNode');
    }

    function expand()
    {
	$this->setState(self::EXPANDED);
    }

    function collapse()
    {
	$this->setState(self::COLLAPSED);
    }

    /********** state **********/

    public function setState($state)
    {
	$this->state = $state;
	if($this->getTreeView()->rememberState) {
	    $session = $this->getNodeSession();
	    $session['state'] = $state;
	}
    }

    public function getState()
    {
	if(null === $this->state) {
	    if(true === $this->getTreeView()->rememberState) {
		$session = $this->getNodeSession();
		$this->state = isset($session['state']) ? $session['state'] : self::COLLAPSED;
	    }
	    else {
		$this->state = self::COLLAPSED;
	    }
	}
	return $this->state;
    }

    public function isSessionState()
    {
	$session = $this->getNodeSession();
	return isset($session['state']);
    }

    protected function getNodeSession()
    {
	return Environment::getSession()->getNamespace('Nette.Extras.TreeView/' . $this->getName());
    }

    /********** node validation **********/

    public function invalidate()
    {
	$this->invalid = true;
	$this->invalidateControl();
    }

    public function validate()
    {
	$this->invalid = false;
	$this->validateControl();
    }

    public function isInvalid()
    {
	return $this->invalid;
    }

    public function isLoaded()
    {
	return $this->loaded;
    }

    /********** setters **********/

    function setDataRow($dataRow)
    {
	$this->dataRow = $dataRow;
    }

    /********** getters **********/

    public function getTreeView()
    {
	return $this->lookup('TreeView');
    }

    function getDataRow()
    {
	return $this->dataRow;
    }
}