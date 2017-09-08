<?php

namespace CodeFlix\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFlix\Models\Category;

/**
 * Class CategoryTransformer
 * @package namespace CodeFlix\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    /**
     * Transform the \Category entity
     * @param Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'         => $model->name,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
