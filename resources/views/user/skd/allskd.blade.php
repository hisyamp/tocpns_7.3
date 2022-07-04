@extends('template_backend_admin.app')
@section('subjudul','Bank Soal SKD')
@section('content')
<div class="col-sm-12 mb-6">
    <div class="d-flex justify-content-between">
    <div class="d-flex flex-column  fv-row mt-2 subm" style="display:none">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
									<span class="required">Submateri</span>
									<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Submateri"></i>
								</label>
									<select class="form-select form-select-solid drdn" id="filter-submateri" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Submateri" name="submateri">
										<option value="">Pilih Submateri...</option>
										@foreach($sm as $item)
                                        <option>{{$item->submateri_soal}}</option>
                                        @endforeach
									</select>
							</div>
        <!-- <div class="col-sm-3 ml-2">
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
        </div> -->
        <div class="col-sm-2 ">
            <button class="btn btn-dark btn-sm" id="tblSoalGbr">+ Soal Bergambar</button>
            <button class="btn btn-dark btn-sm mt-2" id="tblSoalCrt">+ Soal Cerita</button>
        </div>
    </div>
    
</div>
<div class="card-body mx-auto">
        <div class="col-md-12">
            <table id="table-bankskd" class="table table-stripped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">No</th>
                        <th class="text-center">Soal</th>
                        <th class="text-center">Gambar Soal</th>
                        <th class="text-center">Jawaban</th>
                        <th class="text-center">Ket Jawaban</th>
                        <th class="text-center">Materi</th>
                        <th class="text-center">Submateri</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>
            </table>
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
                    <h1 class="mb-3">Detail Paket Soal SKB</h1>
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
                        <tr id="rowgs">
                            <th>GambarSoal</th>
                            <td><img id="gs" alt=""></td>
                        </tr>
                        <tr>
                            <th>A</th>
                            <td id="a"></td>
                        </tr>
                        <tr id="rowga">
                            <th>Gambar Jawaban A</th>
                            <td><img id="ga" alt=""></td>
                        </tr>
                        <tr>
                            <th>B</th>
                            <td id="b"></td>
                        </tr>
                        <tr id="rowgb">
                            <th>Gambar Jawaban B</th>
                            <td><img id="gb" alt=""></td>
                        </tr>
                        <tr>
                            <th>C</th>
                            <td id="c"></td>
                        </tr>
                        <tr id="rowgc">
                            <th>Gambar Jawaban C</th>
                            <td><img id="gc" alt=""></td>
                        </tr>
                        <tr>
                            <th>D</th>
                            <td id="d"></td>
                        </tr>
                        <tr id="rowgd">
                            <th>Gambar Jawaban D</th>
                            <td><img id="gd" alt=""></td>
                        </tr>
                        <tr>
                            <th>E</th>
                            <td id="e"></td>
                        </tr>
                        <tr id="rowge">
                            <th>Gambar Jawaban E</th>
                            <td><img id="ge" alt=""></td>
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

<div class="modal fade in" id="modalTbhCrt" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form id="form-soal" name="form-soal" enctype="multipart/form-data">
                @csrf
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
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0">
                        <div class="text-center">
                            <h1>Tambah Soal Cerita</h1>
                        </div>
                            <form id="form-cerita" name="form-cerita" method="POST">
                                
                                    <div class="d-flex flex-column fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-bold">
                                            <span class="required">Soal Cerita</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                        </label>
                                        <textarea name="soalcerita" id="soalcerita" cols="30" rows="10" class="form-control form-control-solid border border-success"></textarea>
                                     
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-dark tombolsoal" id="tombolsoal1" onclick="showKotakSoal(1)">1</div>&nbsp
                                        <div class="btn btn-dark tombolsoal" id="tombolsoal2" onclick="showKotakSoal(2)">2</div>&nbsp
                                        <div class="btn btn-dark tombolsoal" id="tombolsoal3" onclick="showKotakSoal(3)">3</div>&nbsp
                                        <div class="btn btn-dark tombolsoal" id="tombolsoal4" onclick="showKotakSoal(4)">4</div>
                                    
                                    </div>
                                    <div id="kotaksoal1">
                                        <br>
                                            <center>
                                                <h1>Soal 1</h1>
                                            </center>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Soal</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="soal1" class="form-control form-control-solid border border-success" id="soal1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban A</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabana1" class="form-control form-control-solid border border-success" id="jawabana1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban B</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanb1" class="form-control form-control-solid border border-success" id="jawabanb1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban C</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanc1" class="form-control form-control-solid border border-success" id="jawabanc1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban D</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaband1" class="form-control form-control-solid border border-success" id="jawaband1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban E</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabane1" class="form-control form-control-solid border border-success" id="jawabane1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaban1" class="form-control form-control-solid border border-success" id="jawaban1">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Keterangan Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Keterangan Jawaban"></i>
                                            </label>
                                            <textarea name="ketjawaban1" id="ketjawaban1" cols="30" rows="10" class="form-control form-control-solid border border-success"></textarea>
                                        </div>
                                    </div>
                                    <div id="kotaksoal2">
                                        <br>
                                            <center>
                                                <h1>Soal 2</h1>
                                            </center>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Soal</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="soal2" class="form-control form-control-solid border border-success" id="soal2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban A</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabana2" class="form-control form-control-solid border border-success" id="jawabana2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban B</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanb2" class="form-control form-control-solid border border-success" id="jawabanb2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban C</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanc2" class="form-control form-control-solid border border-success" id="jawabanc2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban D</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaband2" class="form-control form-control-solid border border-success" id="jawaband2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban E</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabane2" class="form-control form-control-solid border border-success" id="jawabane2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaban2" class="form-control form-control-solid border border-success" id="jawaban2">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Keterangan Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Keterangan Jawaban"></i>
                                            </label>
                                            <textarea name="ketjawaban2" id="ketjawaban2" cols="30" rows="10" class="form-control form-control-solid border border-success"></textarea>
                                        </div>
                                    
                                    </div>
                                    <div id="kotaksoal3">
                                        <br>
                                            <center>
                                                <h1>Soal 3</h1>
                                            </center>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Soal</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="soal3" class="form-control form-control-solid border border-success" id="soal3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban A</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabana3" class="form-control form-control-solid border border-success" id="jawabana3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban B</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanb3" class="form-control form-control-solid border border-success" id="jawabanb3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban C</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanc3" class="form-control form-control-solid border border-success" id="jawabanc3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban D</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaband3" class="form-control form-control-solid border border-success" id="jawaband3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban E</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabane3" class="form-control form-control-solid border border-success" id="jawabane3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaban3" class="form-control form-control-solid border border-success" id="jawaban3">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Keterangan Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Keterangan Jawaban"></i>
                                            </label>
                                            <textarea name="ketjawaban3" id="ketjawaban3" cols="30" rows="10" class="form-control form-control-solid border border-success"></textarea>
                                        </div>
                                    </div>
                                    <div id="kotaksoal4">
                                        <br>
                                            <center>
                                                <h1>Soal 4</h1>
                                            </center>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Soal</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="soal4" class="form-control form-control-solid border border-success" id="soal4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban A</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabana4" class="form-control form-control-solid border border-success" id="jawabana4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban B</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanb4" class="form-control form-control-solid border border-success" id="jawabanb4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban C</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabanc4" class="form-control form-control-solid border border-success" id="jawabanc4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban D</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaband4" class="form-control form-control-solid border border-success" id="jawaband4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban E</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawabane4" class="form-control form-control-solid border border-success" id="jawabane4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                                            </label>
                                            <input type="text" name="jawaban4" class="form-control form-control-solid border border-success" id="jawaban4">
                                        </div>
                                        <br>
                                        <div class="d-flex flex-column fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold">
                                                <span class="required">Keterangan Jawaban</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Keterangan Jawaban"></i>
                                            </label>
                                            <textarea name="ketjawaban4" id="ketjawaban4" cols="30" rows="10" class="form-control form-control-solid border border-success"></textarea>
                                        </div>
                                    
                                    </div>
                                    <br>
                                        <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn btn-danger closemodaldtlsoal" data-dismiss="modal">Batal</button>
                                                <button class="btn btn-success" id="submitcerita">Submit</button>
                                        </div>
                                </div>
                        </form>
                </div>
                    
                        
            </form>
            </div>
            </div>
</div>

<div class="modal fade in" id="modalTbhGbr" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <form id="form-soal" name="form-soal" enctype="multipart/form-data">
                @csrf
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
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0">
                    <div class="text-center mb-5">
                        <h1 class="mb-3">Tambah Soal Bergambar</h1>
                    </div>
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Soal</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama Paket"></i>
                            </label>
                            <input type="file" id="input-soal" name="gambarsoal">
                            <div style="display:inline">
                                <img id="img_soal" class="preview-soal" alt="" height="150px" width="150px">
                                <div class="btn btn-danger btn-sm preview-soal" id="rmv-soal">x</div>
                            </div>
                            <br>
                            <input type="text" class="form-control form-control-solid border border-success" id="soal" placeholder="Soal" name="soal" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Jawaban A</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban A"></i>
                            </label>
                            <input type="file" id="jawaban-a" name="jawaban-a">
                            <div style="display:inline">
                                <img id="img_jwb_a" class="preview-jwb-a" alt="" height="150px" width="150px">
                                <div class="btn btn-danger btn-sm preview-jwb-a" id="rmv-jwb-a">x</div>
                            </div>
                            <br>
                            <input type="text" class="form-control form-control-solid border border-success" id="a" placeholder="Jawaban A" name="a" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Jawaban B</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban B"></i>
                            </label>
                            <input type="file" id="jawaban-b" name="jawaban-b">
                            <div style="display:inline">
                                <img id="img_jwb_b" class="preview-jwb-b" alt="" height="150px" width="150px">
                                <div class="btn btn-danger btn-sm preview-jwb-b" id="rmv-jwb-b">x</div>
                            </div>
                            <br>
                            <input type="text" class="form-control form-control-solid border border-success" id="b" placeholder="Jawaban B" name="b" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Jawaban C</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban C"></i>
                            </label>
                            <input type="file" id="jawaban-c" name="jawaban-c">
                            <div style="display:inline">
                                <img id="img_jwb_c" class="preview-jwb-c" alt="" height="150px" width="150px">
                                <div class="btn btn-danger btn-sm preview-jwb-c" id="rmv-jwb-c">x</div>
                            </div>
                            <br>
                            <input type="text" class="form-control form-control-solid border border-success" id="c" placeholder="Jawaban C" name="c" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Jawaban D</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban D"></i>
                            </label>
                            <input type="file" id="jawaban-d" name="jawaban-d">
                            <div style="display:inline">
                                <img id="img_jwb_d" class="preview-jwb-d" alt="" height="150px" width="150px">
                                <div class="btn btn-danger btn-sm preview-jwb-d" id="rmv-jwb-d">x</div>
                            </div>
                            <br>
                            <input type="text" class="form-control form-control-solid border border-success" id="d" placeholder="Jawaban D" name="d" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Jawaban E</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban E"></i>
                            </label>
                            <input type="file" id="jawaban-e" name="jawaban-e">
                            <div style="display:inline">
                                <img id="img_jwb_e" class="preview-jwb-e" alt="" height="150px" width="150px">
                                <div class="btn btn-danger btn-sm preview-jwb-e" id="rmv-jwb-e">x</div>
                            </div>
                            <br>
                            <input type="text" class="form-control form-control-solid border border-success" id="e" placeholder="Jawaban E" name="e" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Jawaban</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid border border-success" id="jawaban" placeholder="Jawaban" name="jawaban" />
                        </div>
                        <br>
                        <div class="d-flex flex-column fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Keterangan Jawaban</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jawaban"></i>
                            </label>
                            <textarea name="ket_jawaban" id="ket_jawaban" class="form-control form-control-solid border border-success" cols="30" rows="10" placeholder="Keterangan Jawaban"></textarea>
                            <!-- <input type="text" class="form-control form-control-solid border border-success" id="jawaban" placeholder="Jawaban" name="jawaban" /> -->
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-danger closemodaldtlsoal" data-dismiss="modal">Batal</button>
                                <div class="btn btn-success" id="submitdata">Submit</div>
                        </div>
                    </div>
                </div>
                    
                        
            </form>
        </div>
</div>





@endsection
@section('script')
<script>
     function showKotakSoal(a){
                if(a == 1){
                    $("#kotaksoal1").show()
                    $("#kotaksoal2,#kotaksoal3,#kotaksoal4").hide()
                    $("#tombolsoal1").addClass("btn-danger").removeClass("btn-dark")
                    $("#tombolsoal2,#tombolsoal3,#tombolsoal4").addClass("btn-dark").removeClass("btn-danger")
                }else if(a == 2){
                    $("#kotaksoal2").show()
                    $("#kotaksoal1,#kotaksoal3,#kotaksoal4").hide()
                    $("#tombolsoal2").addClass("btn-danger").removeClass("btn-dark")
                    $("#tombolsoal1,#tombolsoal3,#tombolsoal4").addClass("btn-dark").removeClass("btn-danger")
                }else if(a == 3){
                    $("#kotaksoal3").show()
                    $("#kotaksoal2,#kotaksoal1,#kotaksoal4").hide()
                    $("#tombolsoal3").addClass("btn-danger").removeClass("btn-dark")
                    $("#tombolsoal2,#tombolsoal1,#tombolsoal4").addClass("btn-dark").removeClass("btn-danger")
                }else if(a == 4){
                    $("#kotaksoal4").show()
                    $("#kotaksoal2,#kotaksoal3,#kotaksoal1").hide()
                    $("#tombolsoal4").addClass("btn-danger").removeClass("btn-dark")
                    $("#tombolsoal2,#tombolsoal3,#tombolsoal1").addClass("btn-dark").removeClass("btn-danger")
                }
            }
    $(document).ready(function() {
       
           $.ajaxSetup({   
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

            var table = $('#table-bankskd').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url('apiallskd')}}",
                // data: {
                //     ju : valju,
                //     submateri : valsm,
                // },
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
                        "render": function ( data, type, row ) {
                            var a = row.gambar_soal == null ? "-" : '<img src="uploads/soalgambar/' + row.gambar_soal + '" height="35px" width="35px"/>'
                            return a
                        },
                        className: 'dt-body-center'
                    },
                    {
                    data: 'jawaban',
                    className: 'dt-body-center'
                    },
                    {
                    data: 'ket_jawaban',
                    className: 'dt-body-center'
                    },
                    {
                        data: 'materi_soal',
                        className: 'dt-body-center'
                    },
                    {
                    data: 'submateri_soal',
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
            $('#filter-submateri').change(function () {
                table.column(7)
                .search("^" + $(this).val() + "$", true, false, true)
                .draw();
            });
            $('#tblSoalGbr').click(function () {
                    console.log("bbbbb");
                    $('#modalTbhGbr').modal('show')
                
            });
            
            
            $('#tblSoalCrt').click(function () {
                    console.log("bbbbb");
                    $('#modalTbhCrt').modal('show')
                    showKotakSoal(1)
            });
            $('body').on('click', '.tblDtlSoal', function() {
                // console.log($(this).attr('data-id'))
                var id = $(this).attr('data-id')
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
                        if(data.data.gambar_soal == null){
                            $("#rowgs").hide()
                            $("#gs").hide()
                        }else{
                            $("#rowgs").show()
                            $("#gs").show()
                            $("#gs").attr("src", "uploads/soalgambar/"+data.data.gambar_soal)
                            $('#gs').css(
                                                {
                                                    "width": "150px",
                                                    "height:":'auto',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                        if(data.data.gambar_a == null){
                            $("#rowga").hide()
                            $("#ga").hide()
                        }else{
                            $("#rowga").show()
                            $("#ga").show()
                            $("#ga").attr("src", "uploads/soalgambar/"+data.data.gambar_a)
                            $('#ga').css(
                                                {
                                                    "width": "150px",
                                                    "height:":'auto',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                        if(data.data.gambar_b == null){
                            $("#rowgb").hide()
                            $("#gb").hide()
                        }else{
                            $("#rowgb").show()
                            $("#gb").show()
                            $("#gb").attr("src", "uploads/soalgambar/"+data.data.gambar_b)
                            $('#gb').css(
                                                {
                                                    "width": "150px",
                                                    "height:":'auto',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                        if(data.data.gambar_c == null){
                            $("#rowgc").hide()
                            $("#gc").hide()
                        }else{
                            $("#rowgc").show()
                            $("#gc").show()
                            $("#gc").attr("src", "uploads/soalgambar/"+data.data.gambar_c)
                            $('#gc').css(
                                                {
                                                    "width": "150px",
                                                    "height:":'auto',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                        if(data.data.gambar_c == null){
                            $("#rowgc").hide()
                            $("#gc").hide()
                        }else{
                            $("#rowgc").show()
                            $("#gc").show()
                            $("#gc").attr("src", "uploads/soalgambar/"+data.data.gambar_c)
                            $('#gc').css(
                                                {
                                                    "width": "150px",
                                                    "height:":'auto',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                        if(data.data.gambar_d == null){
                            $("#rowgd").hide()
                            $("#gd").hide()
                        }else{
                            $("#rowgd").show()
                            $("#gd").show()
                            $("#gd").attr("src", "uploads/soalgambar/"+data.data.gambar_d)
                            $('#gd').css(
                                                {
                                                    "width": "50px",
                                                    "height:":'50px',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                        if(data.data.gambar_e == null){
                            $("#rowge").hide()
                            $("#ge").hide()
                        }else{
                            $("#rowge").show()
                            $("#ge").show()
                            $("#ge").attr("src", "uploads/soalgambar/"+data.data.gambar_e)
                            $('#ge').css(
                                                {
                                                    "width": "150px",
                                                    "height:":'auto',
                                                    "border-radius": "5px",

                                                }
                                            )    
                        }
                    },
                    error: function(data) { 
                        // console.log(data)    
                    }
                });
            });

            $('#submitdata').click(function(event){
                event.preventDefault();
                var formData = new FormData($('#form-soal')[0]);
                    $.ajax({
                        data: formData,
                        url: "{{ url('soalgambar') }}",
                        type: "POST", //karena simpan kita pakai method POST
                        dataType: 'json', //data tipe kita kirim berupa JSON
                        contentType: false, 
                        processData: false,
                        beforeSend: function() {
                            // $("#simpanmytask").attr("display","none");
                            
                            console.log('aaaaa')
                        },
                        success: function(data) {
                            console.log(status)
                            if(data.status == true) {
                                Swal.fire({
                                    title: "Berhasil",
                                    text: "Soal gambar berhasil dibuat !",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: `Ok`,
                                });
                                $('#modalTbhGbr').modal('hide')

                            }else{
                                Swal.fire({
                                    title: "Gagal",
                                    text: "Soal gambar gagal dibuat !",
                                    icon: "error",
                                    showCancelButton: false,
                                    confirmButtonText: `Ok`,
                                });
                            }
                            
                        }
                    });
                    return false;
            });
            
            $('#submitcerita').click(function(event){
                event.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah yakin ingin membuat soal cerita ini ?',
                    icon: 'warning',
                    confirmButtonText: `Buat`,
                    showCancelButton: true,
                }).then((ok) => {
                    if (ok.value) {
                        event.preventDefault();
                        console.log($('#form-cerita').serialize())
                        
                         $.ajax({
                             url: "{{ url('soalcerita') }}",
                             type: "POST",
                             dataType: 'json', 
                             data: { 
                                    "_token": "{{ csrf_token() }}",
                                    "soalcrt" : $("#soalcerita").val(),
                                    "soal1" : $("#soal1").val(),
                                    "soal2" : $("#soal2").val(),
                                    "soal3" : $("#soal3").val(),
                                    "soal4" : $("#soal4").val(),
                                    "ja1" : $("#jawabana1").val(),
                                    "ja2" : $("#jawabana2").val(),
                                    "ja3" : $("#jawabana3").val(),
                                    "ja4" : $("#jawabana4").val(),
                                    "jb1" : $("#jawabanb1").val(),
                                    "jb2" : $("#jawabanb2").val(),
                                    "jb3" : $("#jawabanb3").val(),
                                    "jb4" : $("#jawabanb4").val(),
                                    "jc1" : $("#jawabanc1").val(),
                                    "jc2" : $("#jawabanc2").val(),
                                    "jc3" : $("#jawabanc3").val(),
                                    "jc4" : $("#jawabanc4").val(),
                                    "jd1" : $("#jawaband1").val(),
                                    "jd2" : $("#jawaband2").val(),
                                    "jd3" : $("#jawaband3").val(),
                                    "jd4" : $("#jawaband4").val(),
                                    "je1" : $("#jawabane1").val(),
                                    "je2" : $("#jawabane2").val(),
                                    "je3" : $("#jawabane3").val(),
                                    "je4" : $("#jawabane4").val(),
                                    "j1" : $("#jawaban1").val(),
                                    "j2" : $("#jawaban2").val(),
                                    "j3" : $("#jawaban3").val(),
                                    "j4" : $("#jawaban4").val(),
                                    "kj1" : $("#ketjawaban1").val(),
                                    "kj2" : $("#ketjawaban2").val(),
                                    "kj3" : $("#ketjawaban3").val(),
                                    "kj4" : $("#ketjawaban4").val(),
                                        },
                                 beforeSend: function() {
                                     console.log('beforesend')
                                 },
                                 success: function(data) {
                                     console.log(status)
                                     if(data.status == true) {
                                         Swal.fire({
                                             title: "Berhasil",
                                             text: "Soal cerita berhasil dibuat !",
                                             icon: "success",
                                             showCancelButton: false,
                                             confirmButtonText: `Ok`,
                                         });
                                         $('#modalTbhCrt').modal('hide')

                                     }else{
                                         Swal.fire({
                                             title: "Gagal",
                                             text: "Soal cerita gagal dibuat !",
                                             icon: "error",
                                             showCancelButton: false,
                                             confirmButtonText: `Ok`,
                                         });
                                     }
                                    
                                 }
                             });
                    }else{
                        return false
                    }
                });
                
            });

            $('.preview-soal').hide()
            $('.preview-jwb-a').hide()
            $('.preview-jwb-b').hide()
            $('.preview-jwb-c').hide()
            $('.preview-jwb-d').hide()
            $('.preview-jwb-e').hide()

            function convert(bytes) { 
                return bytes / (1024*1024); 
            }

            function readURL(input,a,b,c) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(a).attr('src', e.target.result);
                    }
                        $(b).show();
                        $(c).hide()

                        $(a).css(
                                            {
                                                "width": "150px",
                                                "height:":'auto',
                                                "border-radius": "5px",
                                            }
                                        );
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            

            $("#input-soal").change(function() {
                var size = this.files[0].size;
                convertsize = convert(size);
                if(convertsize > 5){
                $("#input-soal").val("")
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops...',
                    //     text: 'Ukuran gambar terlalu besar, silahkan compress gambar terlebih dahulu!',
                    // })
                }else{
                    readURL(this,'#img_soal','.preview-soal','#input-soal');
                }               
            });

            $("#jawaban-a").change(function() {
                var size = this.files[0].size;
                convertsize = convert(size);
                if(convertsize > 5){
                $("#jawaban-a").val("")
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops...',
                    //     text: 'Ukuran gambar terlalu besar, silahkan compress gambar terlebih dahulu!',
                    // })
                }else{
                    readURL(this,'#img_jwb_a','.preview-jwb-a','#jawaban-a');
                }               
            });
            $("#jawaban-b").change(function() {
                var size = this.files[0].size;
                convertsize = convert(size);
                if(convertsize > 5){
                $("#jawaban-b").val("")
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops...',
                    //     text: 'Ukuran gambar terlalu besar, silahkan compress gambar terlebih dahulu!',
                    // })
                }else{
                    readURL(this,'#img_jwb_b','.preview-jwb-b','#jawaban-b');
                }               
            });
            $("#jawaban-c").change(function() {
                var size = this.files[0].size;
                convertsize = convert(size);
                if(convertsize > 5){
                $("#jawaban-c").val("")
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops...',
                    //     text: 'Ukuran gambar terlalu besar, silahkan compress gambar terlebih dahulu!',
                    // })
                }else{
                    readURL(this,'#img_jwb_c','.preview-jwb-c','#jawaban-c');
                }               
            });
            $("#jawaban-d").change(function() {
                var size = this.files[0].size;
                convertsize = convert(size);
                if(convertsize > 5){
                $("#jawaban-d").val("")
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops...',
                    //     text: 'Ukuran gambar terlalu besar, silahkan compress gambar terlebih dahulu!',
                    // })
                }else{
                    readURL(this,'#img_jwb_d','.preview-jwb-d','#jawaban-d');
                }               
            });
            $("#jawaban-e").change(function() {
                var size = this.files[0].size;
                convertsize = convert(size);
                if(convertsize > 5){
                $("#jawaban-e").val("")
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Oops...',
                    //     text: 'Ukuran gambar terlalu besar, silahkan compress gambar terlebih dahulu!',
                    // })
                }else{
                    readURL(this,'#img_jwb_e','.preview-jwb-e','#jawaban-e');
                }               
            });
            

            $("#rmv-soal").click(function() {
                // console.log("masok")
                $('.preview-soal').hide();
                $('#input-soal').show()
                $('#input-soal').val("")
            });
            $("#rmv-jwb-a").click(function() {
                // console.log("masok")
                $('.preview-jwb-a').hide();
                $('#jawaban-a').show()
                $('#jawaban-a').val("")
            });
            $("#rmv-jwb-b").click(function() {
                // console.log("masok")
                $('.preview-jwb-b').hide();
                $('#jawaban-b').show()
                $('#jawaban-b').val("")
            });
            $("#rmv-jwb-c").click(function() {
                // console.log("masok")
                $('.preview-jwb-c').hide();
                $('#jawaban-c').show()
                $('#jawaban-c').val("")
            });
            $("#rmv-jwb-d").click(function() {
                // console.log("masok")
                $('.preview-jwb-d').hide();
                $('#jawaban-d').show()
                $('#jawaban-d').val("")
            });
            $("#rmv-jwb-e").click(function() {
                // console.log("masok")
                $('.preview-jwb-e').hide();
                $('#jawaban-e').show()
                $('#jawaban-e').val("")
            });



    });
        
   
</script>
@endsection