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
        </nav>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Folders</th>

          </tr>


        </thead>
        <tbody>
          @foreach ($folders as $folder)
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class=" flex justify-between px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <a href="{{ route('folders.showContents', ['folder' => $folder]) }}" class="folder-link"
                data-folder-id="{{ $folder->id }}">{{ $folder->name }}</a>
              {{-- <a href="#">preview</a> --}}


              <div class="dropdown">
                <button onclick="toggleDropdown()" class="dropbtn"><svg class="-mr-1 ml-2 h-5 w-5"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
                  </svg></button>
                <div id="myDropdown" class="dropdown-content">
                  <a href="#">Edit Details</a>
                  <a href="#">Publish/un-Publish</a>
                  <a href="#">Free preview</a>
                  <a href="{{ route('folders.destroy', ['folder' => $folder]) }}"
                    onclick="event.preventDefault(); document.getElementById('delete-folder-{{ $folder->id }}').submit();">
                    Delete
                </a>
                <form id="delete-folder-{{ $folder->id }}"
                    action="{{ route('folders.destroy', ['folder' => $folder]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
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


            // Add event listener to folder links
            document.addEventListener('DOMContentLoaded', function() {
                const folderLinks = document.querySelectorAll('.folder-link');

                folderLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
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