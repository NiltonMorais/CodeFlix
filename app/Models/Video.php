<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Media\VideoPaths;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;
    use VideoPaths;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'published',
        'serie_id',
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getTableHeaders()
    {
        return ['#'];
    }


    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
        }
    }

}
