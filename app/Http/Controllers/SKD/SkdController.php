<?php

namespace App\Http\Controllers\SKD;

use App\soal\m_soal;
use App\paketTryout\paketTryout;
use App\submateriSoal\submateriSoal;
use App\detailPaket\detailPaket;
use App\soalCerita\soalCerita;
use App\jenisSoal\jenisSoal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Image;


class SkdController extends Controller
{
    public function banksoalskd()
    {
        $get_member = auth::user()->member;
        $sm = submateriSoal::all();
        
        return view('user.skd.banksoaltoskd',compact('get_member','sm'));
    }

    public function apibankskd($ju)
    {
       if($ju == 0){
        $soal = paketTryout::select(DB::raw('id_paket_tryout,kode,nama_paket,waktu,b.jenis_ujian,created_at,updated_at'))
        ->leftJoin('jenis_ujian as b','paket_tryout.id_ju','=','b.id_jenis_ujian')
        ->where('id_js',1)
        ->get();
       }else{
        $soal = paketTryout::select(DB::raw('id_paket_tryout,kode,nama_paket,waktu,b.jenis_ujian,created_at,updated_at'))
        ->leftJoin('jenis_ujian as b','paket_tryout.id_ju','=','b.id_jenis_ujian')
        ->where('id_ju',$ju)
        ->where('id_js',1)
        ->get();
       }

        return DataTables::of($soal)->make(true);
    }

    public function detailPaket($ju)
    {
        
        $ids = detailPaket::select(DB::raw('soal_id'))
        ->where('paket_id',$ju)
        ->get();
        // dd($ids);
        $id_soal=[];
        $arrsoal=[];
        foreach($ids as $id){
            $id_soal[] = $id->soal_id;
        }
        // dd($ids);
        for($i = 0; $i < count($id_soal); $i++){
            $soal = m_soal::select(DB::raw('id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->where('id_soal',$id_soal[$i])
            ->first();
            $arrsoal[] = $soal;
        }
        // return $arrsoal;
        return DataTables::of($arrsoal)->make(true);
    }

    public function materiskd()
    {
        $get_member = auth::user()->member;
        return view('user.skd.materiskd',compact('get_member'));
    }

    public function latsoalskd()
    {
        $get_member = auth::user()->member;
        return view('user.skd.latihansoal',compact('get_member'));
    }

    public function tomandiriskd()
    {
        $get_member = auth::user()->member;
        return view('user.skd.tomandiriskd',compact('get_member'));
    }

    public function toakbarskd()
    {
        $get_member = auth::user()->member;
        return view('user.skd.toakbarskd',compact('get_member'));
    }

    public function apiToSkd(Request $request)
    {
        // dd($ju);
        $ju = $request->ju;
        $submateri = $request->submateri;
        $jumlahsoal = $request->jumlahsoal;
        // dd($jumlahsoal);
        try {
            // dd($ju);
            if($ju == 1 || $ju == 2){
                // dd('aaa');    
                $all = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',1)
                ->take(7)->get();
                // dd($all); 
                // $arr [] = $soal;
                $integritas = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',2)
                ->take(7)->get();

                foreach($integritas as $soal){
                    $all->push($soal);
                }
                $belanegara = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',3)
                ->take(8)->get();
                foreach($belanegara as $soal){
                    $all->push($soal);
                }
                $pilarnegara = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',4)
                ->take(8)->get();
                foreach($pilarnegara as $soal){
                    $all->push($soal);
                }

                $analogi = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',5)
                ->take(4)->get();
                foreach($analogi as $soal){
                    $all->push($soal);
                }

                $silogisme = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',6)
                ->take(4)->get();
                foreach($silogisme as $soal){
                    $all->push($soal);
                }

                $analitis = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',7)
                ->take(4)->get();
                foreach($analitis as $soal){
                    $all->push($soal);
                }

                $berhitung = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',8)
                ->take(4)->get();
                foreach($berhitung as $soal){
                    $all->push($soal);
                }

                $deretangka = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',9)
                ->take(4)->get();
                foreach($deretangka as $soal){
                    $all->push($soal);
                }

                $perbKuantitatif = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',10)
                ->take(3)->get();
                foreach($perbKuantitatif as $soal){
                    $all->push($soal);
                }

                $soalcerita = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',11)
                ->take(3)->get();
                foreach($soalcerita as $soal){
                    $all->push($soal);
                }

                $ketidaksamaan = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',12)
                ->take(3)->get();
                foreach($ketidaksamaan as $soal){
                    $all->push($soal);
                }

                $serial = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',13)
                ->take(3)->get();
                foreach($serial as $soal){
                    $all->push($soal);
                }

                $analogi2 = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',20)
                ->take(3)->get();
                foreach($analogi2 as $soal){
                    $all->push($soal);
                }

                $pelayananpublik = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',14)
                ->take(7)->get();
                foreach($pelayananpublik as $soal){
                    $all->push($soal);
                }

                $jejaringkerja = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',15)
                ->take(8)->get();
                foreach($jejaringkerja as $soal){
                    $all->push($soal);
                }

                $sosialbudaya = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',16)
                ->take(8)->get();
                foreach($sosialbudaya as $soal){
                    $all->push($soal);
                }

                $tik = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',17)
                ->take(7)->get();
                foreach($tik as $soal){
                    $all->push($soal);
                }

                $profesionalisme = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',18)
                ->take(7)->get();
                foreach($profesionalisme as $soal){
                    $all->push($soal);
                }

                $antiradikal = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',19)
                ->take(8)->get();
                foreach($antiradikal as $soal){
                    $all->push($soal);
                }
                return DataTables::of($all)->make(true);

                // $arr [] = $soal;
            }else if($ju == 3){
                $all = m_soal::select(DB::raw(
                    'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
                ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
                ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
                ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
                ->inRandomOrder()->where('submateri_soal_id','=',$submateri)
                ->take($jumlahsoal)->get();
                return DataTables::of($all)->make(true);

            }
                   

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function apiLatRandSkd(Request $request){
        $jml = $request->jumlahsoal;
        $id_sms = $request->id_sms;
        $wkt = $request->waktu;

        $jml = 15;
        $id_sms = 15;
        $wkt = 60;

        $soal = m_soal::select(DB::raw(
            'id_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
        ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
        ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
        ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
        ->inRandomOrder()->where('submateri_soal_id','=',$id_sms)
        ->take($jml)->get();

        return DataTables::of($soal)->make(true);
    }

    public function generatePaket(Request $request)
    {
        try {
            $arr = [];
            $arrsoal = [];
            for($i = 0;$i < 110;$i++){

                $no_random = rand(1500,1700);
                if(!in_array($no_random,$arr)){
                    array_push($arr,$no_random);
                    // $a = $i +1500;
                    $soal = m_soal::where('iddetailsoal','=',1587)->first();
                    $arrsoal[] = $soal;
                }else{
                    $i--;
                }
            }
                
            // if ($request->ajax()) {
                return DataTables::of($arrsoal)->make(true);
            // }
            // return $arrsoal;
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function buatPaket(Request $request)
    {

        try {
            DB::beginTransaction();
            
            $allsoal = $request->soal;
            $form = $request->formpaket;
            
            $nama = $form["nama"];
            $kode = $form["kode"];
            $waktu = $form["waktu"];
            $jenis = $form["jenis"];
            $arrpaket = [
                'nama_paket' => $nama,
                'kode' => $kode,
                'waktu' => $waktu,
                'id_ju' => $jenis,
                'id_js' => 1,
            ];
            $addData = paketTryout::create($arrpaket);
            $id_to_fix = $addData->id_paket_tryout;
            // dd($id_to_fix);
            $arrid = [];
            $arr = [];

            $p = 1;
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

    public function apirekom(){
        $last_code = paketTryout::select('kode')->orderBy('id_paket_tryout','desc')->first();
        $lastnumb = substr($last_code->kode,3);
        $newnumb = $lastnumb + 1;        
        // $lastnumb = substr($last_code->kode,-1);
        $rekom = "MDR" . strval($newnumb) ;
        return $rekom;
    }

    public function detailSoal($id){
        $soal = m_soal::select(DB::raw('id_soal,gambar_soal,soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal,js.jenissoal'))
            ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
            ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
            ->leftJoin('jenissoal as js','js.id_js','=','soal_skd.id_jenissoal')
            ->where('id_soal',$id)
            ->first();

        $resp = [
            "status" => true,
            "message" => "Sukses",
            "data" => $soal
        ];
        return response()->json($resp);
    }

    public function allskd()
    {
        $get_member = auth::user()->member;
        $sm = submateriSoal::where("jenissoal_id",'=',1)->get();

        return view('user.skd.allskd',compact('get_member','sm'));
    }

    public function apiallskd()
    {
        $soal = m_soal::select(DB::raw('id_soal,soal,gambar_soal,a,b,c,d,e,jawaban,ket_jawaban,gambar_a,gambar_b,gambar_c,gambar_d,gambar_e,sms.submateri_soal,ms.materi_soal'))
        ->leftJoin('submateri_soal as sms','sms.id_sms','=','soal_skd.submateri_soal_id')
        ->leftJoin('materi_soal as ms','ms.id_ms','=','soal_skd.materi_soal_id')
        ->where('id_jenissoal','=',1)
        ->get();

        return DataTables::of($soal)->make(true);
    }

    public function soalgambar(Request $request)
    {
        return $request->all();
        // dd($request->file('jawaban-d'));
        $soal = $request->file('gambarsoal');
        $a = $request->file('jawaban-a');
        $b = $request->file('jawaban-b');
        $c = $request->file('jawaban-c');
        $d = $request->file('jawaban-d');
        $e = $request->file('jawaban-e');
        // dd($request->soal);
        if($soal != null && $a != null && $b != null && $c != null && $d != null && $e != null){
            try {
                $name_soal = rand(0,99).$soal->getClientOriginalName();
                $name_a = rand(0,99).$a->getClientOriginalName();
                $name_b = rand(0,99).$b->getClientOriginalName();
                $name_c = rand(0,99).$c->getClientOriginalName();
                $name_d = rand(0,99).$d->getClientOriginalName();
                $name_e = rand(0,99).$e->getClientOriginalName();

                $arrsoal = [
                    "soal" => $request->soal,
                    "gambar_soal" => $name_soal,
                    "a" => $request->a,
                    "b" => $request->b,
                    "c" => $request->c,
                    "d" => $request->d,
                    "e" => $request->e,
                    "gambar_a" => $name_a,
                    "gambar_b" => $name_b,
                    "gambar_c" => $name_c,
                    "gambar_d" => $name_d,
                    "gambar_e" => $name_e,
                    "jawaban" => $request->jawaban,
                    "ket_jawaban" => $request->ket_jawaban,
                    "nilai_a" => 5,
                    "nilai_b" => 5,
                    "nilai_c" => 5,
                    "nilai_d" => 5,
                    "nilai_e" => 5,
                    "id_jenissoal" => 1,
                    "materi_soal_id" => 1,
                    "submateri_soal_id" => 34
                ];

                Image::make($soal)->save('uploads/soalgambar/'.$name_soal, 30);
                Image::make($a)->save('uploads/soalgambar/'.$name_a, 30);
                Image::make($b)->save('uploads/soalgambar/'.$name_b, 30);
                Image::make($c)->save('uploads/soalgambar/'.$name_c, 30);
                Image::make($d)->save('uploads/soalgambar/'.$name_d, 30);
                Image::make($e)->save('uploads/soalgambar/'.$name_e, 30);


                m_soal::create($arrsoal);
                $resp = [
                    "status" => true,
                    "message" => "Soal gambar berhasil dibuat!",
                ];
                return response()->json($resp);
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }else if($soal != null && $a == null && $b == null && $c == null && $d == null && $e == null){
            try {
                $name_soal = rand(0,99).$soal->getClientOriginalName();

                $arrsoal = [
                    "soal" => $request->soal,
                    "gambar_soal" => $name_soal,
                    "a" => $request->a,
                    "b" => $request->b,
                    "c" => $request->c,
                    "d" => $request->d,
                    "e" => $request->e,
                    "gambar_a" => null,
                    "gambar_b" => null,
                    "gambar_c" => null,
                    "gambar_d" => null,
                    "gambar_e" => null,
                    "jawaban" => $request->jawaban,
                    "ket_jawaban" => $request->ket_jawaban,
                    "nilai_a" => 5,
                    "nilai_b" => 5,
                    "nilai_c" => 5,
                    "nilai_d" => 5,
                    "nilai_e" => 5,
                    "id_jenissoal" => 1,
                    "materi_soal_id" => 1,
                    "submateri_soal_id" => 34
                ];
                // dd($soal);
                m_soal::create($arrsoal);
                $resp = [
                    "status" => true,
                    "message" => "Soal gambar berhasil dibuat!",
                ];
                return response()->json($resp);
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }else{
            $resp = [
                "status" => "error",
                "message" => "Gagal membuat soal gambar!",
            ];
            return response()->json($resp);
        }

    }
    public function soalcerita(Request $request){      
        // dd("000");
            try { 
                DB::beginTransaction();                
                $arrsoal1 = [
                    "soal" => $request->soalcrt,
                    "gambar_soal" => null,
                    "a" => $request->ja1,
                    "b" => $request->jb1,
                    "c" => $request->jc1,
                    "d" => $request->jd1,
                    "e" => $request->je1,
                    "gambar_a" => null,
                    "gambar_b" => null,
                    "gambar_c" => null,
                    "gambar_d" => null,
                    "gambar_e" => null,
                    "jawaban" => $request->j1,
                    "ket_jawaban" => $request->kj1,
                    "nilai_a" => 5,
                    "nilai_b" => 5,
                    "nilai_c" => 5,
                    "nilai_d" => 5,
                    "nilai_e" => 5,
                    "id_jenissoal" => 1,
                    "materi_soal_id" => 1,
                    "submateri_soal_id" => 11
                ];
                $arrsoal2 = [
                    "soal" => $request->soalcrt,
                    "gambar_soal" => null,
                    "a" => $request->ja2,
                    "b" => $request->jb2,
                    "c" => $request->jc2,
                    "d" => $request->jd2,
                    "e" => $request->je2,
                    "gambar_a" => null,
                    "gambar_b" => null,
                    "gambar_c" => null,
                    "gambar_d" => null,
                    "gambar_e" => null,
                    "jawaban" => $request->j2,
                    "ket_jawaban" => $request->kj2,
                    "nilai_a" => 5,
                    "nilai_b" => 5,
                    "nilai_c" => 5,
                    "nilai_d" => 5,
                    "nilai_e" => 5,
                    "id_jenissoal" => 1,
                    "materi_soal_id" => 1,
                    "submateri_soal_id" => 11
                ];        
                $arrsoal3 = [
                    "soal" => $request->soalcrt,
                    "gambar_soal" => null,
                    "a" => $request->ja3,
                    "b" => $request->jb3,
                    "c" => $request->jc3,
                    "d" => $request->jd3,
                    "e" => $request->je3,
                    "gambar_a" => null,
                    "gambar_b" => null,
                    "gambar_c" => null,
                    "gambar_d" => null,
                    "gambar_e" => null,
                    "jawaban" => $request->j3,
                    "ket_jawaban" => $request->kj3,
                    "nilai_a" => 5,
                    "nilai_b" => 5,
                    "nilai_c" => 5,
                    "nilai_d" => 5,
                    "nilai_e" => 5,
                    "id_jenissoal" => 1,
                    "materi_soal_id" => 1,
                    "submateri_soal_id" => 11
                ];
                $cs1 = m_soal::create($arrsoal1);
                $cs2 = m_soal::create($arrsoal2);
                $cs3 = m_soal::create($arrsoal3);

                $lastpaketcrt = soalCerita::latest("id_soalcerita")->first();
                $lastpaketcrt == null ? $idpaketcrt = 1 : $idpaketcrt = $lastpaketcrt->paket_cerita; 
                // dd($cs1);
                soalCerita::create([
                    "soal_id" => $cs1->id_soal,
                    "paket_cerita" => $idpaketcrt,
                    "nama" => null
                ]);
                soalCerita::create([
                    "soal_id" => $cs2->id_soal,
                    "paket_cerita" => $idpaketcrt,
                    "nama" => null
                ]);
                soalCerita::create([
                    "soal_id" => $cs3->id_soal,
                    "paket_cerita" => $idpaketcrt,
                    "nama" => null
                ]);
                
                if($request->j4 != null){
                    $arrsoal4 = [
                        "soal" => $request->soalcrt,
                        "gambar_soal" => null,
                        "a" => $request->ja4,
                        "b" => $request->jb4,
                        "c" => $request->jc4,
                        "d" => $request->jd4,
                        "e" => $request->je4,
                        "gambar_a" => null,
                        "gambar_b" => null,
                        "gambar_c" => null,
                        "gambar_d" => null,
                        "gambar_e" => null,
                        "jawaban" => $request->j4,
                        "ket_jawaban" => $request->kj4,
                        "nilai_a" => 5,
                        "nilai_b" => 5,
                        "nilai_c" => 5,
                        "nilai_d" => 5,
                        "nilai_e" => 5,
                        "id_jenissoal" => 1,
                        "materi_soal_id" => 1,
                        "submateri_soal_id" => 11
                    ];
                    $cs4 = m_soal::create($arrsoal4);
                    soalCerita::create([
                        "soal_id" => $cs4->id_soal,
                        "paket_cerita" => $idpaketcrt,
                        "nama" => null
                    ]);
                }
                    DB::commit();
                    $resp = [
                        "status" => true,
                        "message" => "Soal cerita berhasil dibuat!",
                    ];
                    return response()->json($resp);
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
                DB::rollback();
                $resp = [
                    "status" => "error",
                    "message" => $th->getMessage(),
                ];
                return response()->json($resp);
            }
        
    }
}
