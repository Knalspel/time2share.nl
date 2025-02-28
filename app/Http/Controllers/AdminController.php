<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->blocked = true;
        $user->save();

        return redirect()->back();
    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->blocked = false;
        $user->save();

        return redirect()->back();
    }
}
