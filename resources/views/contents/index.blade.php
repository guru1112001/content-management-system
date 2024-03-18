<!-- resources/views/contents/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="pr-4">
    <!-- Right Side (Documents/Contents) -->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Documents / Contents</th>
                    <th scope="col" class="px-6 py-3">
                        Preview
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contents as $content)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $content->file_name }}
                        <td class="px-6 py-4">
                            <a href="{{ route('content.preview', ['file' => $content->file_path]) }}" class="text-blue-600 hover:text-blue-800">Preview</a>
                        </td>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
