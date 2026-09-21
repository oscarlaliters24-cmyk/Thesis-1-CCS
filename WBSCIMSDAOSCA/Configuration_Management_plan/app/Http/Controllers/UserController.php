<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index() { return view('users.index', ['users'=>User::latest()->paginate(15)]); }
    public function create() { return view('users.create'); }
    public function store(Request $request) {
        $data=$request->validate(['name'=>'required|max:150','email'=>'required|email|unique:users,email','password'=>'required|min:8|confirmed','role'=>'required|in:admin,staff']);
        $data['password']=Hash::make($data['password']); User::create($data);
        return redirect()->route('users.index')->with('success','User created.');
    }
    public function destroy(User $user) {
        abort_if($user->id===auth()->id(),422,'You cannot delete your own account.');
        $user->delete(); return back()->with('success','User deleted.');
    }
}
