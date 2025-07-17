@extends('layouts.login-layout')

@section('content')
<div class="login-bg flex items-center justify-center py-8 px-2 min-h-screen">
  <div class="login-card flex flex-col md:flex-row w-full max-w-3xl overflow-hidden">
    <!-- Kiri: Form Register -->
    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
      <div class="mb-6 flex justify-center">
        <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="h-12">
      </div>
      <h2 class="text-2xl font-bold text-center mb-2 text-blue-900">Register Account</h2>
      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1 font-semibold">Name</label>
          <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
            <span class="mr-2 text-gray-400"><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-5 h-5'><path stroke-linecap='round' stroke-linejoin='round' d='M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0v.75a.75.75 0 01-.75.75h-13.5a.75.75 0 01-.75-.75v-.75z' /></svg></span>
            <input type="text" name="name" class="bg-transparent outline-none w-full" placeholder="Enter your name" value="{{ old('name') }}" required autofocus>
          </div>
          @error('name')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
          <label class="block mb-1 font-semibold">E-Mail Address</label>
          <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
            <span class="mr-2 text-gray-400"><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-5 h-5'><path stroke-linecap='round' stroke-linejoin='round' d='M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-.659 1.591l-7.5 7.5a2.25 2.25 0 01-3.182 0l-7.5-7.5A2.25 2.25 0 012.25 6.993V6.75' /></svg></span>
            <input type="email" name="email" class="bg-transparent outline-none w-full" placeholder="Enter your email" value="{{ old('email') }}" required>
          </div>
          @error('email')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
          <label class="block mb-1 font-semibold">Password</label>
          <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
            <span class="mr-2 text-gray-400"><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-5 h-5'><path stroke-linecap='round' stroke-linejoin='round' d='M16.5 10.5V7.125a4.125 4.125 0 10-8.25 0V10.5m12 0a1.5 1.5 0 00-1.5-1.5h-13.5a1.5 1.5 0 00-1.5 1.5v7.125A2.625 2.625 0 004.125 20.25h15.75A2.625 2.625 0 0022.5 17.625V10.5zm-6.75 4.125a.375.375 0 11-.75 0 .375.375 0 01.75 0z' /></svg></span>
            <input type="password" name="password" class="bg-transparent outline-none w-full" placeholder="Enter your password" required>
          </div>
          @error('password')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
          <label class="block mb-1 font-semibold">Confirm Password</label>
          <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
            <span class="mr-2 text-gray-400"><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-5 h-5'><path stroke-linecap='round' stroke-linejoin='round' d='M16.5 10.5V7.125a4.125 4.125 0 10-8.25 0V10.5m12 0a1.5 1.5 0 00-1.5-1.5h-13.5a1.5 1.5 0 00-1.5 1.5v7.125A2.625 2.625 0 004.125 20.25h15.75A2.625 2.625 0 0022.5 17.625V10.5zm-6.75 4.125a.375.375 0 11-.75 0 .375.375 0 01.75 0z' /></svg></span>
            <input type="password" name="password_confirmation" class="bg-transparent outline-none w-full" placeholder="Confirm your password" required>
          </div>
          @error('password_confirmation')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded-lg font-bold hover:bg-blue-800 transition">Register</button>
      </form>
      <div class="mt-4 text-center text-sm">
        Already registered? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">Login here</a>
      </div>
    </div>
    <!-- Kanan: Ilustrasi/Logo -->
    <div class="hidden md:flex w-1/2 bg-blue-50 items-center justify-center">
      <img src="{{ asset('img/msa.png') }}" alt="Ilustrasi" class="w-3/4">
    </div>
  </div>
</div>
@endsection
