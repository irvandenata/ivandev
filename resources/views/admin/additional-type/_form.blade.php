@extends('utils.modal')
@section('modal-size', 'modal-lg')
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
        <label for="name">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
      </div>
    </div>
  </div>
@endsection
