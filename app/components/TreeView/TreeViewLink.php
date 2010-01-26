<?php

class TreeViewLink extends Component
{
    /** @var PresenterComponent */
    public $presenterComponent;

    /** @var string */
    public $destination;

    /** @var string */
    public $labelKey;

    /** @var string */
    public $paramKey;

    /** @var bool */
    public $useAjax;

    /** @var string */
    public $paramSeparator = '/';

    public function __construct($destination, $labelkey, $paramKey, $useAjax = false, PresenterComponent $presenterComponent = null)
    {
	$this->destination = $destination;
	$this->labelKey = $labelkey;
	$this->paramKey = $paramKey;
	$this->useAjax = $useAjax;
	$this->presenterComponent = $presenterComponent;
    }

    protected function attached($node)
    {
	die($node);
	if(null === $this->presenterComponent) {
	    $this->presenterComponent = $node->presenter;
	}
	parent::attached($node);
    }

    public function getLabel()
    {
	$dataRow = $this->getParent()->dataRow;
	if(null === $this->paramKey || !isset($dataRow[$this->labelKey])) {
	    return $this->labelKey;
	}
	return $dataRow[$this->labelKey];
    }

    public function getParam()
    {
	if(null === $this->paramKey) {
	    return null;
	}
	$dataRow = $this->getParent()->dataRow;
	if(!is_array($this->paramKey) && $this->getParent()->getTreeView()->recursiveMode) {
	    $param = '';
	    $preparent = $this->getParent()->getParent();
	    if($preparent instanceOf TreeViewNode && !$preparent instanceOf TreeView) {
		$param .= $this->getParent()->getParent()->getComponent('nodeLink')->getParam() . '/';
	    }
	    $param .= $dataRow[$this->paramKey];
	}
	elseif(is_array($this->paramKey)) {
	    $param = array();
	    foreach($this->paramKey as $key) {
		$param[$key] = $dataRow[$key];
	    }
	}
	else {
	    $param = $dataRow[$this->paramKey];
	}

	return $param;
    }

    public function getUrl()
    {
	$param = $this->getParam();

	if(null === $param) {
	    return $this->presenterComponent->link($this->destination);
	}
	else {
	    return $this->presenterComponent->link($this->destination, $param);
	}
    }
}