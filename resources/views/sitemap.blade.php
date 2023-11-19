@extends('layouts.app')
@push('meta-tag')
<meta charset="UTF-8">
<meta name="description" content="Cari Materi Bahasa ingris yang kamu inginkan">
<meta name="keywords" content="Cari Materi, adalah, Belajar Bahasa, Pengertian, bagaimana , mudah, gratis, latihan, toefl,ITP,IBT,Test,tes ">
<meta name="author" content="Irvan Denata">
<meta name=”robots” content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endpush
@push('style')
  <style>
    .hero-header {
      padding: 10rem 0 6rem 0 !important;
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    .img-fluid {
      width: 100% !important;
      object-fit: cover;
      height: 400px !important;
      border-radius: 10px;
    }

    .navbar-light {
      background-color: var(--dark) !important;
    }
    .sticky-top.navbar-light .navbar-nav .nav-link{
        color: var(--light) !important;
    }
  </style>
@endpush
@section('content')
<div class="container-xxl position-relative p-0 " id="main">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
      <a href="/" class="navbar-brand p-0">
        <h1 class="m-0">{{ env('APP_NAME') }}</h1>
        <!-- <img src="{{ asset('landing') }}/img/logo.png" alt="Logo"> -->
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
      <div class="collapse navbar-collapse flex-row-reverse" id="navbarCollapse">
        <div class="navbar-nav py-0">
          <a href="/" class="nav-item nav-link text-white">Beranda</a>
          <a href="/blog" class="nav-item nav-link active">Blog</a>
        </div>
      </div>
    </nav>
  </div>
<div class="container" style="padding-top:200px">
    <div class="row">
        <h1>Sitemap Link</h1>
        <a href="/">Beranda</a><br>
        <a href="/blog">Cari Materi</a><br>
        @foreach ($sitemap as $item)
        <a href="/blog/{{ $item['slug'] }}">{{ $item['title'] }}</a><br>
        @endforeach
    </div>
</div>
@endsection
