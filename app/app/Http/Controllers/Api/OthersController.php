<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Password;
use App\User;
use App\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OthersController extends Controller
{
    public function readNotifications(){
        $user=User::find(Auth::id());

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 1, 'message' => 'Notifications read successfully']);
    }

    public function password(Request $request){
        $input=$request->all();
        $rules = array(
            'reason' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $input['user_id']=Auth::id();

        Password::create($input);


        return response()->json(['status' => 1, 'message' => 'Reason logged successfully']);
    }

    public function uploadprofile(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'image' => 'required',
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user = User::findOrFail(Auth::user()->id);

        if($input['image']) {
            $filename = time() . '_' . Auth::user()->username . '.jpg';
            $location = 'assets/images/user/' . $filename;
            $in['image'] = $location;

            $file_data = $input['image'];
            //generating unique file name;
            @list($type, $file_data) = explode(';', $file_data);
            @list(, $file_data) = explode(',', $file_data);
            if ($file_data != "") {
                // storing image in storage/app/public Folder
//                \Storage::disk('public')->put($file_name, base64_decode($file_data));
                \File::put(storage_path(). '../' . $location, base64_decode($file_data));

                //Storage::put('/' . $file_name, $file_data, 'public');
            }
        }


        $user->fill($in)->save();

        return response()->json(['status' => 1, 'message' => 'Profile Picture submitted successfully', 'image' => $user->image]);
    }

}
