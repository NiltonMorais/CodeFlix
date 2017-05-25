<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Traits\TransformableTrait;

class Serie extends Model implements TableInterface
{
    use TransformableTrait;

    protected $fillable = ['title', 'description'];

    public function getTableHeaders()
    {
        return ['#', 'Título', 'Descrição'];
    }

    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Título':
                return $this->title;
            case 'Descrição':
                return $this->description;
        }
    }
}
