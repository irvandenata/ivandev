@extends('layouts.app')

@push('meta-tag')
  <meta charset="UTF-8">
  <meta name="description" content="Cari Materi Bahasa ingris yang kamu inginkan">
  <meta name="keywords" content="Cari Materi, adalah, Belajar Bahasa, Pengertian, bagaimana , mudah,">
  <meta name="author" content="Irvan Denata">
  <meta name=”robots” content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endpush
@push('style')
  <style>
  </style>
@endpush
@section('content')
  <div class="snap-madatory snap-center container min-h-screen mx-auto justify-center items-center" id="projects">
    <div class="w-full">
      <form class="static mt-32" action="{{ route('projects.search') }}" action="GET">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray">Search</label>
        <div class="relative -z-10">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </div>
          <input type="text" id="default-search" name="search"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border-2 border-gray  rounded-lg bg-gray-50  focus:border-primary focus:border-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-primary"
            placeholder="Search Name, Location ..." required>
          <button type="submit"
            class="text-black absolute end-2.5 bottom-2.5 bg-background hover:bg-blue-800 focus:border-2 focus:border-primary focus:outline-none  font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 ">Search</button>
        </div>
      </form>
    </div>
    <div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-y-10 gap-x-6 mt-10 ">
      @foreach ($projects as $item)
        <div
          class="max-w-sm bg-background border-2 border-gray rounded-lg hover:border-primary shadow dark:bg-gray-800 dark:border-gray-700 ">
          <a href="{{ route('blog.show', $item->slug) }}" class="">
            <img class="rounded-lg p-1" style="object-fit: cover;
            width: 100%;
            height: 185px;"  src="{{ asset('storage/' . $item->image) }}"zz alt="Article" />
          </a>
          <div class="p-5">
            <a href="{{ route('blog.show', $item->slug) }}" class="">
              <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->title }}</h5>
            </a>
            {{-- <p class="mb-3 font-thin text-sm text-gray-700 dark:text-gray-400">
              {!! $item->body !!}
            </p> --}}
            <a href="{{ route('blog.show', $item->slug) }}"
              class="inline-flex items-center p-2 text-sm font-medium bg-gray  text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:bg-primary hover:text-black">
              Read more
            </a>
          </div>
        </div>
      @endforeach
    </div>
    @if ($projects->count() < 1)
        <div class="flex flex-col items-center justify-center">
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white"> Sorry, we couldn't find any results for this
            search.</h1>
        </div>
    @endif

    <div class="w-full mt-10 mb-10 flex justify-center" id="pagination">
      {{ $projects->links() }}
      {{-- <nav aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-base h-10">
          <li>
            <a href="#"
              class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-background hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center  justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-background hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-background hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
          </li>
          <li>
            <a href="#" aria-current="page"
              class="flex items-center justify-center px-4 h-10 hover:bg-background text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-background hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-background hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-background hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
          </li>
        </ul>
      </nav> --}}
    </div>
  </div>
@endsection

@push('script')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let pagination = document.getElementById('pagination');
      let nav = pagination.getElementsByTagName('nav');
      //first child remove all class
      nav[0].firstElementChild.classList.remove('flex', 'justify-between', 'flex-1', 'sm:hidden');
      nav[0].firstElementChild.remove();
      let caption = pagination.querySelector('p.leading-5');
      caption.remove();
      let pageBtn = nav[0].querySelector('.relative').children;
      //where atribute aria-current = page
      let activeBtn = nav[0].querySelector('span[aria-current="page"]').firstElementChild;
      //remove class
      activeBtn.classList.remove('border-gray-300', 'bg-white');
      //add class
      activeBtn.classList.add('bg-background');

      //foreach pageBtn
      console.log(pageBtn);
      for (let i = 0; i < pageBtn.length; i++) {
        pageBtn[i].classList.add('hover:bg-primary');
      }
      let firstBtn = pageBtn[0];
      let lastBtn = pageBtn[pageBtn.length - 1];

    });
  </script>
@endpush
