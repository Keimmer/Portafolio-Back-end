<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
 
use App\Models\Image;
use App\Models\Blog;
use App\Models\Parragraph;
use App\Models\User;
 
use Validator;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
 
class MultipleUploadController extends Controller
{

    public function getAllBlog(Request $request) {
        return Blog::select('blogtitle', 'blogs.created_at', 'users.name', 'users.lastname', 'subtitle', 'parragraph', 'path')
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->join('images', 'images.id', '=', 'blogs.image_id')
            ->join('parragraphs', 'blogs.id', '=', 'parragraphs.blog_id')->groupBy('blog_id')
            ->get();
    }
    
public function store(Request $request)
{
    
    if(!$request->hasFile('file')) {
        return response()->json(['upload_file_not_found'], 400);
    }
 
    $allowedfileExtension=['pdf','jpg','png'];
    $file = $request->file('file'); 
    $errors = [];      
 
        $extension = $file->getClientOriginalExtension();
 
        $check = in_array($extension,$allowedfileExtension);
 
        if($check) { 
            $path = $file->store('public/images');
            $name = $file->getClientOriginalName();
      
            //store image file into directory and d
            $save = new Image();
            $save->title = $name;
            $save->path = $path;
            $save->save();            
            //$file->move(base_path() . '/public/images/', $name);
            
        } else {
        return response()->json(['invalid_file_format'], 422); 
    }


    $user = User::select('id')->where('email', $request->user_id)->get();
    $user_id = $user[0]->id;
    
    $blog_id = Blog::create(['user_id'=>$user_id, 'blogtitle'=>$request->blogtitle, 'image_id'=>$save->id])->id;

    $inputsArr = json_decode($request->inputs, true);

    Log::info(json_encode($inputsArr));

    foreach ($inputsArr as $input) {
        
        Parragraph::create(['blog_id'=>$blog_id,
        'subtitle'=>$input['subtitle'],
        'parragraph'=>$input['parragraph'],
        'source'=>$input['source'],]);
    }

    return response()->json(['file_uploaded'], 200); 
    
}
 
}