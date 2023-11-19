<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Admin - {{ $title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/apex-charts/apex-charts.css" />
  {{-- <link rel="stylesheet" href="{{ asset('assets') }}/css/datatable.css" /> --}}

  <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
  <style>
    *,
    body {
      font-family: 'Poppins', sans-serif !important;
    }
  </style>
  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>
  <script src="{{ asset('assets') }}/js/config.js"></script>


  @stack('css')
  @stack('style')
  @include('layouts.admin-css')

</head>

<body>
  <div class="overlay">
    <div class="loader-container">
      <div class="loader spinner-border spinner-border-lg text-primary">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="/admin/dashboard" class="app-brand-link">
            <span class="demo menu-text fw-bolder ms-2 " style="margin-left: 10px !important; font-size:20px">{{ env('APP_NAME') }}</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item @if (Request::is('admin/dashboard*')) active @endif">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/abouts*')) active @endif">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-carousel"></i>
              <div data-i18n="Users">About Me</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/messages*')) active @endif">
            <a href="{{ route('admin.messages.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-carousel"></i>
              <div data-i18n="Users">Message</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/additional*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle ">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Additional Info</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item @if (Request::is('admin/additional-infos*')) active @endif">
                <a href="{{ route('admin.additional-infos.index') }}" class="menu-link">
                  <div data-i18n="Without menu">Content</div>
                </a>
              </li>
              <li class="menu-item @if (Request::is('admin/additional-types*')) active @endif">
                <a href="{{ route('admin.additional-types.index') }}" class="menu-link">
                  <div data-i18n="Without menu">Type</div>
                </a>
              </li>

            </ul>
          </li>
          <li class="menu-item @if (Request::is('admin/settings*')) active @endif">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-carousel"></i>
              <div data-i18n="Users">Setting</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/article*')) open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle ">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Article</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item @if (Request::is('admin/articles*')) active @endif">
                <a href="{{ route('admin.articles.index') }}" class="menu-link">
                  <div data-i18n="Without menu">Content</div>
                </a>
              </li>
              <li class="menu-item @if (Request::is('admin/article-categories*')) active @endif">
                <a href="{{ route('admin.article-categories.index') }}" class="menu-link">
                  <div data-i18n="Without menu">Category</div>
                </a>
              </li>

            </ul>
          </li>

          {{--
          <li class="menu-item @if (Request::is('admin/sliders*')) active @endif">
            <a href="{{ route('sliders.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-carousel"></i>
              <div data-i18n="Analytics">Slider</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/services*')) active @endif">
            <a href="{{ route('services.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-devices"></i>
              <div data-i18n="Analytics">Service</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/products*')) active @endif">
            <a href="{{ route('products.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-task"></i>
              <div data-i18n="Analytics">Product</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/category-products*')) active @endif">
            <a href="{{ route('category-products.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-task"></i>
              <div data-i18n="Analytics">Category Product</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/about-us')) active @endif">
            <a href="{{ route('about-us.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-info-circle"></i>
              <div data-i18n="Analytics">About Us</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/partners*')) active @endif">
            <a href="{{ route('partners.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Analytics">Partner</div>
            </a>
          </li>
          <li class="menu-item @if (Request::is('admin/social-medias*')) active @endif">
            <a href="{{ route('social-medias.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-message-square-dots"></i>
              <div data-i18n="Analytics">Social Media</div>
            </a>
          </li> --}}



          <!-- Layouts -->
          {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Layouts</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="layouts-without-menu.html" class="menu-link">
                  <div data-i18n="Without menu">Without menu</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-without-navbar.html" class="menu-link">
                  <div data-i18n="Without navbar">Without navbar</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-container.html" class="menu-link">
                  <div data-i18n="Container">Container</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-fluid.html" class="menu-link">
                  <div data-i18n="Fluid">Fluid</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-blank.html" class="menu-link">
                  <div data-i18n="Blank">Blank</div>
                </a>
              </li>
            </ul>
          </li> --}}
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page relative">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar" style="z-index: 3 !important">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <h5 style="margin:0">@yield('title')</h5>
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('assets') }}/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="{{ asset('assets') }}/img/avatars/1.png" alt
                              class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">Profile</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                      </form>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
              </div>
              <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                  target="_blank" class="footer-link me-4">Documentation</a>

                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                  class="footer-link me-4">Support</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->



  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>
  <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
  <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
  <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets') }}/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
    integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Page JS -->
  {{-- <script src="{{ asset('assets') }}/js/dashboards-analytics.js"></script> --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('assets') }}/js/datatable.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    $('.select2').select2({
      placeholder: 'Select an option',
      allowClear: true,
      width: 'resolve',
      height: 'resolve'
    });


  </script>
  <script>
    $('.close-modal').on('click', function() {
      $('.modal').modal('hide');
    });

    //function for show image with modal

    function showImage(item) {
      Swal.fire({
        title: 'Image Preview',
        imageUrl: $(item).attr('src'),
        imageWidth: 400,
        imageAlt: 'Image Preview',
        confirmButtonText: 'Close',
      })
    }



    @if (Session::get('errors'))

      @foreach (session('errors') as $error)
      Toast.fire({
        icon: 'error',
        title: '{{ $error }}'
      })
      @endforeach
    @endif


    @if (Session::get('error'))

    Toast.fire({
      icon: 'error',
      title: '{{ Session::get('error') }}'
    })
    @endif
    @if (Session::get('success'))

    Toast.fire({
      icon: 'success',
      title: '{{ Session::get('success') }}'
    })
    @endif
    function showImage(item) {
      Swal.fire({
        title: 'Image Preview',
        imageUrl: $(item).attr('src'),
        imageAlt: 'Image Preview',
        customClass: 'swal-wide',
        showConfirmButton: false,
        showCloseButton: true,
      })
    }
  </script>


  <!-- Place this tag in your head or just before your close body tag. -->
  @stack('js')
  @stack('script')

  <script>
    $(document).ready(function() {
      $('.overlay').hide();
    });
  </script>
</body>

</html>
