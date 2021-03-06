<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();



      return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
      $input = $request->all();


      if($file = $request->file('photo_id')){

        $name = $file->getClientOriginalName();

        $file->move('images', $name); // public/image folder

        $photo = Photo::create(['path' => $name]); // put the image path in the photo DB

        $input['photo_id'] = $photo->id; // put the photo id in the Users table

      }

      $input['password'] = bcrypt( $request->password);

      User::create($input);

      flash('The user has been created.')->success();

      return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);
      $roles = Role::pluck('name', 'id')->all();

      return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
      $user = User::find($id);
      //$user->update($request->all());

      $input = $request->all();
      $oldPhotoId = $user->photo_id;

      if(trim($request->password) =='') {
        $input = $request->except('password');
      }
      else {
        $this->validate(request(), [
          'password' => 'min:4',
          'password_confirm' => 'required|same:password'
        ]);
        $input['password'] = bcrypt($request->password);
      }

      if($request->hasFile('photo_id')){
          $file = $request->file('photo_id');

          $name = time() . $file->getClientOriginalName();

          $file->move('images', $name);

          $photo = Photo::create(['path' => $name]); // put the image path in the photo DB

          $input['photo_id'] = $photo->id; // put the photo id in the Users table
      }


      $user->update($input);

      // check to see if an image already exist. If it does, delete it from file and DB table.
      if($oldPhotoId >= 1) {

        $oldPhoto = Photo::findOrFail($oldPhotoId);
        $oldPath = $oldPhoto->path;

        // check if current photo matches old photo, if not delete the old photo and image.
        if ($oldPath !== $user->photo->path) {

          // Delete the old image file.
          if (file_exists($filename = public_path() . $oldPath)) {
            unlink($filename);
          }

          // Delete the record in the Photos table
          $oldPhoto->delete();

        }
      }


      flash('The user has been updated.')->success();

      return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $oldPhotoId = $user->photo_id;

      // check to see if an image already exist. If it does, delete it from file and DB table.
      if($oldPhotoId >= 1) {

        $oldPhoto = Photo::findOrFail($oldPhotoId);

        $oldPath = $oldPhoto->path;

        // check if current photo matches old photo, if not delete the old photo and image.
        if ($oldPath == $user->photo->path) {

          // Delete the old image file.
          if (file_exists($filename = public_path() . $oldPath)) {
            unlink($filename);
          }

          // Delete the record in the Photos table
          $oldPhoto->delete();

        }
      }

      $user->delete();

      //Session::flash('deleted_user', 'The user has been deleted.');
      //flash('The user has been deleted.');
      flash('The user has been deleted.')->success();


      return redirect('/admin/users');
    }
}
/*echo '<pre>';
print_r($input);
echo '</pre>';*/