@extends('utils.modal')
@section('modal-size', 'modal-md')
@section('input-form')
  <div class="row">
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
        <div class="form-line">
          <label for="name">Location</label>
          <input type="text" name="location" class="form-control" required>
        </div>
      </div>
  </div>
@endsection
