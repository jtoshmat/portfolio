<?php

namespace app\Repositories;
use app\Repositories\SideBarItems;

class UserSpecificContent
{

    public $tag;

	public function __construct(SideBarItems $tag){
		$this->tag = $tag;
	}

	public function compose($view){
		$view->with('tags', $this->tag->getAll());
	}

}
