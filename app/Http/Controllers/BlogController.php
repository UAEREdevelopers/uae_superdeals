<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{   


    // FRONTEND FUNCTIONS


    public function showAllblogs()
    {
        $blogs = Blog::where('is_published',1)->paginate(15);
        
        return view('frontend.blogs.showall')->with(compact('blogs'));
    }

    public function SingleBlogPost(Request $request,$slug)
    {
       
        // $blog = Blog::where('slug',$slug)->where('is_published',1)->get();
        // $blogs = Blog::where('is_published',1)->paginate(15);
        // $latestblogs = Blog::select('id','slug','title','thumbnail_image')->where('is_published',1)->latest()->take(5)->get();
        $blogOne = Blog::OneBlog($slug)->get()[0];
        // dd($blogOne);
        return view('frontend.blogs.singleblog')->with(compact(['blogOne']));
    }




    // BACKEND FUNCTIONS
    public function listAllBlogs()
    {   
        
        return view('backend.blogs.listblogs');
    }

    public function getBlogs(Request $request)
    {   

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Blog::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Blog::select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Blog::orderBy($columnName,$columnSortOrder)
            ->where('blogs.title', 'like', '%' .$searchValue . '%')
            ->select('blogs.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $slug = $record->slug;
            $title = $record->title;
            $short_description = $record->short_description;
            $thumbnail_image = $record->thumbnail_image;
            $ispublished = $record->is_published;
            

            $data_arr[] = array(
                "id" => $id,
                "slug" => $slug,
                "title" => $title,
                "short_description" => $short_description,
                "thumbnail_image" => $thumbnail_image,
                "ispublished" =>$is_active ?? 1
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ); 

        echo json_encode($response);
        exit;

        // datatables ends
        
    }

    public function create()
    {
          $blog_id = mt_rand();

        Session::put('temp_package_id', $blog_id);

        return view('backend.blogs.create')->with(compact('blog_id'));
    }


    
    public function save(Request $request)
    {   


       $slug = $this->generateSlug($request->title);
            // dd($slug);

        // dd($request);
        $isPublised = 0;

         $banner = time().'.'.$request->bannerimage->getClientOriginalName();
            $request->bannerimage->move(public_path('uploads/blogs'), $banner);
            $bannerurl = asset('uploads/blogs/'.$banner );
        
         $thumbnail = time().'.'.$request->thumbnail->getClientOriginalName();
            $request->thumbnail->move(public_path('uploads/blogs'), $thumbnail);
            $thumbnailurl = asset('uploads/blogs/'.$thumbnail );

            
            $blog = Blog::create([
             
            'title' => $request->title,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' =>$request->description,
            'banner_image' => $bannerurl,
            'thumbnail_image' => $thumbnailurl,
             'author_id' => 1,
             'is_published' => $request->ispublished
            ]);

             Session::flash('success', 'Succesfully created');
            return redirect()->route('list_all_blogs');

    }

    public function edit(Request $request, $id)
    {
        $blog =  Blog::findOrFail($id);
        return view('backend.blogs.edit')->with(compact('blog'));
    }

    public function update(Request $request)

    {

         $slug = $this->generateSlug($request->title);

        $blog = Blog::findorFail($request->id);

        $bannerurl = $blog->banner_image;

        $thumbnailurl = $blog->thumbnail_image;

      

        $url = asset('uploads/blogs/');

        $bannerimage = trim( str_replace($url.'/', '',$blog->banner_image));

        $thumbnailimage =  trim( str_replace($url.'/', '',$blog->thumbnail_image));

        $bannerpath = public_path('uploads/blogs/'.$bannerimage);

        $thumbnailpath = public_path('uploads/blogs/'.$thumbnailimage);        

        if( isset($request->bannerimage))
        {   

            if( file_exists($bannerpath)){

             unlink($bannerpath);
        }


            $banner = time().'.'.$request->bannerimage->getClientOriginalName();
            $request->bannerimage->move(public_path('uploads/blogs'), $banner);
            $bannerurl = asset('uploads/blogs/'.$banner );
        }

        

        if( isset($request->thumbnail))
        {   
            if( file_exists($thumbnailpath)){

             unlink($thumbnailpath);
        }


             $thumbnail = time().'.'.$request->thumbnail->getClientOriginalName();
            $request->thumbnail->move(public_path('uploads/blogs'), $thumbnail);
            $thumbnailurl = asset('uploads/blogs/'.$thumbnail );
        }

      
        
        

        
        $blog->title = $request->title;
        $blog->slug = $slug;
        $blog->short_description= $request->short_description;
        $blog->description = $request->description;
        $blog->banner_image = $bannerurl;
        $blog->thumbnail_image  = $thumbnailurl;
        $blog->is_published = $request->ispublished;

        $blog->save();

        Session::flash('success', 'Succesfully updated');
        return back();
    }

    public function deleteBlog(Request $request , $id)
    {
        Blog::findOrFail($id)->delete();
        Session::flash('success', 'Succesfully Deleted');

        return redirect()->route('list_all_blogs');
    }

    public function generateSlug($title){
        $slug = Str::slug($title);
        return $slug;
    }
}
