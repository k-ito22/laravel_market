<?php

namespace App\Services;

class FileUploadService {
    
    public function saveImage($image) {
        $path='';
        if( isset($image) ) {
            $path = $image->store('images', 'public');
        }
        return $path;
    }
    
    
}