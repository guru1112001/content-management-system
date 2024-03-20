<!-- resources/views/folders/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex justify-between mt-4 ml-4">
  <div class="w-1/2 pr-4">
    <!-- Left Side (Folders) -->
    <div class="relative">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        {{-- <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Folders</th>

          </tr>


        </thead> --}}


        <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
          <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Folders</span>
            </a>

            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
              <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                <li>
                  <a href="#"
                    class="self-center px-5 py-2.5 text-center inline-flex items-center whitespace-nowrap dark:text-white">Clone</a>
                </li>
                <li>
                  <a href="#"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enable
                    Rearrage</a>
                </li>
                <li>
                  <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                    new <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                    </svg></button>
                  <!-- Dropdown menu -->
                  <div id="dropdownNavbar"
                    class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                      <li>
                        <a href="#"
                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                      </li>
                      <li>
                        <a href="#"
                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                      </li>
                      <li>
                        <a href="#"
                          class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                      </li>
                    </ul>
                    <div class="py-1">
                      <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                        out</a>
                    </div>
                  </div>
                </li>

              </ul>
            </div>
          </div>
        </nav><thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Folders</th>
            
          </tr>


        </thead>
        <tbody>
            @foreach ($folders as $folder)
               <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
               <td class=" flex justify-between px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <a href="{{ route('folders.showContents', ['folder' => $folder]) }}" class="folder-link"      data-folder-id="{{ $folder->id }}">{{ $folder->name }}</a>
                {{-- <a href="#">preview</a> --}}
              

                <div class="dropdown">
                  <button onclick="toggleDropdown()" class="dropbtn">Dropdown</button>
                  <div id="myDropdown" class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                  </div>
                </div>
            </td>
            
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div id="contents-section" class="w-1/2 ">
    @if(isset($contents))
    <!-- Contents will be displayed here -->
    @include('contents.index', ['data' => $contents])
    @else
    <p> </p>
    @endif
 

  <script>
    // Get references to the menu button and the dropdown menu
var menuButton = document.getElementById('menu-button');
var dropdownMenu = document.querySelector('.relative.inline-block.text-left .absolute');

// Toggle the dropdown menu visibility when the menu button is clicked
menuButton.addEventListener('click', function() {
  dropdownMenu.classList.toggle('hidden');
});

// Close the dropdown menu when the user clicks outside of it
document.addEventListener('click', function(event) {
  if (!dropdownMenu.contains(event.target) && !menuButton.contains(event.target)) {
    dropdownMenu.classList.add('hidden');
  }
});

    Add an event listener to all dropdown buttons
    document.querySelectorAll('[data-dropdown-toggle]').forEach(button => {
        button.addEventListener('click', function() {
            // Get the ID of the dropdown menu associated with this button
            const dropdownId = button.getAttribute('data-dropdown-toggle');
            // Toggle the visibility of the dropdown menu
            const dropdownMenu = document.getElementById(dropdownId);
            dropdownMenu.classList.toggle('hidden');
        });
    });

    //     // Add event listener to folder links
    //     document.addEventListener('DOMContentLoaded', function () {
    //         const folderLinks = document.querySelectorAll('.folder-link');
            
    //         folderLinks.forEach(function (link) {
    //             link.addEventListener('click', function (event) {
    //                 event.preventDefault();
                    
    //                 // Get folder id from data attribute
    //                 const folderId = this.getAttribute('data-folder-id');
                    
    //                 // Fetch contents of the selected folder using AJAX
    //                 fetchContents(folderId);
    //             });
    //         });
    //     });
        
    //     // Function to fetch contents using AJAX
    //     function fetchContents(folderId) {
    //         fetch(`/folders/${folderId}`)
    //             .then(response => response.text())
    //             .then(data => {
    //                 // Update contents section with fetched data
    //                 document.getElementById('contents-section').innerHTML = data;
                    
    //             }) 
    //             .catch(error => console.error('Error:', error));
    //     }
  </script>
  @endsection