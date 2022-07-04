@extends('template_backend_admin.app')
@section('subjudul','Data Peserta')
@section('content')
<table id="table-user" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Email</th>
      <th class="text-center">No HP</th>
      <th class="text-center">Provinsi</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
</table>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function () {
    $('#table-user').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{url('apilistuser')}}',
      columns: [
        {
           render: function (data, type, row, meta) {
             return meta.row + meta.settings._iDisplayStart + 1;
           },
           className: 'dt-body-center',
        },
        {
           data: 'nama',
           className: 'dt-body-center',
        },
        {
           data: 'email',
           className: 'dt-body-center'
        },
        {
           data: 'nohp',
           className: 'dt-body-center'
        },
        {
           data: 'provinsi',
           className: 'dt-body-center'
        },
        {
           "render": function ( data, type, row ) {
             return '<button class="btn btn-primary btn-sm" >Lihat</button>'
           },
           className: 'dt-body-center',
        }
      ],
    });
    
  });
</script>
@endsection