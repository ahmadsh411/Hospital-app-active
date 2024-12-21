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


    public function verifyAndStoreImages(Request $request, $inputName, $folderName, $disk, $imageable_id, $imageable_type) {

        // نتأكد من وجود ملفات بالمدخل المحدد (أكثر من صورة)
        if ($request->hasFile($inputName)) {
            $images = $request->file($inputName); // نخزن جميع الصور في مصفوفة

            // نتحقق إذا كان الملف الواحد مجموعة أو مجرد صورة واحدة


            // حلقة تكرار لحفظ كل صورة
            foreach ($images as $photo) {


                // توليد اسم فريد للصورة
                $name = Str::slug($request->input('name')) . '-' . uniqid();
                $filename = $name . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs($folderName, $filename, $disk);
                // إنشاء وحفظ تفاصيل الصورة في قاعدة البيانات
                $image = new Image();
                $image->filename = $filename;
                $image->imageable_id = $imageable_id;
                $image->imageable_type = $imageable_type;
                $image->type = $request->input('type') ? 1 : 0;
                $image->save();

                // تخزين الصورة في الديسك المحدد

            }
            return true;
        }

        return null;
    }
}
