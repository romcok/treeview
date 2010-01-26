<?php

/**
 * TreeView - Nette Framework Example.
 *
 * @copyright  Copyright (c) 2010 Roman Novák
 * @package    nette-treeview
 */



/**
 * Sitemap model.
 *
 * @author	   Roman Novák
 * @package    nette-treeview
 */
class SitemapModel extends Object
{
	static function find($id)
	{
		return self::findAll()->where('id=%i', $id)->fetch();
	}

	static function findAll()
	{
		return dibi::select('*')->from('sitemap')->orderBy('position');
	}
}
