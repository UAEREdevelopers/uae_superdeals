<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Settings;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function index()
    {
         return view('backend.home');
        
    }

    public function getSetting(){

        $settings = Settings::first();
        $categories = Category::all();
        return view('backend.settings')->with(compact(['settings', 'categories']));
    }

    public function saveSettings(request $request){
        
        $data=[];
        if($request->hasFile('bannerimage') ){
          $data[ 'home_banner' ] = asset('uploads/banners/'. save_uploaded_image($request->bannerimage , 'uploads/banners/'));
        }

        if($request->hasFile('homepage_second_banner') ){
          $data[ 'homepage_second_banner' ] = asset('uploads/banners/'. save_uploaded_image($request->homepage_second_banner , 'uploads/banners/'));
        }

        if($request->hasFile('categories_banner') ){
          $data[ 'categories_banner' ] =  asset('uploads/banners/'. save_uploaded_image($request->categories_banner , 'uploads/banners/'));
        }

            $data['banner_heading'] = $request->title; 
            $data['banner_text'] = $request->banner_text;
            $data['top_section_category_id'] = $request->top_section_category_id;
            $data['middle_section_category_id'] = $request->middle_section_category_id;
            $data['bottom_section_category_id'] = $request->bottom_section_category_id;


          $settings = Settings::first();

          if( empty($settings)){

              Settings::create($data);
          }else{
            
              $settings->update($data);
          }


           Session::flash('success', 'Succesfully created');
           return redirect()->back();


    }

    public function blankPage(){
        return view('backend.layout.blankpage');
    }

    public function uploadImage(Request $request){    
        
      
      // testing
      
          $fileName=$request->file('file')->getClientOriginalName();
        $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json(['location'=>"/storage/$path"]); 
        
        /*$imgpath = request()->file('file')->store('uploads', 'public'); 
        return response()->json(['location' => "/storage/$imgpath"]);*/

    // testing ends 

        
         if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
         
        //  $image = time().'.'.$request->file->getClientOriginalName();
        //     $request->file->move(public_path('uploads/texteditorpics'), $image);
        //     $imageurl = asset('uploads/texteditorpics/'.$image );
        //     $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        //       $msg = 'Image successfully uploaded'; 
        //     $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$imageurl', '$msg')</script>";
               
        //     @header('Content-type: text/html; charset=utf-8'); 
        //     echo $response;

        //     // return json_encode(['file_path' => $imageurl]);
    }

    public function uploadVideo(Request $request){
        
      
        $fileName=$request->file('file')->getClientOriginalName();
        $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json(['location'=>"/storage/$path"]); 
    }

    public function Categories(){

        $categories = Category::with('category')->get();
        // return $categories;

        return view('backend.categories.showall')->with(compact('categories'));
    }

    
     public function saveCategory(Request $request){
       

        $parent_id = $request->parent_id == 0 ? null : $request->parent_id;

        if($request->hasFile('image') ){
          $thumbnailurl =  asset('uploads/categories/'. save_uploaded_image($request->image , 'uploads/categories/' , 400 , 267 ));
        }

        if($request->hasFile('banner') ){
          $bannerurl =   asset('uploads/categories/'. save_uploaded_image($request->banner , 'uploads/categories/' ));
        }

        $category = Category::create([
            'name' => $request->category,
            'category_id' => $parent_id,
            'link'=> $request->link,
            'slug' => $request->category,
            'image' => $thumbnailurl ?? '',
            'banner' => $bannerurl ?? null
        ]);
    
        Session::flash('success', 'Saved Successfully');
        return back();

    }



    public function editCategory(Request $request , $id){

    }

    public function updateCategory(Request $request){

        if($request->hasFile('image') ){
          $thumbnailurl =  asset('uploads/categories/'. save_uploaded_image($request->image , 'uploads/categories/' , 400 , 267 ));
        }

        if($request->hasFile('banner') ){
          $bannerurl =   asset('uploads/categories/'. save_uploaded_image($request->banner , 'uploads/categories/' ));
        }


        $category = Category::where('id', $request->categoryid)->first();
        $category->name = $request->category;
        $category->link = $request->link;
        $category->slug = $request->category;
        $category->image = $thumbnailurl ?? null;
        $category->banner = $bannerurl ?? null;
        $category->category_id = $request->parent_id == 0 ? null : $request->parent_id;
        $category->save();

        Session::flash('success', 'Updated Successfully');
        return back();

    }

    public function deleteCategory(Request $request, $id){
        $category = Category::where('id', $id)->first();
        $category->delete();

        Session::flash('success', 'Deleted Successfully');
        return back();

    }

}
   
