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
                'name' => $request->name,
                'category' => $request->category
            ])
            ->toMediaCollection($tag['tag']);

        return [
            'resource' => $result,
            'validator' => $validator
        ];
    }

    protected function updateResources($request, $model)
    {
        $validator = $request->validated();

        $tag = $this->getTag($request);

        $result = $model
            ->addMedia($request->file_name)
            ->withCustomProperties([
                'description' => $request->description,
                'name' => $request->name,
                'category' => $request->category
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

            if (strpos($category->name, "audio") !== false) {
                $rules['file_name'] =
                    'required|file|mimes:mpga,wav,ogg,flac,aac,mp3';
                $tag = "audio";
            } elseif (strpos($category->name, "video") !== false) {
                $rules['file_name'] = 'required|file|mimes:mp4,flv,3gp,mkv,qt';
                $tag = "video";
            } elseif (strpos($category->name, "document") !== false) {
                $rules['file_name'] =
                    'required|file|mimes:txt,html,doc,docx,ppt,pdf,csv';
                $tag = "document";
            } else {
                $rules['file_name'] = 'required|file';
                $tag = "assets";
            }
        }

        return [
            'rules' => $rules,
            'tag' => $tag
        ];
    }
}
