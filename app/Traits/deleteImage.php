<?php
namespace App\Traits;

use App\Models\Images\Image;
use Illuminate\Support\Facades\Storage;

trait deleteImage
{
 public function deleteattach($disk,$path,$filename,$imageable_type,$imageable_id)
 {
     Storage::disk($disk)->delete($path . '/' . $filename);
       $image=Image::where('imageable_id',$imageable_id)
              ->where('imageable_type',$imageable_type)->delete();


     return null;
 }

}
