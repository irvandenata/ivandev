@extends('layouts.app')
@push('meta-tag')
@endpush
<style>
@media (max-width: 700px ) {
  .mobile-text{
    font-size: 12px !important;
  }
  .body-about>div {
    font-size: 12px !important;
    text-align: justify !important;
  }
}

</style>
@section('content')
  <div id="about-me"
    class="snap-madatory snap-center mx-auto container min-h-screen flex lg:flex-row flex-col lg:pt-0 sm:pt-32 lg:items-center "
    id="about-me">
    <div class="lg:basis-1/2 flex justify-center">
      <img src="/storage/{{ $user->image_profile }}" class="w-4/6 rounded-full" alt="">
    </div>
    <div class="lg:basis-1/2 lg:pt-0 pt-10">
      <h1 class="lg:text-4xl text-xl font-bold mb-4">Hi There,
        <br/>
        <span class='green_gradient text-center'><span
            class='inline-block overflow-hidden whitespace-nowrap font-mono animate-typing border-r-4'>I'm <span
              class="text-primary">Irvan
              Denata</span> 👋</span>
        </span>
        <br>
      </h1>
      <div class="body-about">
        {!! $user->description !!}
      </div>

      <div class="flex gap-6 mt-5 static">
        <div class="static" id="instagram">
          <a onmouseenter="mouseEnter(event)" target="_blank" href="https://www.instagram.com/irvandenata"
            onmouseleave="mouseLeave(event)"
            class="icon-stack static cursor-pointer hover:rounded hover:text-white social-media-icon"
            data-name="Instagram" data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom"><svg
              xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
              <path
                d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z">
              </path>
            </svg>
          </a>
          <p class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
            @irvandenata
          </p>
        </div>

        <div id="whatsapp" class="static">
          <a href="https://wa.me/6289667899336" target="_blank" onmouseenter="mouseEnter(event)"
            onmouseleave="mouseLeave(event)"
            class="static icon-stack cursor-pointer hover:rounded hover:text-white social-media-icon"><svg
              xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
              <path
                d="M 25 2 C 12.309534 2 2 12.309534 2 25 C 2 29.079097 3.1186875 32.88588 4.984375 36.208984 L 2.0371094 46.730469 A 1.0001 1.0001 0 0 0 3.2402344 47.970703 L 14.210938 45.251953 C 17.434629 46.972929 21.092591 48 25 48 C 37.690466 48 48 37.690466 48 25 C 48 12.309534 37.690466 2 25 2 z M 25 4 C 36.609534 4 46 13.390466 46 25 C 46 36.609534 36.609534 46 25 46 C 21.278025 46 17.792121 45.029635 14.761719 43.333984 A 1.0001 1.0001 0 0 0 14.033203 43.236328 L 4.4257812 45.617188 L 7.0019531 36.425781 A 1.0001 1.0001 0 0 0 6.9023438 35.646484 C 5.0606869 32.523592 4 28.890107 4 25 C 4 13.390466 13.390466 4 25 4 z M 16.642578 13 C 16.001539 13 15.086045 13.23849 14.333984 14.048828 C 13.882268 14.535548 12 16.369511 12 19.59375 C 12 22.955271 14.331391 25.855848 14.613281 26.228516 L 14.615234 26.228516 L 14.615234 26.230469 C 14.588494 26.195329 14.973031 26.752191 15.486328 27.419922 C 15.999626 28.087653 16.717405 28.96464 17.619141 29.914062 C 19.422612 31.812909 21.958282 34.007419 25.105469 35.349609 C 26.554789 35.966779 27.698179 36.339417 28.564453 36.611328 C 30.169845 37.115426 31.632073 37.038799 32.730469 36.876953 C 33.55263 36.755876 34.456878 36.361114 35.351562 35.794922 C 36.246248 35.22873 37.12309 34.524722 37.509766 33.455078 C 37.786772 32.688244 37.927591 31.979598 37.978516 31.396484 C 38.003976 31.104927 38.007211 30.847602 37.988281 30.609375 C 37.969311 30.371148 37.989581 30.188664 37.767578 29.824219 C 37.302009 29.059804 36.774753 29.039853 36.224609 28.767578 C 35.918939 28.616297 35.048661 28.191329 34.175781 27.775391 C 33.303883 27.35992 32.54892 26.991953 32.083984 26.826172 C 31.790239 26.720488 31.431556 26.568352 30.914062 26.626953 C 30.396569 26.685553 29.88546 27.058933 29.587891 27.5 C 29.305837 27.918069 28.170387 29.258349 27.824219 29.652344 C 27.819619 29.649544 27.849659 29.663383 27.712891 29.595703 C 27.284761 29.383815 26.761157 29.203652 25.986328 28.794922 C 25.2115 28.386192 24.242255 27.782635 23.181641 26.847656 L 23.181641 26.845703 C 21.603029 25.455949 20.497272 23.711106 20.148438 23.125 C 20.171937 23.09704 20.145643 23.130901 20.195312 23.082031 L 20.197266 23.080078 C 20.553781 22.728924 20.869739 22.309521 21.136719 22.001953 C 21.515257 21.565866 21.68231 21.181437 21.863281 20.822266 C 22.223954 20.10644 22.02313 19.318742 21.814453 18.904297 L 21.814453 18.902344 C 21.828863 18.931014 21.701572 18.650157 21.564453 18.326172 C 21.426943 18.001263 21.251663 17.580039 21.064453 17.130859 C 20.690033 16.232501 20.272027 15.224912 20.023438 14.634766 L 20.023438 14.632812 C 19.730591 13.937684 19.334395 13.436908 18.816406 13.195312 C 18.298417 12.953717 17.840778 13.022402 17.822266 13.021484 L 17.820312 13.021484 C 17.450668 13.004432 17.045038 13 16.642578 13 z M 16.642578 15 C 17.028118 15 17.408214 15.004701 17.726562 15.019531 C 18.054056 15.035851 18.033687 15.037192 17.970703 15.007812 C 17.906713 14.977972 17.993533 14.968282 18.179688 15.410156 C 18.423098 15.98801 18.84317 16.999249 19.21875 17.900391 C 19.40654 18.350961 19.582292 18.773816 19.722656 19.105469 C 19.863021 19.437122 19.939077 19.622295 20.027344 19.798828 L 20.027344 19.800781 L 20.029297 19.802734 C 20.115837 19.973483 20.108185 19.864164 20.078125 19.923828 C 19.867096 20.342656 19.838461 20.445493 19.625 20.691406 C 19.29998 21.065838 18.968453 21.483404 18.792969 21.65625 C 18.639439 21.80707 18.36242 22.042032 18.189453 22.501953 C 18.016221 22.962578 18.097073 23.59457 18.375 24.066406 C 18.745032 24.6946 19.964406 26.679307 21.859375 28.347656 C 23.05276 29.399678 24.164563 30.095933 25.052734 30.564453 C 25.940906 31.032973 26.664301 31.306607 26.826172 31.386719 C 27.210549 31.576953 27.630655 31.72467 28.119141 31.666016 C 28.607627 31.607366 29.02878 31.310979 29.296875 31.007812 L 29.298828 31.005859 C 29.655629 30.601347 30.715848 29.390728 31.224609 28.644531 C 31.246169 28.652131 31.239109 28.646231 31.408203 28.707031 L 31.408203 28.708984 L 31.410156 28.708984 C 31.487356 28.736474 32.454286 29.169267 33.316406 29.580078 C 34.178526 29.990889 35.053561 30.417875 35.337891 30.558594 C 35.748225 30.761674 35.942113 30.893881 35.992188 30.894531 C 35.995572 30.982516 35.998992 31.07786 35.986328 31.222656 C 35.951258 31.624292 35.8439 32.180225 35.628906 32.775391 C 35.523582 33.066746 34.975018 33.667661 34.283203 34.105469 C 33.591388 34.543277 32.749338 34.852514 32.4375 34.898438 C 31.499896 35.036591 30.386672 35.087027 29.164062 34.703125 C 28.316336 34.437036 27.259305 34.092596 25.890625 33.509766 C 23.114812 32.325956 20.755591 30.311513 19.070312 28.537109 C 18.227674 27.649908 17.552562 26.824019 17.072266 26.199219 C 16.592866 25.575584 16.383528 25.251054 16.208984 25.021484 L 16.207031 25.019531 C 15.897202 24.609805 14 21.970851 14 19.59375 C 14 17.077989 15.168497 16.091436 15.800781 15.410156 C 16.132721 15.052495 16.495617 15 16.642578 15 z">
              </path>
            </svg></a>
          <p class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
            +62896-6789-9336
          </p>

        </div>



        <div class="static" id="github">
          <a href="https://github.com/irvandenata" target="_blank" onmouseenter="mouseEnter(event)"
            onmouseleave="mouseLeave(event)"
            class="static icon-stack cursor-pointer hover:rounded hover:scale-125 hover:text-white social-media-icon"><svg
              xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 30 30">
              <path
                d="M15,3C8.373,3,3,8.373,3,15c0,5.623,3.872,10.328,9.092,11.63C12.036,26.468,12,26.28,12,26.047v-2.051 c-0.487,0-1.303,0-1.508,0c-0.821,0-1.551-0.353-1.905-1.009c-0.393-0.729-0.461-1.844-1.435-2.526 c-0.289-0.227-0.069-0.486,0.264-0.451c0.615,0.174,1.125,0.596,1.605,1.222c0.478,0.627,0.703,0.769,1.596,0.769 c0.433,0,1.081-0.025,1.691-0.121c0.328-0.833,0.895-1.6,1.588-1.962c-3.996-0.411-5.903-2.399-5.903-5.098 c0-1.162,0.495-2.286,1.336-3.233C9.053,10.647,8.706,8.73,9.435,8c1.798,0,2.885,1.166,3.146,1.481C13.477,9.174,14.461,9,15.495,9 c1.036,0,2.024,0.174,2.922,0.483C18.675,9.17,19.763,8,21.565,8c0.732,0.731,0.381,2.656,0.102,3.594 c0.836,0.945,1.328,2.066,1.328,3.226c0,2.697-1.904,4.684-5.894,5.097C18.199,20.49,19,22.1,19,23.313v2.734 c0,0.104-0.023,0.179-0.035,0.268C23.641,24.676,27,20.236,27,15C27,8.373,21.627,3,15,3z">
              </path>
            </svg></a>
          <p class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
            irvandenata
          </p>
        </div>


        <div class="static" id="linkedin">
          <a href="https://www.linkedin.com/in/irvan-denata/" target="_blank" onmouseenter="mouseEnter(event)"
            onmouseleave="mouseLeave(event)"
            class="static icon-stack cursor-pointer hover:rounded hover:scale-125 hover:text-white social-media-icon"><svg
              xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
              <path
                d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 41 6 C 42.668484 6 44 7.3315161 44 9 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 14 11.011719 C 12.904779 11.011719 11.919219 11.339079 11.189453 11.953125 C 10.459687 12.567171 10.011719 13.484511 10.011719 14.466797 C 10.011719 16.333977 11.631285 17.789609 13.691406 17.933594 A 0.98809878 0.98809878 0 0 0 13.695312 17.935547 A 0.98809878 0.98809878 0 0 0 14 17.988281 C 16.27301 17.988281 17.988281 16.396083 17.988281 14.466797 A 0.98809878 0.98809878 0 0 0 17.986328 14.414062 C 17.884577 12.513831 16.190443 11.011719 14 11.011719 z M 14 12.988281 C 15.392231 12.988281 15.94197 13.610038 16.001953 14.492188 C 15.989803 15.348434 15.460091 16.011719 14 16.011719 C 12.614594 16.011719 11.988281 15.302225 11.988281 14.466797 C 11.988281 14.049083 12.140703 13.734298 12.460938 13.464844 C 12.78117 13.19539 13.295221 12.988281 14 12.988281 z M 11 19 A 1.0001 1.0001 0 0 0 10 20 L 10 39 A 1.0001 1.0001 0 0 0 11 40 L 17 40 A 1.0001 1.0001 0 0 0 18 39 L 18 33.134766 L 18 20 A 1.0001 1.0001 0 0 0 17 19 L 11 19 z M 20 19 A 1.0001 1.0001 0 0 0 19 20 L 19 39 A 1.0001 1.0001 0 0 0 20 40 L 26 40 A 1.0001 1.0001 0 0 0 27 39 L 27 29 C 27 28.170333 27.226394 27.345035 27.625 26.804688 C 28.023606 26.264339 28.526466 25.940057 29.482422 25.957031 C 30.468166 25.973981 30.989999 26.311669 31.384766 26.841797 C 31.779532 27.371924 32 28.166667 32 29 L 32 39 A 1.0001 1.0001 0 0 0 33 40 L 39 40 A 1.0001 1.0001 0 0 0 40 39 L 40 28.261719 C 40 25.300181 39.122788 22.95433 37.619141 21.367188 C 36.115493 19.780044 34.024172 19 31.8125 19 C 29.710483 19 28.110853 19.704889 27 20.423828 L 27 20 A 1.0001 1.0001 0 0 0 26 19 L 20 19 z M 12 21 L 16 21 L 16 33.134766 L 16 38 L 12 38 L 12 21 z M 21 21 L 25 21 L 25 22.560547 A 1.0001 1.0001 0 0 0 26.798828 23.162109 C 26.798828 23.162109 28.369194 21 31.8125 21 C 33.565828 21 35.069366 21.582581 36.167969 22.742188 C 37.266572 23.901794 38 25.688257 38 28.261719 L 38 38 L 34 38 L 34 29 C 34 27.833333 33.720468 26.627107 32.990234 25.646484 C 32.260001 24.665862 31.031834 23.983076 29.517578 23.957031 C 27.995534 23.930001 26.747519 24.626988 26.015625 25.619141 C 25.283731 26.611293 25 27.829667 25 29 L 25 38 L 21 38 L 21 21 z">
              </path>
            </svg></a>
          <p class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
            Irvan Denata
          </p>
        </div>


      </div>
    </div>
  </div>

  <div class="snap-madatory snap-center container min-h-screen mx-auto  flex items-center sm:pt-32" id="tech-stack">
    <div class="lg:flex w-full">
      <div class="lg:basis-2/3 ">
        <h1 class="text-3xl font-bold">Work <span class="text-primary">Experiences</span></h1>
        <div class="flex-row mt-10">
          <ol class="relative -z-10 border-s border-background dark:border-gray-700">
            @foreach ($workExp as $item)
              <li class="mb-10 ms-6 px-4 -z-10">
                <span
                  class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-background dark:border-gray-900 dark:bg-blue-900">
                  <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                  </svg>
                </span>
                <h3 class="flex items-center mb-1 text-lg text-black font-semibold text-gray-900 dark:text-white">
                  {{ $item->title }}
                </h3>
                <p class="mb-2 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $item->sub_title }}</p>
                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                  {{ Carbon\Carbon::parse($item->start_date)->format('M Y') }} -
                  {{ Carbon\Carbon::parse($item->end_date)->format('M Y') }}
                </time>
                <p class="mb-4 text-base font-thin text-gray-500 dark:text-gray-400">
                  {!! $item->description !!}
                </p>
              </li>
            @endforeach

          </ol>
        </div>
      </div>
      <div class="lg:basis-1/3 lg:pt-0 sm:pt-32" id="tech-stack-2">
        <h1 class="text-3xl font-bold  ">Tech S<span class="text-primary">tac</span>k</h1>
        <div class="flex-row">
          <div class="mt-10">
            <h2 class="text-lg">Frontend</h2>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-4 gap-5 md:gap-3 mt-4">
              @foreach ($techStack->where('sub_title', 'Frontend') as $item)
                <div id="title-{{ $item->id }}" class="  flex-row justify-center static">
                  <div onmouseenter="mouseEnter(event)" onmouseleave="mouseLeave(event)"
                    class="icon-stack p-2 bg-background rounded-lg hover:border-primary hover:border-2 border-2 border-background cursor-pointer flex items-center justify-center">
                    {!! $item->icon !!}
                  </div>
                  <p
                    class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
                    {{ $item->title }}
                  </p>
                </div>
              @endforeach
            </div>
          </div>
          <div class="mt-16">
            <h2 class="text-lg">Backend</h2>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-4 gap-5 md:gap-3 mt-4">
              @foreach ($techStack->where('sub_title', 'Backend') as $item)
                <div id="title-{{ $item->id }}" class="flex-row justify-center static">
                  <div onmouseenter="mouseEnter(event)" onmouseleave="mouseLeave(event)"
                    class="icon-stack p-2 bg-background rounded-lg hover:border-primary hover:border-2 border-2 border-background cursor-pointer flex justify-center items-center">
                    {!! $item->icon !!}
                  </div>
                  <div>
                    <p
                      class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
                      {{ $item->title }}
                    </p>
                  </div>

                </div>
              @endforeach
            </div>
          </div>
          <div class="mt-16">
            <h2 class="text-lg">Others</h2>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-4 gap-5 md:gap-3 mt-4">
              @foreach ($techStack->where('sub_title', 'Others') as $item)
                <div id="title-{{ $item->id }}" class="flex-row item-center static">
                  <div onmouseenter="mouseEnter(event)" onmouseleave="mouseLeave(event)"
                    class="icon-stack p-2 bg-background rounded-lg hover:border-primary hover:border-2 border-2 border-background cursor-pointer flex justify-center items-center">
                    {!! $item->icon !!}
                  </div>
                  <p
                    class="icon-caption border border-gray text-sm absolute invisible  font-thin text-center mt-2 bg-background p-1 rounded">
                    {{ $item->title }}
                  </p>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

  <div class="snap-madatory snap-center container min-h-screen mx-auto flex items-center sm:pt-32" id="projects">
    <div class="">
      <div class="flex lg:flex-row sm:flex-col justify-between">
        <h1 class="text-3xl sm:text font-bold">The project <span class="text-primary">I'm working on</span></h1>
        <a href="{{ route('projects.search') }}"
          class="inline-flex items-center text-lg sm:text-sm font-bold hover:bg-background lg:mt-0 sm:mt-6 lg:p-2 rounded-lg  text-center text-black bg-blue-700 ">
          See More Projects
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </a>
      </div>
      <div class="flex">
        <div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-y-10 gap-x-6 mt-10">
          @foreach ($projects as $item)
            <div
              class="max-w-sm bg-background border-2 border-gray rounded-lg hover:border-primary shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="{{ route('blog.show', $item->slug) }}" class="">
                <img class="rounded-lg p-1" style="object-fit: cover;
                width: 100%;
                height: 185px;" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
              </a>
              <div class="p-5">
                <a href="{{ route('blog.show', $item->slug) }}" class="">
                  <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->title }}
                  </h5>
                </a>
                <a href="{{ route('blog.show', $item->slug) }}"
                  class="inline-flex items-center p-2 text-sm font-medium bg-gray  text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:bg-primary hover:text-black">
                  Read more
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>

  <div class="snap-madatory snap-center container min-h-screen mx-auto flex justify-center items-center"
    id="get-in-touch">
    <div class="w-full">
      <div class="flex justify-center">
        <h1 class="text-3xl font-bold">Get <span class="text-primary">In</span> Touch</h1>
      </div>
      <div class="flex justify-center text-center mt-4">
        <p>Feel free to reach out to me <br>if you'd like to discuss further or collaborate on a project</p>
      </div>
      <form class="mt-6 lg:w-8/12 sm:w-full mx-auto" id="form-get-in-touch" onsubmit="sendGetInTouch(event)">
        @csrf
        <div class="mb-6">
          <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
            Name</label>
          <input type="text" id="name" autocomplete="off"
            class="bg-gray-50 border-2 border-gray text-gray-900 text-sm rounded-lg focus:outline-primary  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray "
            placeholder="your name" required>
        </div>
        <div class="mb-6">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
            email</label>
          <input type="email" id="email" autocomplete="off"
            class="bg-gray-50 border-2 border-gray text-gray-900 text-sm rounded-lg focus:outline-primary  block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray "
            placeholder="your@email.com" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
            Message</label>
          <textarea name="" id="message" cols="30" rows="10"
            class=" bg-gray-50 border-2 border-gray text-gray-900 text-sm rounded-lg focus:outline-primary focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>
        <button type="submit"
          class="text-black bg-blue-700 hover:bg-blue-800 bg-background focus:ring-4 hover:bg-primary focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send
          <svg class="w-3.5 h-3.5 inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9" />
          </svg>
        </button>
      </form>
    </div>
  </div>
@endsection
