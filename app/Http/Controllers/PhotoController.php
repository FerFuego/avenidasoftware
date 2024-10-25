<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function store (Request $request, Task $task) {
        if($request->hasFile('file')){
            
            $uploadPath = "uploads/gallery/";
            
            $file = $request->file('file');
            
            $extention = $file->getClientOriginalExtension();
            $filename = time().'-'.rand(0,99).'.'.$extention;
            $file->move($uploadPath, $filename);
            
            $finalImageName = $uploadPath.$filename;
            
            Photo::create([
                'task_id' => $task->id,
                'photo_path' => $finalImageName
            ]);
    
            return response()->json(['success' => 'Image Uploaded Successfully']);
        }
        else
        {
            return response()->json(['error' => 'File upload failed.']);
        }
    }
}
