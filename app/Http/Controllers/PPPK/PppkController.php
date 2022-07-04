<?php

namespace App\Http\Controllers\PPPK;

use App\soal\m_soal;
use App\paketTryout\paketTryout;
use App\submateriSoal\submateriSoal;
use App\paketPppk\paketPppk;
use App\detailPaket\detailPaket;
use App\detailPppk\detailPppk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Skb\skb;
use App\PPPK\pppk;

class PppkController extends Controller
{
    public function banksoalpppk()
    {
        $get_member = auth::user()->member;
        $materi = submateriSoal::select(DB::raw('id_sms,submateri_soal'))->where('jenissoal_id','=',3)->get();
        // dd($materi);
        return view('user.pppk.banksoalpppk',compact('get_member','materi'));
    }

    public function apibankpppk($ju)
    {
       if($ju == 0){
        $soal = paketPppk::select(DB::raw('id_paket_pppk,kode,nama_paket,waktu_kt,waktu_km,waktu_sk,waktu_ls,b.jenis_ujian,created_at,updated_at'))
        ->leftJoin('jenis_ujian as b','paket_pppk.id_ju','=','b.id_jenis_ujian')
        ->get();
       }else{
        $soal = paketPppk::select(DB::raw('id_paket_pppk,kode,nama_paket,waktu_kt,waktu_km,waktu_sk,waktu_ls,b.jenis_ujian,created_at,updated_at'))
        ->leftJoin('jenis_ujian as b','paket_pppk.id_ju','=','b.id_jenis_ujian')
        ->where('id_ju',$ju)
        ->get();
       }
       
        return DataTables::of($soal)->make(true);
    }

    public function apiToPppk(Request $request){
        $ju = $request->ju;
        $sm = $request->submateri;
        // dd($sm);
        if($ju == 1 || $ju == 2){
            $soal = m_soal::select(DB::raw(
                'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->where('id_jenissoal','=',3)
            ->where('materi_soal_id','=',87)
            // ->where('submateri_soal_id','=',$sm)
            ->inRandomOrder()
            ->take(100)->get();

            $soal2 = m_soal::select(DB::raw(
                'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->where('id_jenissoal','=',3)
            ->where('materi_soal_id','=',88)
            ->inRandomOrder()
            ->take(25)->get();
            foreach($soal2 as $s){
                $soal->push($s);
            }

            $soal3 = m_soal::select(DB::raw(
                'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->inRandomOrder()->where('id_jenissoal','=',3)
            ->where('materi_soal_id','=',89)
            ->take(20)->get();
            foreach($soal3 as $s){
                $soal->push($s);
            }

            // dd($soal);


        }else if($ju == 3){
            // dd($sm);
            $soal = m_soal::select(DB::raw(
                'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->inRandomOrder()->where('id_jenissoal','=',3)
            ->where('materi_soal_id','=',87)
            ->where('submateri_soal_id','=',$sm)
            ->take(15)->get();
        }

        return DataTables::of($soal)->make(true);
    }

    public function buatPaketPppk(Request $request)
    {
        // dd($request->formpaket);
        
        try {
            DB::beginTransaction();    
            $allsoal = $request->soal;
            // dd($allsoal);
            $arrid = [];
            $arr = [];

            $p = 1;

            $form = $request->formpaket;
            
            $nama = $form["nama"];
            $kode = $form["kode"];
            $waktukt = $form["waktukteknis"];
            $waktukm = $form["waktukmanagerial"];
            $waktusk = $form["waktuskultural"];
            $waktuls = $form["waktuls"];
            $submateri = $form["submateri"];
            $jenis = $form["jenis"];

            $jenis != 3 ? 
            $arrpaket = [
                'nama_paket' => $nama,
                'kode' => $kode,
                'waktu_kt' => $waktukt,
                'waktu_km' => $waktukm,
                'waktu_sk' => $waktusk,
                'id_ju' => $jenis,
                'id_submateri' => $submateri,
            ] : $arrpaket = [
                'nama_paket' => $nama,
                'kode' => $kode,
                'waktu_ls' => $waktuls,
                'id_ju' => $jenis,
                'id_submateri' => $submateri,
            ];  

            // dd($arrpaket);

            $addData = paketPppk::create($arrpaket);
            $id_to_fix = $addData->id_paket_pppk;
            // dd($id_to_fix);
            $k = 0;
            if($jenis == 3){
                foreach($allsoal as $soal){
                    $k += 1;
                    $idsoal = $soal;
                    $arrid = [
                        "paket_id" =>  $id_to_fix,
                        "jenis_materi" => null,
                        "soal_id" => $idsoal,
                        "no" => $k
                    ];
                    $arr[] = $arrid ;
                }
                // dd($arr);

            }else if($jenis == 2 || $jenis == 3){
                $l = 1;

                foreach($allsoal as $soal){
                    $k += 1;
                    $idsoal = $soal;

                    if($k <= 100){
                        $arrid = [
                            "paket_id" =>  $id_to_fix,
                            "jenis_materi" => 1,
                            "soal_id" => $idsoal,
                            "no" => $k
                        ];
                    }else if($k > 100 && $k <= 125){
                        $arrid = [
                            "paket_id" =>  $id_to_fix,
                            "jenis_materi" => 2,
                            "soal_id" => $idsoal,
                            "no" => $l
                        ];
                        $l++;
                    }else if($k > 125 && $k <= 145 ){
                        // $l = 1;
                        $k == 126 ? $l = 1 : null;

                        $arrid = [
                            "paket_id" =>  $id_to_fix,
                            "jenis_materi" => 3,
                            "soal_id" => $idsoal,
                            "no" => $l
                        ];
                        $l++;
                    }
                    $arr[] = $arrid ;
                    // $p++;
                };
            }
            // dd($arr);

            detailPppk::insert($arr);    
            DB::commit();

            $resp = [
                "status" => "success",
                "message" => "Soal berhasil dibuat !",
                "ids" => $arr
            ];

            return response()->json($resp);

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
            return [
                "status" => "error",
                "error" => $th->getMessage(),
            ];
        }
    }
}
