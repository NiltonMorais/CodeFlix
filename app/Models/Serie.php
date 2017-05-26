<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Media\SeriePaths;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Serie extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SeriePaths;

    protected $fillable = ['title', 'description','thumb'];

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
