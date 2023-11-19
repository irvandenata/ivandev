@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('style')
  <style>
    #datatable_filter {
      margin-bottom: 10px !important;
    }
  </style>
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card p-4">
        <div class="text-right">
          <div class="btn btn-success btn-sm mb-2" onclick="createItem()">Create Item</div>
          <div class="btn btn-warning btn-sm mb-2" onclick="reloadDatatable()">Reload Data</div>
        </div>
         <div class="">
          <table id="datatable" style="max-width:100% !important" class="table table-responsive dataTable m-t-30 w-full">
            <thead>
              <tr>
                <th width="10%">No</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Description</th>
                <th>Image</th>
                <th>show</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('admin.slider._form')
  </div>
@endsection

@push('js')

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('script')
  <script>
    let limitOrder = {{ $order + 1 }}
    let tempOrder = {{ $order }};
  </script>
  @include('utils.js')
  <script>
    $('.select-2').select2();
    let dataTable = $('#datatable').DataTable({
      dom: 'lBfrtip',
      responsive: true,
      processing: true,
      serverSide: true,
      searching: true,
      pageLength: 5,
      lengthMenu: [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      ajax: {
        url: child_url,
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          orderable: false
        },
        {
          data: 'title',
          orderable: true
        },
        {
          data: 'subtitle',
          orderable: true
        },
        {
          data: 'description',
          orderable: true
        },
        {
          data: 'image',
          orderable: false,
        },
        {
          data: 'show',
          orderable: false,
        },


        {
          data: 'action',
          name: '#',
          orderable: false
        },
      ]
    });
  </script>

  <script>
    function createItem() {
      setForm('create', 'POST', ('Create {{ $title }}'), true)
      $('#preview>img').addClass('d-none');
      $('#preview>img').attr('src', '');
    }

    function editItem(id) {
      limitOrder--;
      setForm('update', 'PUT', 'Edit {{ $title }}', true)
      editData(id)
    }

    function deleteItem(id) {
      deleteConfirm(id)

    }
  </script>

  <script>
    /** set data untuk edit**/
    function setData(result) {
      $('input[name=id]').val(result.id);
      $('input[name=title]').val(result.title);
      $('input[name=order]').val(result.order);
      $('input[name=subtitle]').val(result.subtitle);
      $('textarea[name=description]').val(result.description);
      $('#preview>img').removeClass('d-none');
      $('#preview>img').attr('src', "/storage/" + result.image);
    }


    /** reload dataTable Setelah mengubah data**/
    function reloadDatatable() {
      dataTable.ajax.reload();
    }

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

    function controlShow(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You will Change the Visibility of this Item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: child_url + '/' + id +'/change-show',
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        _method: 'PUT',
                    },
                    success: function(result) {
                        if (result.data) {
                            Swal.fire(
                                'Changed!',
                                'Your Item has been changed.',
                                'success'
                            )
                            reloadDatatable()
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Your Item has not been changed.',
                                'error'
                            )
                        }
                    }
                })
            }
        })
    }



    $('input[name=order]').on('change', function() {
      if ($(this).val() > limitOrder) {
        $(this).val(limitOrder)
      }
    })
    $('.close-modal').on('click', function() {
        limitOrder = tempOrder;
    })


  </script>
@endpush
