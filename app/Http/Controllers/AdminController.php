<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function destroyUser(User $user)
    {
        if (!Auth::user() || !Auth::user()->admin) {
            return redirect()->route('admin.panel')->with('error', 'Unauthorized action.');
        }

        if (Auth::id() === $user->id) {
            return back();
        }

        $user->delete();

        return back();
    }
}
