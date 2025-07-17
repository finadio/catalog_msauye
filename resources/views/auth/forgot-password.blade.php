@extends('layouts.login-layout')

@section('content')
<div class="login-bg flex items-center justify-center py-8 px-2 min-h-screen">
  <div class="login-card flex flex-col md:flex-row w-full max-w-3xl overflow-hidden">
    <!-- Kiri: Form Forgot Password -->
    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
      <div class="mb-6 flex justify-center">
        <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="h-12">
      </div>
      <h2 class="text-2xl font-bold text-center mb-2 text-blue-900">Forgot Your Password?</h2>
      <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('No problem. Just enter your email and we will email you a password reset link.') }}
      </div>
      @if (session('status'))
        <div class="mb-4 text-green-600 text-center text-sm">{{ session('status') }}</div>
      @endif
      <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1 font-semibold">E-Mail Address</label>
          <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
            <span class="mr-2 text-gray-400"><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-5 h-5'><path stroke-linecap='round' stroke-linejoin='round' d='M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-.659 1.591l-7.5 7.5a2.25 2.25 0 01-3.182 0l-7.5-7.5A2.25 2.25 0 012.25 6.993V6.75' /></svg></span>
            <input type="email" name="email" class="bg-transparent outline-none w-full" placeholder="Enter your email" required autofocus>
          </div>
        </div>
        <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded-lg font-bold hover:bg-blue-800 transition">Send Reset Link</button>
      </form>
      <div class="mt-4 text-center text-sm">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">&larr; Back to Login</a>
      </div>
    </div>
    <!-- Kanan: Ilustrasi/Logo -->
    <div class="hidden md:flex w-1/2 bg-blue-50 items-center justify-center">
      <img src="{{ asset('img/msa.png') }}" alt="Ilustrasi" class="w-3/4">
    </div>
  </div>
</div>
@endsection
