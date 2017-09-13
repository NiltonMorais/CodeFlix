<?php

namespace CodeFlix\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFlix\Models\Serie;

/**
 * Class SerieTransformer
 * @package namespace CodeFlix\Transformers;
 */
class SerieTitleTransformer extends TransformerAbstract
{

    /**
     * Transform the \SerieTitle entity
     * @param Serie $model
     *
     * @return array
     */
    public function transform(Serie $model)
    {
        return [
            'title'         => $model->title,
        ];
    }
}
