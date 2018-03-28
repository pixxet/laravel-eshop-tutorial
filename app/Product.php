<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if ($key === 'imageurl') {
            return $this->getFileURL();
        }

        return parent::__get($key);
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function getFileURL()
    {
        if (!$this->file()->count()) {
            return;
        }

        return optional($this->file()->first())->filename;
    }
}
