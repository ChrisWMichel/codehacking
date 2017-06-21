<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();

      return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $category = Category::pluck('name', 'id')->all();

      return view('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
      $user = Auth::user();

      $input = $request->all();

      if($file = $request->file('photo_id')){

        $name = $file->getClientOriginalName();


        $file->move('images', $name); // public/image folder
        //$name = 'posts/' . $name;

        $photo = Photo::create(['path' => $name]); // put the image path in the photo DB

        $input['photo_id'] = $photo->id; // put the photo id in the Users table

      }

      // This works.
      /*$input['user_id'] = $user->id;
      Post::create($input);*/

      $user->posts()->create($input);

      return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::findOrFail($id);
        $category = Category::pluck('name', 'id')->all();

      return view('admin.posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {
      $post = Post::find($id); // need this for photo id

      $input = $request->all();
      $oldPhotoId = $post->photo_id;

      if($request->hasFile('photo_id')){
        $file = $request->file('photo_id');

        $name = $file->getClientOriginalName();
        //$name = 'posts/' . $name;

        $file->move('images', $name);

        $photo = Photo::create(['path' => $name]); // put the image path in the photo DB

        $input['photo_id'] = $photo->id; // put the photo id in the Users table
      }


      // check to see if an image already exist. If it does, delete it from file and DB table.
      if($oldPhotoId >= 1) {

        $oldPhoto = Photo::findOrFail($oldPhotoId);
        $oldPath = $oldPhoto->path;

        // check if current photo matches old photo, if not delete the old photo and image.
        if ($oldPath == $post->photo->path) {

          // Delete the old image file.
          if (file_exists($filename = public_path() . $oldPath)) {
            unlink($filename);
          }

          // Delete the record in the Photos table
          $oldPhoto->delete();

        }
      }

      //$post->update($input);
      Auth::user()->posts()->whereId($id)->first()->update($input);

      flash('Post has been updated.')->success();

      return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);
      $oldPhotoId = $post->photo_id;

      // check to see if an image already exist. If it does, delete it from file and DB table.
      if($oldPhotoId >= 1) {

        $oldPhoto = Photo::findOrFail($oldPhotoId);

        $oldPath = $oldPhoto->path;

        // check if current photo matches old photo, if not delete the old photo and image.
        if ($oldPath == $post->photo->path) {

          // Delete the old image file.
          if (file_exists($filename = public_path() . $oldPath)) {
            unlink($filename);
          }

          // Delete the record in the Photos table
          $oldPhoto->delete();

        }
      }

      $post->delete();

      //Session::flash('deleted_user', 'The user has been deleted.');
      //flash('The user has been deleted.');
      flash('The post has been deleted.')->success();


      return redirect('/admin/posts');
    }

}
/*echo '<pre>';
print_r($name);
echo '</pre>';*/