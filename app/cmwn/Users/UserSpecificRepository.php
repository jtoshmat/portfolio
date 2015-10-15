<?php

namespace app\cmwn\Users;
use app\Repositories\SideBarItems;

class UserSpecificRepository
{

    public $tag;

	public function __construct(SideBarItems $tag){
		$this->tag = $tag;
	}

	public function compose($view){
		$view->with('tags', $this->tag->getAll());
	}

}
