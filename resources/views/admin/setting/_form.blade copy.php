@extends('modul.modal')
@section('input-form')
	<div class="form-group">
		<div class="form-line">
			<label for="name">Config Key </label>

			<input type="text" name="config_key" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Config Value</label>
			<input type="text" name="config_value" class="form-control" required>
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="name">Config Group</label>
			<input type="text" name="config_group" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="config_value">Priority</label>
			<select class="form-control show-tick priority" name="priority" id="typeID" required>
				<option value selected disabled>== Pilih Item ==</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="form-line">
			<label for="description">Description</label>
			<textarea name="description" class="form-control desc" rows="10" required></textarea>
		</div>
	</div>

	{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar (Ukuran Kotak Maks. 2MB)</label>
        <input type="file" name="file" class="form-control">
    </div>
</div> --}}


	{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="theme" class="form-control">
    </div>
</div> --}}

	{{-- <div class="form-group">
   <label for="type">Pilih Salah Satu</label>
   <select class="form-control show-tick" name="type_id" id="typeID" required>
      <option disabled selected value>---- Pilih Salah Satu ----</option>
@foreach ($type as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
@endforeach
   </select>
</div> --}}
@endsection
