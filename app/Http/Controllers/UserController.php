<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


    public function home()
    {
        $products =Product::paginate(8);
        $categories=Category::get();
        return view('client.home',['products'=>$products,'categories'=>$categories]);
    }

    public function shop()
    {
        $products =Product::paginate(8);
        $categories=Category::get();
        return view('client.shop',['products'=>$products,'categories'=>$categories]);
    }

    public function register()
    {
        return view('client.register');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|',
            'email'=>'required|email|max:100|unique:users,email',
            'address'=>'required|string',
            'password'=>'required|max:5',
            'phone'=>'required|numeric',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
        ]);
        Session::put('user',$request->all());
        return redirect(route('credit-card'));

    }
    public function login_client(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:App\User,email',
            'password'=>'required'
        ]);
        $user=User::where('email','=',$request->email)->first();
        if($user->status==1) {
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->role == "admin")
                    return redirect(route('admin_index'));
                elseif (Auth::user()->role == "user")
                    return redirect(route('Track'));
            } else {
                return redirect(route('home'))->withErrors([
                    'error_key' => "Password isn't match Email"
                ]);
            }
        }
        else
            return redirect(route('Login_auth'))->withErrors(['error_key' => "YOUR ACCOUNT IS DEACTIVATE !!! "]);
    }
    public function client_logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
//// role=admin
    public function index_admin()
    {
        return view('admin.index');
    }
    public function index()
    {
        $users=User::where('role','=','user')->get();
        return view('admin.users.index',['users'=>$users]);
    }
    public function edit($id)
    {
        $user=User::find($id);
        return view('admin.users.update',[
            'user'=>$user]);
    }
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $request->validate([
            'name'=>'string',
            'phone'=>'numeric',
            'email'=>'email|exists:users',
            'address'=>'string',
        ]);
        $user->fill($request->all())->save();
        return response()->json([
            'success'=>"Successfully Update Client "
        ]);
    }
    public function destroy($id)
    {
        $user=User::find($id);
        foreach ($user->orders as $order)
            $order->delete();
        $user->delete();
        return response()->json([
            'success'=>"Successfully Deleted"
        ]);
    }
    public function test()
    {
        $user=User::where('email','=','karima.muhammd@gmail.com')->first();

        if($user->role=='user') {
            dd(Auth::attempt(['email'=>$user->email,'password'=>$user->id]));
        }
//        $user->delete();

    }
    public function Track()
    {
        return view('client.track');
    }
    public function login()
    {
        return view('admin.login');
    }
    public function do_login(Request $request)
    {
        $request->validate([
            'email'=>'required|email|max:100|exists:App\User,email',
            'password'=>'required|min:6'
        ]);
        Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            return redirect(route('admin_index'));
        else
        {
            return redirect(route('login'))->withErrors([
                'error_key' => "Password isn't match Email"
            ]);
        }
    }
    public function Logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }


}
