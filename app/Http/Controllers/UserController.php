<?php 
    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    
    class UserController extends Controller
    {
        // Dashboard method - ensure the user is logged in before showing the dashboard
        public function dashboard()
        {
            if (Auth::check()) {
                $user = Auth::user(); // Get the logged-in user
                // Return the dashboard view with user data
                return view('dashboard')->with('user', $user);
            }
    
            // Redirect to login if the user is not logged in
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }
    
        // Logout method
        public function logout()
        {
            Auth::logout(); // Log out the user
            return redirect()->route('login')->with('success', 'Logged out successfully!');
        }
    
        // Signup method - user registration logic
        public function signup(Request $request)
        {
            // Validate input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string'
            ]);
    
            // Password match check (although Laravel already handles password_confirmation check)
            if ($validatedData['password'] !== $validatedData['password_confirmation']) {
                return redirect()->back()->with('error', 'Passwords do not match.');
            }
    
            // Create the user with a hashed password
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
    
            if ($user) {
                // Automatically log in the user after signup
                Auth::login($user);
                return redirect('/dashboard')->with('success', 'Account created and logged in successfully!');
            }
    
            // If user creation failed, return an error message
            return redirect()->back()->with('error', 'There was an error creating your account. Please try again.');
        }
    
        // Login method - user authentication logic
        public function login(Request $request)
        {
            // Validate input
            $validatedLogin = $request->validate([
                'email' => 'required|string|email|max:255',
                'password' => 'required|string',
            ]);
    
            // Use Auth::attempt to check the user's credentials
            if (Auth::attempt([
                'email' => $validatedLogin['email'],
                'password' => $validatedLogin['password']
            ], $request->has('remember'))) {
                // Successful login, redirect to dashboard
                return redirect('/dashboard')->with('success', 'Logged in successfully!');
            }
    
            // Failed login - redirect back with error
            return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
        }
    }
    
?>