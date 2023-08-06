<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function __construct()
    {
        $this->middleware('throttle:5,10')->only('customLogin');
    }

    public function customLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        throw ValidationException::withMessages([
            'email' => 'These credentials do not match our records.',
        ])->status(422);
    }
    
    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => $data['role']
      ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.welcome');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

    public function showChangePasswordForm()
    {
        $user = Auth::user();
        return view('auth.change_password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $user = User::find(auth()->id()); // atau cara lain untuk mendapatkan user yang sesuai

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'The current password field is required.',
            'new_password.required' => 'The new password field is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');

        // Periksa apakah current_password sesuai dengan password yang ada di database
        if (!Hash::check($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        // Panggil method updatePassword pada model User untuk mengganti password
        $user->updatePassword($newPassword);

        // Berikan pesan sukses atau lakukan tindakan lainnya sesuai kebutuhan
        return redirect()->route('user.change-password')->with('success', 'Password berhasil diubah.');
    }


}