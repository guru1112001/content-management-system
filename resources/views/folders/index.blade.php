<!-- resources/views/folders/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex justify-evenly mt-4 ml-4">
    <div class="w-1/2 pr-4">
        <!-- Left Side (Folders) -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Folders</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($folders as $folder)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="#" class="folder-link" data-folder-id="{{ $folder->id }}">{{ $folder->name }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="contents-section" class="w-1/2 " >
        <!-- Contents will be displayed here -->
    </div>
    {{-- <div class="w-1/2 pl-4">
        <!-- Right Side (Documents/Contents) -->
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Documents / Contents</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">feew</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
    </div> --}}
    <script>
        // Add event listener to folder links
        document.addEventListener('DOMContentLoaded', function () {
            const folderLinks = document.querySelectorAll('.folder-link');
            
            folderLinks.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    
                    // Get folder id from data attribute
                    const folderId = this.getAttribute('data-folder-id');
                    
                    // Fetch contents of the selected folder using AJAX
                    fetchContents(folderId);
                });
            });
        });
        
        // Function to fetch contents using AJAX
        function fetchContents(folderId) {
            fetch(`/folders/${folderId}`)
                .then(response => response.text())
                .then(data => {
                    // Update contents section with fetched data
                    document.getElementById('contents-section').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection