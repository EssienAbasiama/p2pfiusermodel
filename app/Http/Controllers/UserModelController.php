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
            // $profileImageName = '';
            // $bannerImageName = '';

            // if ($request->hasFile('profileImage')) {
            //     $profileImageName = Str::random(32) . "." . $request->profileImage->getClientOriginalExtension();
            // }
            // if ($request->hasFile('bannerImage')) {
            //     $bannerImageName =  Str::random(32) . "." . $request->bannerImage->getClientOriginalExtension();
            // }
            // return $profileImageName;
            // Create =UserModle

            UserModel::create([
                'username' => $request->username,
                'email' => $request->email,
                'walletAddress' => $request->walletAddress,
                'profileImage' => $request->profileImage,
                'bannerImage' => $request->bannerImage,
                'bankName1' => $request->bankName1,
                 'accountNumber1' => $request->accountNumber1,
                 'accountName1' => $request->accountName1,
                 'bankName2' => $request->bankName2,
                 'accountNumber2' => $request->accountNumber2,
                 'accountName2' => $request->accountName2,
                 'bankName3' => $request->bankName3,
                 'accountNumber3' => $request->accountNumber3,
                 'accountName3' => $request->accountName3,
                 'twitterURL' => $request->twitterURL
                // 'bankName1' => '',
                // 'accountNumber1' => '',
                // 'accountName1' => '',
                // 'bankName2' => '',
                // 'accountNumber2' => '',
                // 'accountName2' => '',
                // 'bankName3' => '',
                // 'accountNumber3' => '',
                // 'accountName3' => '',
                // 'twitterURL' => ''
            ]);

            // Save Image in Storage folder
            // if ($profileImageName !== '') {
            //     Storage::disk('public')->put($profileImageName, file_get_contents($request->profileImage));
            // }
            // if ($bannerImageName !== '') {
            //     Storage::disk('public')->put($bannerImageName, file_get_contents($request->bannerImage));
            // }

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

        return 'success';
    }

    public function show($walletAddress)
    {
        // Product Detail
        $user = UserModel::find($walletAddress);
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
        // $request->validate([
        //     'username' => 'required|string',
        //     'email' => 'required|string',
        //     'walletAddress' => 'required|string',
        //     'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string',
            'walletAddress' => 'required|string',
            'profileImage' => 'required|string',
            'bannerImage' => 'required|string',
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
            $user->profileImage = $request->profileImage;
            $user->bannerImage = $request->bannerImage;
            $user->bankName1 = $request->bankName1;
            $user->accountNumber1 = $request->accountNumber1;
            $user->accountName1 = $request->accountName1;
            $user->bankName2 = $request->bankName2;
            $user->accountNumber2 = $request->accountNumber2;
            $user->accountName2 = $request->accountName2;
            $user->bankName3 = $request->bankName3;
            $user->accountNumber3 = $request->accountNumber3;
            $user->accountName3 = $request->accountName3;
            $user->twitterURL = $request->twitterURL;

            // if ($request->profileImage) {
            //     // Public storage
            //     $storage = Storage::disk('public');

            //     // Old iamge delete
            //     if ($storage->exists($user->profileImage)) {
            //         $storage->delete($user->profileImage);
            //     }

            //     // Image name
            //     $profileImageName = Str::random(32) . "." . $request->profileImage->getClientOriginalExtension();
            //     $user->profileImage = $profileImageName;

            //     // Image save in public folder
            //     $storage->put($profileImageName, file_get_contents($request->profileImage));
            // }

            // if ($request->bannerImage) {
            //     // Public storage
            //     $storage = Storage::disk('public');

            //     // Old iamge delete
            //     if ($storage->exists($user->bannerImage)) {
            //         $storage->delete($user->bannerImage);
            //     }
            //     // Image name
            //     $bannerImageName = Str::random(32) . "." . $request->bannerImage->getClientOriginalExtension();
            //     $user->bannerImage = $bannerImageName;

            //     // Image save in public folder
            //     $storage->put($bannerImageName, file_get_contents($request->bannerImage));
            // }

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

    /**
     * Search for WalletAddress
     *
     * @param  str  $walletAddress
     * @return \Illuminate\Http\Response
     */
    public function search($walletAddress)
    {
        return UserModel::where('walletAddress', 'like', '%'.$walletAddress.'%')->get();
    }
}
