<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Nilai;
use App\Models\Reward;
use App\Models\Kriteria;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProsesPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Daftar Hasil Penilaian ';
        $time = $request->periode;
        $expl = explode('-',$time);
        if (isset($time)) {
            $data = Nilai::whereMonth('tanggal',$expl[0])
                ->whereYear('tanggal', $expl[1])
                ->get();
                  return view('pages.nilai.index', ['data' => $data, 'title' => $title,]);
            // if ($data->count() > 0) {
            //     $title2 = 'Data ditemukan';
            //     return view('pages.nilai.index', ['data' => $data, 'title' => $title, 'title2' => $title2]);
            // } else {
            //     $title2 = 'Data Tidak ditemukan';
            //     return view('pages.nilai.index', ['data' => $data, 'title' => $title, 'title2' => $title2]);
            // }
        } else {

            $data = Nilai::all();

            return view('pages.nilai.index', ['title' => $title, 'data' => $data]);
        }
    }
    public function formNilaiApproved($id){
        try {
            $title = 'Form Proses Penilaian';
            $pengajuan = Pengajuan::where('id', $id)->first();
            $nilaiPengajuan = Kriteria::where('id', '1')->first();
            $nilaiMeeting = Kriteria::where('id', '2')->first();
            $nilaiKehadiran = Kriteria::where('id', '3')->first();
            $np =  $nilaiPengajuan->range_nilai;
            $nm =  $nilaiMeeting->range_nilai;
            $nk =  $nilaiKehadiran->range_nilai;


            $paramsPengajuan    = $this->getParamsKriteria($np);
            $paramsMeeting      = $this->getParamsKriteria($nm);
            $paramsKehadiran    = $this->getParamsKriteria($nk);


            return view('pages.nilai.nilaiapproved', [
                'title'             => $title,
                'pengajuan'         => $pengajuan,
                'paramsPengajuan'   => $paramsPengajuan,
                'paramsMeeting'     => $paramsMeeting,
                'paramsKehadiran'   => $paramsKehadiran
            ]);
        } catch (\Exception $e) {
            return redirect('daftar-proses-nilai')->with('failed', $e->getMessage());
        }
    }
    public function reportNilai(Request $request)
    {
        $title = 'Report Penilaian';

        return view('pages.report.tambah', ['title' => $title]);
    }

    public function printNilai(Request $request)
    {
        $title = 'Daftar Report Nilai';

        try {

            $dari       = $request->dari;
            $sampai     = $request->sampai;

            if (isset($dari) && isset($sampai)) {

                $data = DB::table('nilai')
                    ->join('pengajuan', 'nilai.pengajuan_id', '=', 'pengajuan.id')
                    ->join('karyawan', 'nilai.karyawan_id', '=', 'karyawan.id')

                    ->select('pengajuan.judul_pengajuan', 'karyawan.nama', 'karyawan.line_produksi', 'nilai.pengajuan', 'nilai.kehadiran', 'nilai.meeting', 'nilai.total', 'nilai.reward', 'nilai.tanggal')
                    ->where('tanggal', '>=', $dari)
                    ->where('tanggal', '<=', $sampai)
                    // ->whereBetween('tanggal',[$dari, $sampai])
                    ->get();

                return view('pages.report.cetak', ['title' => $title, 'data' => $data, 'dari' => $dari, 'sampai' => $sampai]);
            } elseif (!isset($dari) || !isset($sampai)) {
                return back()->with('failed', 'Data Nilai Tidak ditemukan...!');
            }
        } catch (\Exception $e) {

            return back()->with('failed', $e->getMessage());
        }
    }

    public function print(Request $request)
    {

        try {
            $title = 'Daftar Hasil Penilaian ';


            if (isset($request->dari) && isset($request->sampai)) {
                $data = Nilai::where('tanggal', '>=', $request->dari)
                    ->where('tanggal', '<=', $request->sampai)
                    ->get();
                return view('pages.nilai.index', ['data' => $data, 'title' => $title]);
            } else {
                $data = Nilai::all();

                return view('pages.nilai.print', ['title' => $title, 'data' => $data]);
            }
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $title = 'Form Proses Penilaian';
            $pengajuan = Pengajuan::where('status_pengajuan', 'APPROVED')->get();
            $nilaiPengajuan = Kriteria::where('id', '1')->first();
            $nilaiMeeting = Kriteria::where('id', '2')->first();
            $nilaiKehadiran = Kriteria::where('id', '3')->first();
            $np =  $nilaiPengajuan->range_nilai;
            $nm =  $nilaiMeeting->range_nilai;
            $nk =  $nilaiKehadiran->range_nilai;


            $paramsPengajuan    = $this->getParamsKriteria($np);
            $paramsMeeting      = $this->getParamsKriteria($nm);
            $paramsKehadiran    = $this->getParamsKriteria($nk);


            return view('pages.nilai.tambah', [
                'title'             => $title,
                'pengajuan'         => $pengajuan,
                'paramsPengajuan'   => $paramsPengajuan,
                'paramsMeeting'     => $paramsMeeting,
                'paramsKehadiran'   => $paramsKehadiran
            ]);
        } catch (\Exception $e) {
            return redirect('daftar-proses-nilai')->with('failed', $e->getMessage());
        }
    }

    public function getParamsKriteria($value)
    {
        $nilai = explode('-', $value);
        $result = end($nilai);

        return $result;
    }
    public function getParamsReward($value)
    {
        $nilai = explode('-', $value);
        $result = reset($nilai);

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_pengajuan' => 'required',
            'pengajuan' => 'required',
            'meeting' => 'required',
            'kehadiran' => 'required',
           
        ]);


        try {

            $total = $request->pengajuan + $request->meeting + $request->kehadiran;

            $reward = Reward::all();
            if ($reward->count() > 0) {
                foreach ($reward as $key => $value) {
                    $x = $this->getParamsKriteria($value->range_total);
                    if ($total <= $x) {
                        $nilai = new Nilai();
                        $nilai->pengajuan_id = $request->pengajuan_id;
                     
                        $nilai->karyawan_id = $request->karyawan_id;
                        $nilai->pengajuan = $request->pengajuan;
                        $nilai->meeting = $request->meeting;
                        $nilai->kehadiran = $request->kehadiran;
                        $nilai->tanggal = Carbon::now();
                        $nilai->total = $total;
                        $nilai->reward = $value->nominal_reward;
                        $nilai->save();

                        return redirect('daftar-proses-nilai')->with('success', 'Nilai Berhasil ditambahkan...!');
                    }
                }
            } else {
                return redirect('daftar-proses-nilai')->with('failed', 'Oops Data Range Total & Reward Masih Kosong...! (silahkan isi terlebih dahulu)');
            }
        } catch (\Exception $e) {
            return redirect('daftar-proses-nilai')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Form Edit Nilai';
        $nilai = Nilai::where('id', $id)->first();
        $pengajuan = Pengajuan::where('status_pengajuan', 'APPROVED')->get();
        $nilaiPengajuan = Kriteria::where('id', '1')->first();
        $nilaiMeeting = Kriteria::where('id', '2')->first();
        $nilaiKehadiran = Kriteria::where('id', '3')->first();
        $np =  $nilaiPengajuan->range_nilai;
        $nm =  $nilaiMeeting->range_nilai;
        $nk =  $nilaiKehadiran->range_nilai;

        $paramsPengajuan    = $this->getParamsKriteria($np);
        $paramsMeeting      = $this->getParamsKriteria($nm);
        $paramsKehadiran    = $this->getParamsKriteria($nk);

        return view('pages.nilai.edit', [
            'title'             => $title,
            'nilai'             => $nilai,
            'pengajuan'         => $pengajuan,
            'paramsPengajuan'   => $paramsPengajuan,
            'paramsMeeting'     => $paramsMeeting,
            'paramsKehadiran'   => $paramsKehadiran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {


            $total = $request->pengajuan + $request->meeting + $request->kehadiran;

            $reward = Reward::all();

            foreach ($reward as $key => $value) {

                $x = $this->getParamsKriteria($value->range_total);
                if ($total <= $x) {
                    $nilai = Nilai::where('id', $id)->first();
                    $nilai->pengajuan = $request->pengajuan;
                    $nilai->meeting = $request->meeting;
                    $nilai->kehadiran = $request->kehadiran;
                    $nilai->tanggal = Carbon::now();
                    $nilai->reward = $value->nominal_reward;
                    $nilai->update();

                    return redirect('daftar-proses-nilai')->with('success', 'Nilai Berhasil diupdate...!');
                }
            }
        } catch (\Exception $e) {
            return redirect('daftar-proses-nilai')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = Nilai::where('id', $id)->first();
        $nilai->delete();

        return back()->with('success', 'Nilai berhasil dihapus...');
    }
}
