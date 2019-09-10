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

    public static function combineMedia($model)
    {
        $combined = [];

        if ($model) {
            if (count($model->getMedia('audio'))) {
                $combined = array_map(function ($callback) {
                    return [
                        'id' => $callback['id'],
                        'orginal_name' => $callback['name'],
                        'file_name' => $callback['file_name'],
                        'mime_type' => $callback['mime_type'],
                        'size' => $callback['size'],
                        'created_at' => $callback['created_at'],
                        'collection_name' => $callback['collection_name']
                    ];
                }, $model->getMedia('audio')->toArray());
            }
        }
    }
}
