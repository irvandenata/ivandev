<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>My Name Irvan Denata !</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  {{-- favicon --}}
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @stack('style')
</head>

<body class="w-full">

  <div id="spinner" class="w-full h-screen flex justify-center bg-background items-center fixed z-10 top-0 left-0">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="animate-spin" height="1em"
      viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
      <path
        d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z" />
    </svg>
  </div>

  <div class="snap-y container-fluid relative">
    <div id="navigation" class="fixed top-0 z-9 shadow w-full bg-white">
      <header class="bg-white container  mx-auto ">
        <nav class="flex lg:px-0 items-center justify-between py-6" aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="/"
              class="-m-1.5 p-1.5 hover:bg-primary hover:text-white hover:animate-bounce hover:rounded hover:scale-100 ">
              <span class="font-bold text-2xl">IVD.</span>
            </a>
          </div>
          <div class="flex lg:hidden">
            <button type="button" id="menu-button-mobile"
              class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
              <span class="sr-only">Open main menu</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
            </button>
          </div>
          <div class="hidden lg:flex lg:gap-x-12">
            <a @if (Request::is('/')) href="#about-me" @else href="/#about-me" @endif
              class="text-sm font-light px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">About
              Me</a>
            <a @if (Request::is('/')) href="#tech-stack" @else href="/#tech-stack" @endif
              class="text-sm font-light px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">Tech
              Stack</a>
            <a @if (Request::is('/')) href="#tech-stack" @else href="/#tech-stack" @endif
              class="text-sm font-light px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">Work
              Experieces</a>
            <a @if (Request::is('/')) href="#projects" @else href="/#projects" @endif
              class="text-sm font-light px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">Projects</a>
            {{-- <a href="#" class="text-sm font-semibold px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">Research</a> --}}
            <a href="{{ route('blog.search') }}"
              class="text-sm font-light px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">My
              Blog</a>

          </div>
          <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a @if (Request::is('/')) href="#get-in-touch" @else href="/#get-in-touch" @endif
              class="text-sm font-semibold px-1 leading-6 text-gray-900 hover:bg-primary hover:text-white hover:rounded hover:animate-bounce hover:px-1">Get
              In Touch<span aria-hidden="true">&rarr;</span></a>
          </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div class="hidden mobile-menu transition ease-in-out delay-150 duration-300" role="dialog" aria-modal="false">
          <!-- Background backdrop, show/hide based on slide-over state. -->
          <div class="fixed inset-0 z-10"></div>
          <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6">
            <div class="flex items-center justify-between">
              <a href="/"
                class="-m-1.5 p-1.5 hover:bg-primary hover:text-white hover:animate-bounce hover:rounded hover:scale-100 ">
                <span class="font-bold text-2xl">IVD.</span>
              </a>
              <button type="button" id="exit-menu-mobile" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Close menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                  aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                  <a @if (Request::is('/')) href="#about-me" @else href="/#about-me" @endif
                    onclick="closeNav()"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-light leading-7 text-gray-900 hover:bg-gray-50">About
                    Me</a>
                  <a @if (Request::is('/')) href="#tech-stack-2" @else href="/#tech-stack-2" @endif
                    onclick="closeNav()"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-light leading-7 text-gray-900 hover:bg-gray-50">Tech
                    Stack</a>
                  <a @if (Request::is('/')) href="#tech-stack" @else href="/#tech-stack" @endif
                    onclick="closeNav()"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-light leading-7 text-gray-900 hover:bg-gray-50">Work
                    Experiences</a>
                  <a @if (Request::is('/')) href="#projects" @else href="/#projects" @endif
                    onclick="closeNav()"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-light leading-7 text-gray-900 hover:bg-gray-50">Projects</a>
                  <a href="{{ route('blog.search') }}"
                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-light leading-7 text-gray-900 hover:bg-gray-50">My
                    Blog</a>
                </div>
                <div class="py-6">
                  <a @if (Request::is('/')) href="#get-in-touch" @else href="/#get-in-touch" @endif
                    onclick="closeNav()"
                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Get
                    In Touch</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
    </div>
    @yield('content')
    <div class="snap-madatory snap-center container mb-4 mx-auto flex justify-center items-center" id="projects">
      <div class="w-full">
        <div class=" bg-background container rounded-lg border-2 border-gray p-4 dark:bg-gray-800 flex justify-center">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="#"
              class="hover:underline">Irvan Denata™</a>. All Rights Reserved.
          </span>
        </div>
      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      function sendGetInTouch(e) {
        e.preventDefault();
        //send ajax
        Swal.fire({
          title: 'Send Message',
          icon: 'info',
          html: `You want to send a message to me?`,
          showCancelButton: true,
          confirmButtonText: `Send`,
          cancelButtonText: `Cancel`,
          showLoaderOnConfirm: true,
          preConfirm: function(isConfirm) {
            if (!isConfirm) return;
            fetch("{{ route('get-in-touch') }}", {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value,
                _token: "{{ csrf_token() }}"
              })
            }).then(response => {
              console.log(response)
              if (response.ok) {
                return response.json()
              } else {
                throw new Error('Something went wrong');
              }
            }).then(data => {
              console.log(data)
              if (data.status == 'success') {
                Swal.fire({
                  title: 'Success',
                  icon: 'success',
                  html: data.message,
                  showCancelButton: false,
                  confirmButtonText: `Ok`,
                  cancelButtonText: `Cancel`,
                  showLoaderOnConfirm: true,
                  preConfirm: function(isConfirm) {
                    document.getElementById('name').value = ''
                    document.getElementById('email').value = ''
                    document.getElementById('message').value = ''
                    if (!isConfirm) return;
                    // window.location.reload();

                  }
                })
              } else {
                Swal.fire({
                  title: 'Error',
                  icon: 'error',
                  html: data.message,
                  showCancelButton: false,
                  confirmButtonText: `Ok`,
                  cancelButtonText: `Cancel`,
                  showLoaderOnConfirm: true,
                  preConfirm: function(isConfirm) {
                    if (!isConfirm) return;
                    // window.location.reload();
                  }
                })
              }
            }).catch(error => {
              Swal.fire({
                title: 'Error',
                icon: 'error',
                html: error.message,
                showCancelButton: false,
                confirmButtonText: `Ok`,
                cancelButtonText: `Cancel`,
                showLoaderOnConfirm: true,
                preConfirm: function(isConfirm) {
                  if (!isConfirm) return;
                  //   window.location.reload();
                }
              })
            })
          }
        })


      }

      function mouseEnter(element) {
        let parentId = element.target.parentElement.id
        let caption = document.querySelector('#' + parentId + ' .icon-caption')
        caption.classList.remove('invisible')
      }

      function mouseLeave(element) {
        let parentId = element.target.parentElement.id
        let caption = document.querySelector('#' + parentId + ' .icon-caption')
        caption.classList.add('invisible')
      }
      window.addEventListener("scroll", (event) => {
        let scroll = this.scrollY;
        let navigation = document.getElementById('navigation')
        if (scroll > 20) {
          navigation.classList.add('shadow')
        } else {
          navigation.classList.remove('shadow')
        }
      });

      function closeNav() {
        let menuMobile = document.querySelector('.mobile-menu');
        menuMobile.classList.add('hidden');
      }
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
          let spiner = document.getElementById('spinner')
          spiner.classList.add('hidden')
        }, 1000);

        var btnMenuMobile = document.getElementById('menu-button-mobile');
        var exitMenuMobile = document.getElementById('exit-menu-mobile');
        var menuMobile = document.querySelector('.mobile-menu');
        btnMenuMobile.addEventListener('click', function() {
          menuMobile.classList.remove('hidden');
        });
        exitMenuMobile.addEventListener('click', function() {
          menuMobile.classList.add('hidden');
        });

        var stackIcon = document.querySelectorAll('.icon-stack')
        var replacers = document.querySelectorAll('[data-replace]');
        for (var i = 0; i < replacers.length; i++) {
          let replaceClasses = JSON.parse(replacers[i].dataset.replace.replace(/'/g, '"'));
          Object.keys(replaceClasses).forEach(function(key) {
            replacers[i].classList.remove(key);
            replacers[i].classList.add(replaceClasses[key]);
          });
        }



        // var tooltip = document.querySelector('[data-tooltip-target]');
        // var tooltipTarget = document.getElementById(tooltip.dataset.tooltipTarget);
        // var tooltipPlacement = tooltip.dataset.tooltipPlacement;
        // var tooltipArrow = tooltip.querySelector('[data-popper-arrow]');
        // var tooltipInstance = createPopper(tooltip, tooltipTarget, {
        //     placement: tooltipPlacement,
        //     modifiers: [
        //         {
        //             name: 'offset',
        //             options: {
        //                 offset: [0, 8],
        //             },
        //         },
        //         {
        //             name: 'arrow',
        //             options: {
        //                 element: tooltipArrow,
        //             },
        //         },
        //     ],
        // });


      });
      if (!localStorage.getItem('ip')) {
        localStorage.setItem('ip', '{{ Request::ip() }}')
        fetch("{{ route('count-view') }}", {
          method: 'GET',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        }).then(response => {
          console.log(response)
          if (response.ok) {
            return response.json()
          } else {
            throw new Error('Something went wrong');
          }
        }).then(data => {
          console.log(data)
        }).catch(error => {
          console.log(error)
        })
      }
    </script>
    @stack('script')
</body>

</html>
