@extends('layouts.app')

@section('layouts')
    <a href="/" class="btn btn-primary absolute m-5">
        Back
    </a>
    <div class="w-screen h-screen flex justify-center items-center overflow-hidden">
        <div class="bg-white rounded-xl shadow-2xl p-8 max-w-md w-full animate-fade-in">
            <h2 class="text-2xl font-bold text-center text-indigo-800 mb-8">Login</h2>
            {{-- // alert message  --}}
            {{-- @if ($errors->any())
                <div class="text-red-500 text-sm mt-2">    
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
        
            <form id="registrationForm" method="POST" action="/login" class="space-y-6" novalidate>
                @csrf
                <div>
                    <label for="email" class="block text-indigo-900 font-semibold mb-2">Email</label>
                    <input 
                        type="text" 
                        id="email" 
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-800 transition-all duration-300" 
                        placeholder="Enter your email" 
                        name="email"
                        value="{{ old('email') }}"
                    >
                    @error('email')            
                        <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                    @enderror
                </div>
        
                <div>
                    <label for="password" class="block text-indigo-900 font-semibold mb-2">Password</label>
                    <input 
                        type="text" 
                        id="password" 
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-800 transition-all duration-300" 
                        placeholder="Enter your password" 
                        name="password"
                        value="{{ old('password') }}"
                    >
                    
                    @error('password')            
                        <p class="text-red-500 text-sm mt-1" id="usernameError">{{ $message }}</p>
                    @enderror
                </div>
        
                
        
                <button 
                    type="submit" 
                    class="w-full bg-indigo-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:ring-offset-2 transition-all duration-300 transform hover:scale-[1.02]"
                >
                    Login
                </button>
            </form>
            {{-- <p class="text-center text-gray-600 mt-6">
                don't have an account? 
                <a href="/signup" class="text-indigo-800 font-semibold hover:text-blue-900 transition-colors duration-300">Signup</a>
            </p> --}}
        </div>

    </div>
@endsection