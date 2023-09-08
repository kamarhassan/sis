<?php

namespace  Modules\Cms\Http\Controllers\Admin;


use App\Traits\ImageStore;
use Illuminate\Http\Request;
use Modules\Cms\Traits\Image;
// use Brian2694\Toastr\Facades\Toastr;
use App\Jobs\BlogNotification;
use Modules\Cms\Entities\Blog;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\Entities\BlogCategory;
use Modules\Cms\Http\Requests\Blog\InsertEditBlogRequest;

// use Modules\Org\Entities\OrgBlogBranch;
// use Modules\Org\Entities\OrgBlogPosition;
// use Modules\Org\Entities\OrgBranch;
// use Modules\Org\Entities\OrgPosition;


class BlogController extends Controller
{
   // use ImageStore;
   use Image;
   public function index(Request $request)
   {
      try {


         $blogs = Blog::with('blogcategory')->get();

  


         // return view('cms::admin.blog.index');
         return view('cms::admin.blog.index', compact('blogs'));
      } catch (\Throwable $e) {
         throw $e;

         GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
      }
   }

   public function create()
   {
      $user = Auth::user();
      $blogcategory = BlogCategory::where('status', 1)->get();

      //   if (isModuleActive('Org')) {
      //       $data['codes'] = [];
      //       $data['position_ids'] = [];
      //   }
      return view('cms::admin.blog.create-edit',  compact('blogcategory'));
   }

   public function store(InsertEditBlogRequest $request)
   {

// dd($request);

      try {
     
     
         $blog = new Blog;
         $blog->title = $request->title;
         $blog->description = $request->description;
         $blog->slug = $request->slug;
         $blog->category_id = $request->category;
         $blog->tags = $request->tags;
         $blog->user_id = Auth::id();

         if ($request->has('global_image')) {
            $thumbnail = $this->saveImage($request->global_image, 'public/files/blogs/' . $request->title);
            $blog->thumbnail =    $thumbnail;
         }
         
         if ($request->has('callery')) {
            $callery = $this->saveMultiImage($request->callery, 'public/files/blogs/' . $request->title . '/callery');
            $blog->image =  $callery;
         }
         $is_saved =  $blog->save();
         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('cms.blogs.index');
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }
         return response()->json(['status' =>   $status, 'message' =>   $message, 'route' =>  $route]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }


   public function edit($id)
   {


      $blog = Blog::find($id);
      $blogcategory = BlogCategory::where('status', 1)->get();
      if (!$blog) {
         toastr()->error(__('site.this post is not defined'));
         return redirect()->route('cms.blogs.index');
      } else {

         return view('cms::admin.blog.create-edit', compact('blog', 'blogcategory'));
      }
   }

   public function update(Request $request)
   {

      try {


         $blog = Blog::find($request->id);

         $blog->title = $request->title;
         $blog->description = $request->description;
         $blog->slug = $request->slug;
         $blog->category_id = $request->category;
         $blog->tags = $request->tags;
         $blog->user_id = Auth::id();

         if ($request->has('global_image')) {
            if ($blog->thumbnail != null)
               $this->removeImagefromfolder($blog->thumbnail);
            $thumbnail = $this->saveImage($request->global_image, 'public/files/blogs/' . $request->title);
            $blog->thumbnail =    $thumbnail;
         }
         if (!$request->has('status')) {
            $blog->status = 0;
         } else {
            $blog->status = 1;
         }

         if ($request->has('callery')) {
            $callery = $this->saveMultiImage($request->callery, 'public/files/blogs/' . $request->title);
            $blog->image =  $callery;
         }


         $is_saved =  $blog->save();
         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('cms.blogs.index');
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }
         return response()->json(['status' =>   $status, 'message' =>   $message, 'route' =>  $route]);
      } catch (\Exception $e) {
         GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
      }
   }

   public function saveOrgBlogBranch($blog, $branches): void
   {
      if ($blog->audience != 1) {
         if (!empty($branches)) {
            foreach ($branches as $key => $branch) {

               $orgBranch = OrgBranch::with('childs')->find($branch);
               if ($orgBranch) {
                  $ids = $orgBranch->getIds($orgBranch, [$orgBranch->id]);
                  foreach ($ids as $id) {
                     $data = [
                        'blog_id' => $blog->id,
                        'branch_id' => $id
                     ];
                     OrgBlogBranch::updateOrCreate(
                        $data
                     );
                  }
               }
            }
         }
      }
   }

   public function saveOrgBlogPosition($blog, $positions): void
   {
      if ($blog->position_audience != 1) {
         if (!empty($positions)) {
            foreach ($positions as $key => $position) {
               if ($position == 1) {
                  $branch = new OrgBlogPosition();
                  $branch->blog_id = $blog->id;
                  $branch->position_id = $key;
                  $branch->save();
               }
            }
         }
      }
   }


   public function destroy(Request $request)
   {



      try {
         $blog = Blog::findOrFail($request->id);
         if ($blog) {

            $folder =   $blog->title;

            $deleted = $blog->delete();
            if (is_dir('public/files/blogs/'.$folder)) {
               $this->removeFolder('public/files/blogs/'.$folder);
            }

            if ($deleted) {
               $messege = __('site.deleted');
               $status = 'success';
            } else {
               $messege = __('site.deleted');
               $status = 'error';
            }
         }else{
            $messege = __('site.you have error');
            $status = 'error';
         }

         return response()->json([
            'messege' => $messege,
            'status' => $status,
         ]);
      } catch (\Throwable $e) {
         throw $e;
         // GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
      }
   }


   public function sendNotification($blog_id)
   {
      BlogNotification::dispatch($blog_id);
   }
}
