<?php

namespace App\Http\Controllers\Admin;

use App\Fav;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class FavController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $favs = Fav::where('user_id' , $user->id)->withTrashed()->get();
        return view('admin.pages.favs.index' , ['favs' => $favs]);
    }
    public function destroy($id)
    {
        $fav = Fav::withTrashed()->findOrFail($id);
        if (!$fav->deleted_at) {
            $fav->delete();
            return back()->with([
                'status' => 'success',
                'message' => 'علاقه مندی غیر فعال شد'
            ]);
        }
        $fav->restore();
        return back()->with([
            'status' => 'success',
            'message' => 'علاقه مندی فعال شد'
        ]);
    }
}
