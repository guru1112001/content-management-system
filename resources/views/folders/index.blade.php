<!-- resources/views/folders/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Folders</h1>
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($folders as $folder)
                <li class="bg-white dark:bg-gray-800 shadow-lg p-4 rounded-lg">
                    <!-- Use data attribute to store folder id -->
                    <a href="#" class="block text-xl font-semibold folder-link" data-folder-id="{{ $folder->id }}">{{ $folder->name }}</a>
                </li>
            @endforeach
        </ul>
        
        <!-- Contents section -->
        <div id="contents-section" class="mt-8">
            <!-- Contents will be displayed here -->
        </div>
    </div>

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
