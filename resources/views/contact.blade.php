@extends('welcome')

@section('content')
<div class="p-6">
    <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
    <p>Contact information for the hospital goes here...</p>
    <a href="{{ route('welcome') }}" class="mt-4 block underline text-blue-500">Go Back</a>
</div>
@endsection
