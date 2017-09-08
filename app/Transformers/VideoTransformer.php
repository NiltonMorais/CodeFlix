<?php

namespace CodeFlix\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFlix\Models\Video;

/**
 * Class VideoTransformer
 * @package namespace CodeFlix\Transformers;
 */
class VideoTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['serie','categories'];

    /**
     * Transform the \Video entity
     * @param Video $model
     *
     * @return array
     */
    public function transform(Video $model)
    {
        return [
            'id'         => (int) $model->id,
            'title'         => $model->title,
            'description'         => $model->description,
            'thumb_small_url'         => $model->thumb_small_asset,
            'file_url'         => $model->file_asset,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeSerie(Video $model){
        if(!$model->serie){
            return null;
        }
        return $this->item($model->serie, new SerieTransformer());
    }

    public function includeCategories(Video $model){
        return $this->collection($model->categories, new CategoryTransformer());
    }
}
