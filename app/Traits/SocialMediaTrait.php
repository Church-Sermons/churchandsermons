<?php

namespace App\Traits;

trait SocialMediaTrait
{
    private $socialId;
    private $shareLink;
    private $pageLink;
    private $result;

    protected function storeSocialMedia($request, $model)
    {
        $validator = $request->validated();

        $this->socialId = $request->social_id;
        $this->shareLink = $request->share_link;
        $this->pageLink = $request->page_link;
        $this->result = null;
        $social = [];

        if ($this->socialId && ($this->shareLink || $this->pageLink)) {
            foreach ($this->socialId as $key => $value) {
                $exploded = explode("-", $value);
                $social[] = [
                    'social_id' => $exploded[0],
                    'share_link' => $this->shareLink[$exploded[1]],
                    'page_link' => $this->pageLink[$exploded[1]]
                ];
            }
        }

        $result = $model->social()->createMany($social);

        return [
            'validator' => $validator,
            'social' => $result
        ];
    }
}
