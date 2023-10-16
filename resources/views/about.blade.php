@extends('welcome')

@section('content')
<div class="p-6">
    <h2 class="text-lg font-semibold mb-4">About Us</h2>
    <p>Information about the hospital goes here...</p>
    <a href="{{ route('welcome') }}" class="mt-4 block underline text-blue-500">Go Back</a>
</div>
@endsection
