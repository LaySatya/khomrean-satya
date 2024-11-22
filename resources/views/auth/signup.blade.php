@extends('layouts.app')

@section('layouts')
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="bg-white rounded-xl shadow-2xl p-8 max-w-md w-full animate-fade-in">
            <h2 class="text-2xl font-bold text-center text-indigo-800 mb-8">Create an Account</h2>
            <form id="registrationForm" action="/signup" method="POST" class="space-y-6" novalidate>
                @csrf
                <div>
                    <label for="username" class="block text-indigo-900 font-semibold mb-1">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-800 transition-all duration-300" 
                        placeholder="Enter your username" 
                        name="name"
                        value="{{ old('name') }}"
                    >
                    @error('name')            
                        <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                    @enderror

                </div>
        
                <div>
                    <label for="email" class="block text-indigo-900 font-semibold mb-1">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-800 transition-all duration-300" 
                        placeholder="Enter your email" 
                        name="email"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1" id="emailError">{{ $message }}</p>
                    @enderror
                </div>
        
                <div>
                    <label for="password" class="block text-indigo-900 font-semibold mb-1">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-800 transition-all duration-300" 
                        placeholder="Enter your password" 
                        name="password"
                        {{ old('password') }}
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1" id="passwordError">{{ $message }}</p>
                    @enderror
                </div>
        
                <div>
                    <label for="confirm-password" class="block text-indigo-900 font-semibold mb-1">Confirm Password</label>
                    <input 
                        type="password" 
                        id="confirm-password" 
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-800 transition-all duration-300" 
                        placeholder="Confirm your password" 
                        name="password_confirmation"
                        {{ old('password_confirmation') }}
                    >
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1" id="confirmPasswordError">{{ $message }}</p>
                    @enderror
                    </div>
        
                <button 
                    type="submit" 
                    class="w-full bg-indigo-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:ring-offset-2 transition-all duration-300 transform hover:scale-[1.02]"
                >
                    Register
                </button>
            </form>
        
            <p class="text-center text-gray-600 mt-6">
                Already have an account? 
                <a href="/login" class="text-indigo-800 font-semibold hover:text-blue-900 transition-colors duration-300">Sign In</a>
            </p>
        </div>
    </div> 
@endsection