@extends('template_backend_admin.app')
@section('subjudul','Bank Soal SKD')
@section('content')
<div class="col-sm-12 mb-6">
    <div class="d-flex justify-content-between">
        <div class="col-sm-2 ">
            <a href="#" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#modalBuatPaket" id="tblBuatPaket">Buat Paket</a>
        </div>
        <div class="col-sm-3 ml-2">
            <select class="form-select form-select-solid border border-info filter-ju" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Ujian" name="instansi">
                <option value="">Pilih Jenis Ujian...</option>
                <option value="2">Tryout Akbar</option>
                <option value="1">Tryout Mandiri</option>
                <option value="3">Latihan Soal</option>           
            </select>
        </div>  
        <div class="col-sm-3">
            <select class="form-select form-select-solid border border-info filter-js" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Soal" name="instansi">
                <option value="">Pilih Jenis Soal...</option>
                <option>TIU</option>
                <option>TWK</option>
                <option>TKP</option>            
            </select>
        </div>
        <div class="col-sm-2 ">
            <a href="{{url('allskd')}}" class="btn btn-dark btn-sm" id="tblBuatPaket">Bank Soal</a>
        </div>
    </div>
    
</div>
<!-- &nbsp -->
    <div class="card-body mt-3">
        <div class="col-md-12">
            <table id="table-bankskd" class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Paket</th>
                        <th class="text-center">Waktu</th>
                        <th class="text-center">Jenis Ujian</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

<!--begin::Modal - View Users-->
<div class="modal fade in" id="modalBuatPaket" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Buat Paket Soal SKD</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5 mb-7">Tekan tombol Generate untuk membuat paket soal
                    <strong class="link-primary fw-bolder">SKD</strong></div>
                    <form id="form-buat-paket" class="form" >
						<!-- {{ csrf_field() }} -->

							<!--begin::Input group-->
							<div class="d-flex flex-column  fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Nama Paket</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama Paket"></i>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid border border-success" id="namapaket" placeholder="Masukkan Nama Paket" name="namapaket" />
							</div>
                            <div class="d-flex flex-column  fv-row mt-2">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Jenis Ujian</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis Ujian"></i>
								</label>
									<select class="form-select form-select-solid border border-success drdn" id="jenisujian" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Ujian" name="jenisujian">
										<option value="">Pilih Jenis Ujian...</option>
										<option value="1">Tryout Mandiri</option>
                                        <option value="2">Tryout Akbar</option>
										<option value="3">Latihan Soal</option>
									</select>
							</div>
                            <div class="d-flex flex-column  fv-row mt-2 subm" style="display:none">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Submateri</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Submateri"></i>
								</label>
									<select class="form-select form-select-solid drdn" id="filter-submateri" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Submateri" name="submateri">
										<option value="">Pilih Submateri...</option>
										@foreach($sm as $item)
                                        <option value="{{$item->id_sms}}">{{$item->submateri_soal}}</option>
                                        @endforeach
									</select>
							</div>
                            <div class="d-flex flex-column  fv-row mt-2 subm" style="display:none">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Jumlah Soal</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jumlah Soal"></i>
								</label>
									<select class="form-select form-select-solid drdn" id="jumlahsoal" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jumlah Soal" name="jumlahsoal">
										<option value="">Pilih Jumlah Soal...</option>
										<option>10</option>
                                        <option>15</option>
                                        <option>20</option>
                                        <option>25</option>
                                        <option>30</option>
									</select>
							</div>
                            <div class="d-flex flex-column mt-2 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Kode Paket</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Kode Paket"></i>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid border border-success" id="kodepaket" placeholder="Masukkan Kode Paket" name="kodepaket" />
							</div>

							<label class="d-flex align-items-center fs-6 fw-bold mb-2 mt-2">
									<span class="required">Waktu Ujian (Menit)</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Waktu Ujian"></i>
								</label>
									<select class="form-select form-select-solid border border-success drdn" id="waktuujian" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jumlah Waktu Ujian (Menit)" name="waktuujian">
										<option value="">Pilih Jumlah Waktu Ujian... (Menit)</option>
										<option>20</option>
                                        <option>30</option>
										<option>40</option>
                                        <option>50</option>
                                        <option>100</option>
									</select>
							</div>
                            </form>
                            <div class="d-flex justify-content-between">
                    <!--begin::Label-->
                    <button class="btn btn-dark mx-auto" id="tblgenerate" data-bs-toggle="modal" data-bs-target="#modalDetailPaket">Generate</button>
                    <!--end::Switch-->
                </div>
                    <!--end::Description-->
                </div>
                
                <!--end::Notice-->

            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - View Users-->

<!--begin::Modal - View Users-->
<div class="modal fade in" id="modalDetailPaket" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <div class="text-center mb-13">
                    <h1 class="mb-3">Detail Paket Soal SKD</h1>
                </div>
                <div class="col-md-12">
                    <table id="table-dtlsoal" class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">No</th>
                                <th class="text-center">Soal</th>
                                <th class="text-center">Jawaban</th>
                                <th class="text-center">Sub Materi</th>
                                <th class="text-center">Materi</th>
                                <th class="text-center">Jenis Soal</th>
                                <th class="text-center">Detail</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                
            </div>
            <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-dark" id="gnrt">Generate</button>
                    <button class="btn btn-success" id="buatpaket">Buat</button>
                    <button class="btn btn-danger closemodal" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="modalDetailSoal" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                <div class="text-center mb-5">
                    <h1 class="mb-3">Detail Paket Soal SKD</h1>
                </div>
            </div>
            <div class="mx-auto col-md-8">
                <table class="table table-stripped">
                    
                        <tr>
                            <th>Jenis Soal</th>
                            <td id="jenissoal"></td>
                        </tr>
                        <tr>
                            <th>Materi</th>
                            <td id="materi"></td>
                        </tr>
                        <tr>
                            <th>Submateri</th>
                            <td id="submateri"></td>
                        </tr>
                        <tr>
                            <th>Soal</th>
                            <td id="soal"></td>
                        </tr>
                        <tr>
                            <th>A</th>
                            <td id="a"></td>
                        </tr>
                        <tr>
                            <th>B</th>
                            <td id="b"></td>
                        </tr>
                        <tr>
                            <th>C</th>
                            <td id="c"></td>
                        </tr>
                        <tr>
                            <th>D</th>
                            <td id="d"></td>
                        </tr>
                        <tr>
                            <th>E</th>
                            <td id="e"></td>
                        </tr>
                        <tr>
                            <th>Jawaban</th>
                            <td id="jawaban"></td>
                        </tr>
                        <tr>
                            <th>Ket Jawaban</th>
                            <td id="ketjawaban"></td>
                        </tr>
                        
                </table>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-danger closemodaldtlsoal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
	
<!--begin::Page Custom Javascript(used by this page)-->
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/modals/create-app.js"></script>
<script src="assets/js/custom/modals/upgrade-plan.js"></script>
<!--end::Page Custom Javascript-->
<script type="text/javascript">
  $(document).ready(function () {
      var jenis
    $('.filter-ju').on('change', function () {
        jenis = $(this).val()
        console.log(jenis)
        table.ajax.url(api + "/" + jenis)
        table.ajax.reload();
    });

    var api = '{{url('apibankskd')}}'
    var jns = 0
     var table = $('#table-bankskd').DataTable({
      processing: true,
      serverSide: true,
    //   data: {
    //     jenissoal: jenis
    //   },
      ajax: api + "/" + jenis,
      columns: [
        {
           data: 'id_paket_tryout',
           className: 'dt-body-center',
           visible: false
        },
        {
           render: function (data, type, row, meta) {
             return meta.row + meta.settings._iDisplayStart + 1;
           },
           className: 'dt-body-center',
        },
        {
           data: 'kode',
           className: 'dt-body-center'
        },
        {
           data: 'nama_paket',
           className: 'dt-body-center'
        },
        {
           data: 'waktu',
           className: 'dt-body-center'
        },
        {
           data: 'jenis_ujian',
           className: 'dt-body-center'
        },
        
        {
           "render": function ( data, type, row ) {
             return '<button class="btn btn-primary btn-sm dtlsoal" data-id="'+ row.id_paket_tryout +'"  data-bs-toggle="modal" data-bs-target="#modalDetailPaket">Detail</button>'
           },
           className: 'dt-body-center'
        }
      ]
    });

    $('#tblBuatPaket').click(function () {
        $("#form-buat-paket").trigger("reset")
        $(".drdn").val('').trigger('change')
        // $("#submateri").val('').trigger('change')
        // $("#waktuujian").val('').trigger('change')
        console.log("resetttt")
    });

    $(".filter-js").hide();
    $('body').on('change', '.filter-ju', function() {
        if($(this).val() == "Latihan Soal"){
            $(".filter-js").show();
        }else{
            $(".filter-js").hide();
        }
    });
    $(".subm").addClass("display","none");
    $('body').on('change', '#jenisujian', function() {
        console.log($(this).val())
        if($(this).val() == 3){
            console.log("trueee")
            $("#filter-submateri").addClass('border border-success');
            $("#filter-submateri").removeClass('border border-light');
            $("#filter-submateri").attr("disabled", false);

            $("#jumlahsoal").addClass('border border-success');
            $("#jumlahsoal").removeClass('border border-light');
            $("#jumlahsoal").attr("disabled", false);
        }else{
            $("#filter-submateri").addClass('border border-light');
            $("#filter-submateri").removeClass('border border-success');
            $("#filter-submateri").attr("disabled", true);

            $("#jumlahsoal").addClass('border border-light');
            $("#jumlahsoal").removeClass('border border-success');
            $("#jumlahsoal").attr("disabled", true);
        }
    });
    $('body').on('click', '.modalBuatPaket', function() {
        $('#kt_modal_view_users').addClass('in','show');
    });
    var dataSoal;
    var arrId = [];
    var valformbuatpaket;
    var arr = [];

    function generateSoal(){

        var valju = $('#jenisujian').val()
        var valsm = $('#filter-submateri').val()
        if(valsm == ""){
            valsm = "null"
        }

        $.ajax({
            url: "{{url('apitoskd')}}?ju="+valju+"&submateri="+valsm, 
            type: "get",
            success: function(data) {
                dataSoal = data.data
                // console.log("masok")
                valformbuatpaket = $('#form-buat-paket').serialize();
                
                var a = 0
                for(var r = 0;r < dataSoal.length; r++){
                    var id = dataSoal[r].id_soal
                    arr.push(id)
                }

            },
            error: function(data) { 
                // console.log(data)    
            }
        });

        var jumlahsoal = 0
        $('#jumlahsoal').val() == "" ? jumlahsoal = 15 : jumlahsoal = parseInt($('#jumlahsoal').val())

        $('#table-dtlsoal').DataTable().clear().destroy();
        $('#table-dtlsoal').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('apitoskd')}}?ju="+valju+"&submateri="+valsm+"&jumlahsoal="+jumlahsoal,
        data: {
            ju : valju,
            submateri : valsm,
            jumlahsoal : jumlahsoal
        },
        columns: [
            {
            data: 'id_soal',
            className: 'dt-body-center',
            visible: false
            },
            {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            className: 'dt-body-center',
            },
            {
            data: 'soal',
            className: 'dt-body-center'
            },
            {
            data: 'jawaban',
            className: 'dt-body-center'
            },
            {
            data: 'submateri_soal',
            className: 'dt-body-center'
            },
            {
            data: 'materi_soal',
            className: 'dt-body-center'
            },
            {
            data: 'jenissoal',
            className: 'dt-body-center'
            },
            {
                "render": function ( data, type, row ) {
                    return '<button class="btn btn-primary btn-sm tblDtlSoal" data-id="'+ row.id_soal +'">Detail Soal</button>'
                },
            className: 'dt-body-center'
            }
        ]
        });
    }
    var arrayform
    $('#tblgenerate').click(function () {        
        generateSoal()
        
        arrayform = {
            "nama": $('#namapaket').val(),
            "waktu": $('#waktuujian').val(),
            "jenis": $('#jenisujian').val(),
            "kode" :$('#kodepaket').val()
        }
        console.log(arrayform)
    });
    $('#gnrt').click(function () {
        generateSoal()

                       
    });
    $('#buatpaket').click(function () {
        // console.log(dataSoal)
        Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin membuat paket ini ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: `Buat`,
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: "POST", 
                            dataType: 'json',
                            url: "{{ url('/buatpaketskd') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "soal": arr,
                                "formpaket" : arrayform
                            }, 
                            success: function(result) {
                                // console.log(result)
                                table.ajax.reload()
                               if(result.status == 'success'){
                                    Swal.fire({
                                        title: "Berhasil",
                                        text: "Paket berhasil dibuat",
                                        icon: "success",
                                        showCancelButton: false,
                                        confirmButtonText: `Ok`,
                                    });
                               }else{
                                    Swal.fire({
                                        title: "Gagal",
                                        text: "Paket gagal dibuat",
                                        icon: "error",
                                        showCancelButton: false,
                                        confirmButtonText: `Ok`,
                                    });
                               }
                               $('#modalBuatPaket').modal("hide");
                                $('#modalDetailPaket').modal("hide");
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire("Error!", xhr + " " + ajaxOptions + " " +
                                    thrownError,
                                    "error");
                            }
                        });
                    } else {
                        return false;
                    }
                });
    });

    $('.closemodal').click(function () {
        $('#modalDetailPaket').modal('hide')
        $('#modalBuatPaket').modal('hide')
        console.log("harusne nutup")

    });
    $('.closemodaldtlsoal').click(function () {
        $('#modalDetailSoal').modal('hide')

    });

    $(document).on('click', '.dtlsoal', function() {            
        // console.log("aaaaaaaa")
        console.log("idpkt")
        var idpkt = $(this).data('id');
        $('#modalDetailPaket').modal('show')
        $('#table-dtlsoal').DataTable().clear().destroy();
        $('#table-dtlsoal').DataTable({
        processing: true,
        serverSide: true,
        // dataType: 'json',
        // dataSrc: "soal",
        ajax: '{{url('detailpaket')}}/' + idpkt,
        columns: [
            {
            data: 'id_soal',
            className: 'dt-body-center',
            visible: false
            },
            {
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
            className: 'dt-body-center',
            },
            {
                data: 'soal',
                className: 'dt-body-center'
            },
            {
                data: 'jawaban',
                className: 'dt-body-center'
            },
            {
                data: 'submateri_soal',
                className: 'dt-body-center'
            },
            {
                data: 'materi_soal',
                className: 'dt-body-center'
            },
            {
                data: 'jenissoal',
                className: 'dt-body-center'
            },
            {
                "render": function ( data, type, row ) {
                    return '<button class="btn btn-primary btn-sm tblDtlSoal" data-id="'+ row.id_soal +'">Detail Soal</button>'
                },
            className: 'dt-body-center'
            }
        ]
        });
    });

    $('body').on('click', '.tblDtlSoal', function() {
        // $('#modalDetailSoal').addClass('in','show');
        var id = $(this).data('id');
        console.log(id)
        $('#modalDetailSoal').modal('show')
        $.ajax({
            url: "{{url('detailsoal')}}/" + id, 
            type: "get",
            success: function(data) {

                console.log(data)
                $('#soal').html(data.data.soal)
                $('#a').html(data.data.a)
                $('#b').html(data.data.b)
                $('#c').html(data.data.c)
                $('#d').html(data.data.d)
                $('#e').html(data.data.e)
                $('#jawaban').html(data.data.jawaban)
                $('#ketjawaban').html(data.data.ket_jawaban)
                $('#jenissoal').html(data.data.jenissoal)
                $('#materi').html(data.data.materi_soal)
                $('#submateri').html(data.data.submateri_soal)

            },
            error: function(data) { 
                // console.log(data)    
            }
        });
    });
    
  });
</script>
@endsection
