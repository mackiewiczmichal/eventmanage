<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;

class ImageUploadController extends Controller
{
    public function showFileForm(){
        return view('test');
    }
    public function storeImage(Request $request, $id){
        $name=$request->name;
        $image = $request->file('imageFile');
        $imageName=time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);

        $imageCheck = Images::where('events_id','=',$id)->get();

        if($imageCheck->isEmpty()){
            $eventImage = new Images();
            $eventImage->events_id = $id;
            $eventImage->name = $imageName;
            $eventImage->path_url = $imageName;
            $eventImage->save();
            return redirect()->back();
        }
        else{
            Images::where('events_id','=',$id)->update([
                'name' => $imageName,
                'path_url' => $imageName
            ]);
            return redirect()->back();
        }


    }
}
