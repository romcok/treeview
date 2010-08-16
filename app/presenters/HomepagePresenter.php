<?php

/**
 * TreeView - Nette Framework Example.
 *
 * @copyright  Copyright (c) 2010 Roman Novák
 * @package    nette-treeview
 */



/**
 * Homepage presenter.
 *
 * @author     Roman Novák
 * @package    nette-treeview
 */
class HomepagePresenter extends BasePresenter
{
	/** @persistent int */
	public $mode;

	public function actionDefault($id = null)
	{
		if(null !== $id) {
			$this->invalidateControl('message');
			$this->template->site = SitemapModel::find($id);
		}
		$this->template->mode = null === $this->mode ? 1 : $this->mode;
	}
	
	public function handleMode($mode)
	{
		$this->invalidateControl('mode');
		$this['tree']->invalidateControl();
	}
	
	public function createComponentTree()
	{
		$tree = new TreeView();
		$tree->useAjax = true;
		$mode = null === $this->mode ? 1 : $this->mode;
		$session = Environment::getSession();
		$tree->mode = $mode;
		$tree->rememberState = true;
		$tree->addLink('default', 'name', 'id', true, $this->presenter);
		$tree->dataSource = SitemapModel::findAll();
		//$tree->enableSorting(array($this, 'move'));
		
		//$tree->renderer->wrappers['link']['collapse'] = null;
		//$tree->renderer->wrappers['link']['expand'] = null;
		//$tree->renderer->wrappers['node']['icon'] = null;
		
		$tree->renderer->wrappers['link']['collapse'] = 'a class="ui-icon ui-icon-circlesmall-minus" style="float: left"';
		$tree->renderer->wrappers['link']['expand'] = 'a class="ui-icon ui-icon-circlesmall-plus" style="float: left"';
		$tree->renderer->wrappers['node']['icon'] = 'span class="ui-icon ui-icon-document" style="float: left"';

		return $tree;
	}
	
	public function move($direction)
	{
		
	}
}
