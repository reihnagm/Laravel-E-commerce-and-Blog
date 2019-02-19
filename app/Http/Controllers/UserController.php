<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use File;
use Storage;
use Toastr;
use Cart;
use Validator;
use Carbon;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ChangeEmailAndPasswordRequest;

use App\Models\User;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\BlogComment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Like;

class UserController extends Controller
{
    public function profile($id = null)
    {
        if ($id == null) {
            if (auth()->check()) {
                $user = User::where('slug', auth()->user()->slug)->with(['blogs.user', 'products.user'])->first();
            }
        } else {
            $user = User::where('slug', $id)->first();
        }

        $blog = $user->blogs()->with(['user','tags','comments.user'])->latest()->limit(1)->first();

        $blogs = $user->blogs()->with(['user','tags','comments.user'])->paginate(3, ['*'], 'blog-page');

        $products = $user->products()->with(['user','category'])->paginate(3, ['*'], 'product-page');

        if ($blog) {
            $comments = $blog->comments()->with(['user','likes','unlikes'])->paginate(6, ['*'], 'comment-page');
        } else {
            $comments = null;
        }

        return view('user/profile', ['user' => $user, 'blog' => $blog, 'blogs' => $blogs, 'comments' => $comments, 'products' => $products]);
    }

    public function changeUserAvatar(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user_img = User::findOrFail($id);

        $oldImg = public_path("storage/{$user_img->avatar}");

        // REMOVED FILE EXISTS WHEN DELETE ACTION
        // AND GETTING NEW FILE IMAGE
        if (File::exists($oldImg)) {
            unlink($oldImg);
        }

        // COPY FROM VOYAGER UPLOAD IMAGE
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;

        $file = $request->avatar;

        $path =  '/'.date('F').date('Y').'/';

        $filename = basename(str_random());

        $fullPath = 'users'.$path.$filename.'.'.$file->getClientOriginalExtension();

        $image = Image::make($file)->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode($file->getClientOriginalExtension(), 75);

        Storage::disk('public')->put($fullPath, (string) $image, 'public');

        $fullFilename = $fullPath;

        // BLOB TO FILE
        // $exploded = explode(',', $request->avatar);
        //
        // $decoded = base64_decode($exploded[1]);
        //
        // if (str_contains($exploded[0], 'jpeg')) {
        //     $extension = "jpg";
        // } else {
        //     $extension = "png";
        // }
        //
        // $date =  '/'.date('F').date('Y');
        //
        // $filename = str_random().'.'.$extension;
        //
        // Storage::makeDirectory('public/users'.$date);
        //
        // $path = public_path("storage/users".$date.'/'.$filename);
        //
        // file_put_contents($path, $decoded);

        $user->update([
          "avatar" => $fullFilename
        ]);

        return json_encode([
            "message" => "Successfully Changed Avatar!"
        ]);
    }

    public function changeUserName(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
        "name" => $request->name
      ]);

        return json_encode([
        "message" => "Successfully Change a Name!"
      ]);
    }

    public function viewSetting()
    {
        return view('user.setting');
    }

    public function changeEmailAndPassword(ChangeEmailAndPasswordRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if (trim(isset($request->password)) == "") {
            $data = $user->password;
        } else {
            $data = Hash::make($request->password);
        }

        $user->update([
          "email" => $request->email,
          "password"=> $data
        ]);

        $user->setRememberToken(Str::random(60));

        Toastr::info('Successfully Changed Settings!');

        return back();
    }
}
