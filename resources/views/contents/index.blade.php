<!-- resources/views/contents/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Contents</h1>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($contents as $content)
                <li class="bg-white dark:bg-gray-800 shadow-lg p-4 rounded-lg">
                    <span class="block text-xl font-semibold">{{ $content->file_name }}</span>
                    <a href="{{ route('content.preview', ['file' => $content->file_path]) }}" class="text-blue-600 hover:text-blue-800">Preview</a>

                </li>
            @endforeach
        </ul>
    </div>
@endsection
