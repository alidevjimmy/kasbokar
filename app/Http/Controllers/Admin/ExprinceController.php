<?php

namespace App\Http\Controllers\Admin;

use App\Expriece;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ExprinceController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $exps = Expriece::where('user_id' , $user->id)->withTrashed()->get();
        return view('admin.pages.exps.index' , ['exps' => $exps]);
    }
    public function destroy($id)
    {
        $exp = Expriece::withTrashed()->findOrFail($id);
        if (!$exp->deleted_at) {
            $exp->delete();
            return back()->with([
                'status' => 'success',
                'message' => 'تجربه غیر فعال شد'
            ]);
        }
        $exp->restore();
        return back()->with([
            'status' => 'success',
            'message' => 'تجربه فعال شد'
        ]);
    }
}
