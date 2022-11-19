<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'walletAddress',
        'profileImage',
        'bannerImage',
        'bankName1',
        'accountNumber1',
        'accountName1',
        'bankName2',
        'accountNumber2',
        'accountName2',
        'bankName3',
        'accountNumber3',
        'accountName3',
        'twitterURL'
    ];
}
