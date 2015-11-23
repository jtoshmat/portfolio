<?php

namespace app\Transformer;

use app\Game;
use League\Fractal\TransformerAbstract;

class GameTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        //'users',

    ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(Game $game)
    {
        return [
            'id'              => (int) $game->id,
            'title'           => $game->title,
            'description'     => $game->description,
            'created_at'      => (string) $game->created_at,
        ];
    }

}
