<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <style>[x-cloak] { display: none !important; }</style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @livewireScripts
        @stack('scripts')


        <style>
            .custom-checkbox input[type="checkbox"]:checked {
    background-color: #22C55E; /* Green color when checked */
    border-color: #22C55E; /* Green color when checked */
  }
  
  .custom-checkbox input[type="checkbox"]:checked:hover {
    background-color: #2DBF73; /* Green color when checked and hovered */
    border-color: #2DBF73; /* Green color when checked and hovered */


  }


  .custom-checkbox input[type="checkbox"]:hover {
    --tw-ring-color: #22C55E; /* Green color for hover */
  }

  .custom-checkbox input[type="checkbox"]:checked {
    background-color: #22C55E; /* Green color when checked */
    border-color: #22C55E; /* Green color when checked */
  }

  .customebg{
    background: #F6F2FD;
  }

  .buttonbg{
    background: #31FF77;
  }

  .c-font{
    color: #120F30;
  }

  .c-field input:focus { 
    outline: none !important;
    border-color: red;
    box-shadow: 0 0 10px red;
 }

 .bhover:hover{
  background: #16A34A;
 }

          </style>
    </head>

    <body class="antialiased">
        {{ $slot }}

        @livewire('notifications')
    </body>
</html>
