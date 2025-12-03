@extends('layout.app')

@section('content')
<div class="flex items-center justify-center h-screen bg-gray-900 text-white">
    <div class="text-center">
        <i class="fas fa-video-slash text-6xl mb-4"></i>
        <h1 class="text-2xl font-bold mb-2">We are not live now</h1>
        <p class="text-gray-400">The live trading stream is currently offline. Please check back later or contact support for assistance.</p>
        <div class="mt-4">
            <a href="https://wa.me/YOUR_WHATSAPP_NUMBER" target="_blank"
               class="px-4 py-2 bg-green-500 rounded-lg text-white font-semibold hover:bg-green-600 transition">
               Contact Support
            </a>
        </div>
    </div>
</div>
@endsection
