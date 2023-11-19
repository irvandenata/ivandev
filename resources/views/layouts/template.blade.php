<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DELEARN</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/main/app-dark.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/shared/iconly.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/plugins/font-awesome.min.css">

    <style>
        .btn {
            margin: 5px 5px !important;
            text-decoration: none !important;
        }

        li.active {
            color: white !important;
        }

        .modal-content {
            padding: 20px !important;
        }

    </style>
    @stack('css')
    @stack('styles')

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}">DELEARN</a>

                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item
@if(Request::segment(2) === 'dashboard')
                                                    active
@endif">
                            <a href=" {{ route('dashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item
@if(Request::segment(2) === 'user')
                                                active
@endif">
                            <a href=" {{ route('user.index') }}" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Users</span>
                            </a>
                        </li>

                        <li class="sidebar-item  @if(Request::segment(2) === 'category-word')
                                                active
@endif">
                            <a href=" {{ route('category-word.index') }}" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Category Word</span>
                            </a>
                        </li>
                           <li class="sidebar-item  @if(Request::segment(2) === 'setting')
                                                active
@endif">
                            <a href=" {{ route('setting.index') }}" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Setting</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Master Data</li>
                        <li class="sidebar-item  @if(Request::segment(2) === 'language')
                                                active
@endif">
                            <a href=" {{ route('language.index') }}" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Language</span>
                            </a>
                        </li>
                        <li class="sidebar-item  @if(Request::segment(2) === 'category')
                                                active
@endif">
                            <a href=" {{ route('category.index') }}" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Category</span>
                            </a>
                        </li>
                         <li class="sidebar-item  @if(Request::segment(2) === 'word')
                                                active
@endif">
                            <a href=" {{ route('word.index') }}" class='sidebar-link'>
                            <i class="bi bi-gear-fill"></i>
                            <span>Word</span>
                            </a>
                        </li>
                        <li class="sidebar-item">

                            <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Sign Out</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>{{ $title }}</h3>
                @php
                    $breadcrumb = explode('/',Request::url());
                    array_splice($breadcrumb,0, 4);
                @endphp

                <ol class="breadcrumb">
                    @foreach($breadcrumb as $item)
                        <li class="breadcrumb-item @if($item==end($breadcrumb)) active @endif"><a @if($item!=end($breadcrumb)) href="{{ route($item.'.index') }}" @endif>{{ Str::ucfirst($item) }}</a></li>
                    @endforeach
                </ol>

            </div>
            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Delearn</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by Irvan Denata</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/plugins/sweatalert2.js') }}"></script>

    @stack('js')
    @stack('scripts')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })



    </script>
</body>

</html>
