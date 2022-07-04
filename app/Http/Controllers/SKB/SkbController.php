<?php

namespace App\Http\Controllers\SKB;

use App\soal\m_soal;
use App\paketTryout\paketTryout;
use App\submateriSoal\submateriSoal;
use App\detailPaket\detailPaket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Skb\skb;

class SkbController extends Controller
{
    public function banksoalskb()
    {
        $get_member = auth::user()->member;
        $materi = skb::all();
        // dd($materi);
        return view('user.skb.banksoalskb',compact('get_member','materi'));
    }
    public function apibankskb($ju)
    {
       if($ju == 0){
        $soal = paketTryout::select(DB::raw('id_paket_tryout,kode,nama_paket,waktu,b.jenis_ujian,created_at,updated_at'))
        ->leftJoin('jenis_ujian as b','paket_tryout.id_ju','=','b.id_jenis_ujian')
        ->where('id_js',2)
        ->get();
       }else{
        $soal = paketTryout::select(DB::raw('id_paket_tryout,kode,nama_paket,waktu,b.jenis_ujian,created_at,updated_at'))
        ->leftJoin('jenis_ujian as b','paket_tryout.id_ju','=','b.id_jenis_ujian')
        ->where('id_ju',$ju)
        ->where('id_js',2)
        ->get();
       }
       
        return DataTables::of($soal)->make(true);
    }
    public function apiToSkb(Request $request){
        $ju = $request->ju;
        if($ju == 1 || $ju == 2){
            $soal = m_soal::select(DB::raw(
                'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->inRandomOrder()->where('id_jenissoal','=',2)
            ->take(110)->get();
        }else if($ju == 3){
            $soal = m_soal::select(DB::raw(
                'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->inRandomOrder()->where('id_jenissoal','=',2)
            ->take(15)->get();
        }

        return DataTables::of($soal)->make(true);
    }

    public function buatPaket(Request $request)
    {

        try {
            DB::beginTransaction();    
            $allsoal = $request->soal;

            $arrid = [];
            $arr = [];

            $p = 1;
            $form = $request->formpaket;
            
            $nama = $form["nama"];
            $kode = $form["kode"];
            $waktu = $form["waktu"];
            $jenis = $form["jenis"];
            // dd($nama);
            $arrpaket = [
                'nama_paket' => $nama,
                'kode' => $kode,
                'waktu' => $waktu,
                'id_ju' => $jenis,
                'id_js' => 2,
            ];

            $addData = paketTryout::create($arrpaket);
            $id_to_fix = $addData->id_paket_tryout;

            foreach($allsoal as $soal){
                $idsoal = $soal;
                // dd($id);                
                $arrid = [
                    "paket_id" =>  $id_to_fix,
                    "soal_id" => $idsoal,
                    "no" => $p
                ];
                $arr[] = $arrid ;
                $p++;
            };

            detailPaket::insert($arr);    


            $resp = [
                "status" => "success",
                "message" => "Soal berhasil dibuat !",
                "ids" => $arr
            ];
            DB::commit();
            return response()->json($resp);

        } catch (\Throwable $th) {
            //throw $th;
            $resp = [
                "status" => "error",
                "error" => $th,
            ];
        }
    }
}
