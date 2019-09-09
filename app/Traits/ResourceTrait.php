<?php

namespace App\Traits;

use App\OrganisationCategory;

trait ResourceTrait
{
    protected function storeResources($request, $uuid, $model)
    {
        $validator = $request->validated();

        $model = $model::getByUuid($uuid);

        $tag = $this->getTag($request);

        // attach file to collection
        $result = $model
            ->addMedia($request->file_name)
            ->withCustomProperties([
                'description' => $request->description,
                'name' => $request->name
            ])
            ->toMediaCollection($tag['tag']);

        return [
            'resource' => $result,
            'validator' => $validator
        ];
    }

    public function getTag($request)
    {
        $tag = "assets";
        $rules = [];

        if ($request->has('category')) {
            $category = OrganisationCategory::findOrFail($request->category);

            if ($category->name == 'audio') {
                $rules['file_name'] =
                    'required|file|mimes:mpga,wav,ogg,flac,aac,mp3';
                $tag = "audio";
            } elseif ($category->name == 'video') {
                $rules['file_name'] = 'required|file|mimes:mp4,flv,3gp,mkv,qt';
                $tag = "video";
            } elseif ($category->name = 'document') {
                $rules['file_name'] =
                    'required|file|mimes:txt,html,doc,docx,ppt,pdf,csv';
                $tag = "document";
            }
        }

        return [
            'rules' => $rules,
            'tag' => $tag
        ];
    }
}
