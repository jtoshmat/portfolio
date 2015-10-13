<?php

namespace cmwn\Repositories;
use cmwn\Repositories\FlatTagRepository;

class UserSpecificContent
{

    public $tag;

	public function __construct(FlatTagRepository $tag){
		$this->tag = $tag;
	}

	public function compose($view){
		$view->with('tags', $this->tag->getAll());
	}

}
