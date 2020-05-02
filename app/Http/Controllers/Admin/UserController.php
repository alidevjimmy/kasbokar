<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->latest()->get();
        return view('admin.pages.users.index' , ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        if (!$user->deleted_at) {
            $user->delete();
            return back()->with([
                'status' => 'success',
                'message' => 'کاربر غیر فعال شد'
            ]);
        }
        $user->restore();
        return back()->with([
            'status' => 'success',
            'message' => 'کاربر فعال شد'
        ]);
    }
}
