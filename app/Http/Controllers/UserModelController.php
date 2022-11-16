<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserModelStoreRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserModelController extends Controller
{
    public function index()
    {
        // All Product
        $user = UserModel::all();

        // Return Json Response
        return response()->json([
            'User' => $user
        ], 200);
    }

    public function store(UserModelStoreRequest $request)
    {
        try {
            $profileImageName = null;
            $bannerImageName = null;
            if ($request->hasFile('profileImage')) {
                $profileImageName = Str::random(32) . "." . $request->profileImage->getClientOriginalExtension();
            }
            if ($request->hasFile('bannerImage')) {
                $bannerImageName = Str::random(32) . "." . $request->bannerImage->getClientOriginalExtension();
            }


            // Create =UserModle
            UserModel::create([
                'username' => $request->name,
                'email' => $request->email,
                'walletAddress' => $request->walletAddress,
                'profileImage' => $profileImageName,
                'bannerImage' => $bannerImageName,
                'description' => $request->description
            ]);
            // Save Image in Storage folder
            if ($profileImageName != null) {
                Storage::disk('public')->put($profileImageName, file_get_contents($request->profileImage));
            }
            if ($bannerImageName != null) {
                Storage::disk('public')->put($bannerImageName, file_get_contents($request->bannerImage));
            }


            // Return Json Response
            return response()->json([
                'message' => "User Created chief"
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Victor! Something has Gone Wrong Fam"
            ], 500);
        }
    }

    public function show($id)
    {
        // Product Detail
        $user = UserModel::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404);
        }

        // Return Json Response
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string',
            'walletAddress' => 'required|string',
            'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            // Find product
            $user = UserModel::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User Not Found.'
                ], 404);
            }

            $user->username = $request->username;
            $user->email = $request->email;

            if ($request->profileImage) {
                // Public storage
                $storage = Storage::disk('public');

                // Old iamge delete
                if ($storage->exists($user->profileImage)) {
                    $storage->delete($user->profileImage);
                }

                // Image name
                $profileImageName = Str::random(32) . "." . $request->profileImage->getClientOriginalExtension();
                $user->profileImage = $profileImageName;

                // Image save in public folder
                $storage->put($profileImageName, file_get_contents($request->profileImage));
            }

            if ($request->bannerImage) {
                // Public storage
                $storage = Storage::disk('public');

                // Old iamge delete
                if ($storage->exists($user->bannerImage)) {
                    $storage->delete($user->bannerImage);
                }
                // Image name
                $bannerImageName = Str::random(32) . "." . $request->bannerImage->getClientOriginalExtension();
                $user->bannerImage = $bannerImageName;

                // Image save in public folder
                $storage->put($bannerImageName, file_get_contents($request->bannerImage));
            }

            // Update Product
            $user->save();

            // Return Json Response
            return response()->json([
                'message' => "User successfully updated."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function destroy($id)
    {
        // Detail
        $user = UserModel::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404);
        }

        // Public storage
        $storage = Storage::disk('public');

        // Iamge delete
        if ($storage->exists($user->profileImage)) {
            $storage->delete($user->profileImage);
        }
        if ($storage->exists($user->bannerImage)) {
            $storage->delete($user->bannerImage);
        }

        // Delete Product
        $user->delete();

        // Return Json Response
        return response()->json([
            'message' => "User successfully deleted."
        ], 200);
    }
}
