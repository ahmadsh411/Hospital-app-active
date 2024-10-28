<?php

namespace App\Traits;

use App\Models\Images\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UploadImage{

    public function verifyAndStoreImage(Request $request, $inputname , $foldername , $disk, $imageable_id, $imageable_type) {

        if( $request->hasFile( $inputname ) ) {

            // Check img
            if (!$request->file($inputname)->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }

            $photo = $request->file($inputname);
            $name = Str::slug($request->input('name'));
            $filename = $name. '.' . $photo->getClientOriginalExtension();


            // insert Image
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            if($request->input('type')){
                $Image->type=1;
            }else{
                $Image->type=0;
            }
            $Image->save();
            return $request->file($inputname)->storeAs($foldername, $filename, $disk);

        }

        return null;

    }




}
