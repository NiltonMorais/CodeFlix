<?php

namespace CodeFlix\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFlix\Models\Serie;

/**
 * Class SerieTransformer
 * @package namespace CodeFlix\Transformers;
 */
class SerieTransformer extends TransformerAbstract
{

    /**
     * Transform the \Serie entity
     * @param Serie $model
     *
     * @return array
     */
    public function transform(Serie $model)
    {
        return [
            'id'         => (int) $model->id,
            'title'         => $model->title,
            'description'         => $model->description,
            'thumb_url'         => $model->thumb_small_asset,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
