@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('style')
@endpush

@section('content')
  <div class="row">
    <div class="col-xl-12 col-xxl-12 ">
      <div class="w-100">
        <div class="row">
          <div class="col-12">
            <form action="{{ route('admin.users.update',auth()->user()->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card p-4">
                <div class="row">
                  <div class="col-12 mt-4">
                    <input type="file" name="image" class="form-group mb-3 preview">
                    <div style="width: 100%"  class="m-4 text-center" id="preview">
                      <img src="{{ auth()->user()->image_profile? '/storage/'.auth()->user()->image_profile: asset('assets/img/no-image.png') }}" style="width: 20%;" class="mx-auto"
                        alt="">
                    </div>
                  </div>
                  <div class="col-6 mt-4">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                  </div>
                  <div class="col-6 mt-4">
                    <label for="">Motto</label>
                    <input type="text" name="motto" class="form-control" value="{{ auth()->user()->motto }}">
                  </div>
                  <div class="col-6 mt-4">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                  </div>
                  <div class="col-6 mt-4">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div class="col-12 mt-4">
                    <label for="">Description</label>
                    <textarea name="description" id="myeditorinstance"  cols="30" rows="10" class="form-control" >{{ auth()->user()->description }}</textarea>
                  </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/i1nnds4l5jeoaufjhsu6l45pa8zxzdwc4vwh9dktv8d5gig4/tinymce/6/tinymce.min.js"
  referrerpolicy="origin"></script>
@endpush

@push('script')
  @include('utils.js')

  <script>
    tinymce.init({
      selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
      plugins: 'code table lists',
      toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
    $('.preview').on('change', function() {
      preview(this)
    })

    function preview(e) {
      if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#preview>img').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
        $('#preview>img').removeClass('d-none');
      }
    }
  </script>
@endpush
