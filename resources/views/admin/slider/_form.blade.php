@extends('utils.modal')
@section('modal-size', 'modal-lg')
@section('input-form')
  <div class="row">
    <div class="form-group mb-1 col-6">
      <div class="form-line">
        <label for="name">Title</label>
        <input type="text" name="title" class="form-control" required>
      </div>
    </div>
    <div class="form-group mb-1 col-6">
      <div class="form-line">
        <label for="name">Order</label>
        <input type="number" name="order" class="form-control" min="0" value="{{ $order+1 }}" required>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Subtitle</label>
        <input type="text" name="subtitle" class="form-control" required>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Description</label>
        <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Image</label>
        <input type="file" name="image" accept="image/png, image/gif, image/jpeg" class="form-control" onchange="preview(this)">
      </div>
    </div>
    <div id="preview" class="col-12">
      <img src="" class="d-none" width="100%" alt="">
    </div>
  </div>

  {{-- <div class="form-group">
   <label for="type">Pilih Provinsi</label>
   <br>
   <select class="form-control select-2" name="province_id" id="province" required>
      <option disabled selected value>---- Pilih Salah Satu ----</option>
@foreach ($provinces as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
@endforeach
   </select>
</div> --}}
@endsection
