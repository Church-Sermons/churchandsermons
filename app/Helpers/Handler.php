<?php

namespace App\Helpers;
use Storage;

class Handler
{
    public static $oldImage;
    public static $model;

    public static function model($model)
    {
        if ($model) {
            static::$model = $model;
        }

        return new static();
    }

    public static function whileUpdating($name)
    {
        if (static::$model->isDirty($name)) {
            // get old image
            static::$oldImage = static::$model->getOriginal($name);
        }

        return new static();
    }

    public static function whileDeleting($name)
    {
        if ($name) {
            static::$oldImage = static::$model->$name;
        }

        return new static();
    }

    public function deleteImage($disk = 'public')
    {
        if (is_file(public_path('storage/' . static::$oldImage))) {
            // delete old profile image
            Storage::disk($disk)->delete(static::$oldImage);
        }
    }
}
