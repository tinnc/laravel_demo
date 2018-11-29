<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Models\Role;
use Hash;
use Helper;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('name', 'like', '%'.$request->input('name').'%')->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::getRolesForDropdown();

        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->hasFile('image_user')) {
            if ($request->file('image_user')->isValid()) {
                $file = $request->file('image_user');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('images/user_image/' . $filename));
            }
        }

        $userData = $request->input();
        $userData['password'] = Hash::make($userData['password']);
        $userData['image'] = isset($filename) ? $filename : '';
        User::create($userData);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_user_id = \Auth::user()->id;

        if ($current_user_id == $id) {
            $user = User::findOrFail($id);
            return view('admin.user.edit', [
                'user' => $user,
                'area_code' => Helper::getAreaCode()
            ]);
        } else {
            return redirect()->route('user.index')->with('alert', 'Access was denied !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('image_user')) {
            if ($request->file('image_user')->isValid()) {
                \File::delete("images/user_image/$user->image");
                $file = $request->file('image_user');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('images/user_image/' . $filename));
            }
        } else {
            $filename = $user->image;
        }

        if (isset($user)) {
            $user->name = $request->input('name');
            $user->gender = $request->input('gender');
            $user->email = $request->input('email');
            $user->birthday = $request->input('birthday');
            $user->phone_number = $request->input('phone.area_code') . '-' . $request->input('phone.phone_number');
            $user->image = $filename;
            $user->updated_at = date('Y-m-d');
            $user->save();
        }

        return view('admin.user.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $current_user_id = \Auth::user()->id;

        if ($current_user_id == $id) {
            return redirect()->route('user.index')->with('alert', 'You do not have permission to delete !');
        }

        $user = User::findOrFail($id) ;

        if (isset($user->image) && strcmp($user->image,'no_img.jpg') != 0) {
            \File::delete('images/user_image/' . $user->image);
        }

        User::destroy($id);

        return redirect()->route('user.index');

    }

    public function ajaxEdit($id)
    {
        $current_user_id = \Auth::user()->id;

        if ($current_user_id == $id) {
            $user = User::findOrFail($id);

            return response($user->toJson(), 200)->header('Content-Type', 'text/plain');
        }
        else {
            return response()
                ->view('Bad Request ', null , 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function ajaxUpdate(Request $request, $id)
    {
        $current_user_id = \Auth::user()->id;

        if ($current_user_id == $id) {
            $user = User::findOrFail($id);
            $user->status = $request->get('status_update_user');
            $user->updated_at = date('Y-m-d');
            $user->save();

            return response($user->toJson(), 200)->header('Content-Type', 'text/plain');
        }
        else {
            return response()
                ->view('Bad Request ', null , 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function testSendMail(Request $request)
    {
        // echo '<pre>', print_r($request->all()), '</pre>';
        // Mail::send('admin.mail_demo.test_text',
        //     array(
        //         'name' => 'tin nguyen',
        //         'email' => 'tinnguyen246357@gmail.com',
        //         'user_message' => 'test test send'
        //     ), function($message)
        //     {
        //         $message->from('tinnguyen246357@gmail.com');
        //         $message->to('tinnguyen246357@gmail.com', 'Admin')->subject('mail liên hệ');
        //     });
        Mail::to('tinnguyen246357@gmail.com')->send(new OrderShipped());
        // echo 'done';
        return;
        return redirect()->route('user.index');
    }

    public function testViewSendMail()
    {
        echo "<pre>";
        print_r(config('mail'));
        echo "</pre>";
        // echo 'abc';
        return view('admin.mail_demo.form');
    }
}
