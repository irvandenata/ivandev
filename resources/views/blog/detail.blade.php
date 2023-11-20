@extends('layouts.app')
@push('meta-tag')
  <meta charset="UTF-8">
  <meta name="description" content="Cari Materi Bahasa ingris yang kamu inginkan">
  <meta name="keywords" content="">
  <meta name="author" content="Irvan Denata">
  <meta name=”robots” content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endpush
@push('style')
  <style>
    .body>h1 {
      color: black;
      font-family: 'Montserrat', sans-serif;
      font-size: 4.5rem !important;
      line-height: 1.5;
    }

    .body>h2 {
      font-family: 'Montserrat', sans-serif;
      font-size: 3rem !important;
      line-height: 1.5;
      font-weight: 700;
    }

    .body>h3 {
      font-size: 1.3rem !important;
      font-weight: 800;
      line-height: 2;
    }

    .body>p {
      text-align: justify !important;
    }
    @media (max-width: 768px) {
      .body>h1 {
        font-size: 2.5rem !important;
      }

      .body>h2 {
        font-size: 1.5rem !important;
      }

      .body>h3 {
        font-size: 1rem !important;
      }
      .body>p {
        font-size: 12px !important
      }
    }
  </style>
@endpush
@section('content')
  <div class="snap-madatory snap-center container min-h-screen mx-auto flex-column justify-center mt-32" id="projects">
    <div>
      <!-- Breadcrumb -->
      <nav
        class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-background dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="/"
              class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">
              <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                  d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
              </svg>
              Home
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
              <a href="#"
                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Article</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $article->category->name }}</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
    <div class="w-full mt-5 ">
      <img class="rounded-[1rem] p-1 w-screen max-h-screen object-cover"
        src="{{ $article->image ? '/storage/' . $article->image : 'https://picsum.photos/640/480/?random=1' }}"
        alt="Article" />
    </div>
    <div class="title mt-10 sm:mt-5">
      <h1 class="text-3xl sm:text-lg font-bold">{{ $article->title }}</h1>
      <h2 class="text-lg sm:text-lg font-semibold mt-4">{{ $article->category->name }}</h2>
      {{-- name day --}}
      <p>{{ Carbon\Carbon::parse($article->created_at)->format('l, d F Y')
       }}</p>
    </div>
    <div class="body mt-10 mb-10">
      {!! $article->body !!}
    </div>
  </div>
@endsection
