<?php

namespace App\Services\ImageService;


use http\Env\Request;
use Image;

class SaveImageIntervention implements SaveImageInterface
{

    public function saveUploadImage($image)
    {
        if($this->canHandleImage()){
            Image::make(request()->file('image'))
                ->resize(config('myConfig.imageSize.product.width'), config('myConfig.imageSize.product.height'))
                ->save($this->getImagePath($image));
        }
    }

    private function canHandleImage()
    {
        return request()->hasFile('image');
    }

    private function getImagePath($name)
    {
        return public_path('img\cover') . DIRECTORY_SEPARATOR . 'cover-' . $name . '.jpg';
    }
}
