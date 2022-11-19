<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserModelStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            // return [
            //     'username' => 'required|string|max:258',
            //     'email' => 'required|string|max:258',
            //     'walletAddress' => 'required|string|unique:user_models,walletAddress',
            //     'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //     'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ];
            return [
                'username' => 'required|string|max:258',
                'email' => 'required|string|max:258',
                'walletAddress' => 'required|string|unique:user_models,walletAddress',
                'profileImage' => 'required|string|max:258',
                'bannerImage' => 'required|string|max:258',

            ];
        } else {
            // return [
            //     'username' => 'required|string|max:258',
            //     'email' => 'required|string|max:258',
            //     'walletAddress' => 'required|string|unique:user_models,walletAddress',
            //     'profileImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //     'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ];

            return [
                'username' => 'required|string|max:258',
                'email' => 'required|string|max:258',
                'walletAddress' => 'required|string|unique:user_models,walletAddress',
                'profileImage' => 'required|string|max:258',
                'bannerImage' => 'required|string|max:258',
            ];
        }
    }

    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'username.required' => 'UserName is required!',
                'email.required' => 'Email is required!',
                'walletAddress.required' => 'Wallet Address is required!'
            ];
        } else {
            return [
                'username.required' => 'UserName is required!',
                'email.required' => 'Email is required!',
                'walletAddress.required' => 'Wallet Address is required!'
            ];
        }
    }
}
