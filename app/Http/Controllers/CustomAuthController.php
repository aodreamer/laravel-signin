<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Check if the user has exceeded the maximum login attempts
        $maxAttempts = 5; // Define your desired maximum attempts
        $lockoutDuration = 10; // Define the lockout duration in minutes
        $key = 'login_attempts:' . $email;

        if (Cache::has($key) && Cache::get($key) >= $maxAttempts) {
            return redirect()->back()->withErrors(['login' => 'Too many login attempts. Try again later.']);
        }

        // Attempt authentication
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Successful login, clear login attempts cache
            Cache::forget($key);

            return redirect()->intended('dashboard')->withSuccess('Signed in');
        } else {
            // Failed login, increment login attempts and set lockout
            Cache::add($key, Cache::get($key, 0) + 1, now()->addMinutes($lockoutDuration));

            return redirect()->back()->withErrors(['login' => 'Login details are not valid']);
        }
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