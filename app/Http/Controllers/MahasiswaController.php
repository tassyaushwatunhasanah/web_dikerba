<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\Univ;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::table('mahasiswas')
                    ->join('univs', 'univs.iduniv', '=', 'mahasiswas.univ_id')
                    ->join('ruangans', 'ruangans.idruangan', '=', 'mahasiswas.ruangan_id')
                    ->get();

            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('mahasiswas.index')->with('data', $data);

    }

    public function cetakmahasiswa(Request $request)
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $mahasiswas = Mahasiswa::whereBetween('tgl_mulai', [$start_date, $end_date])->get();
        } else {
            $mahasiswas = Mahasiswa::all();
        }

            return view('mahasiswas.cetakmahasiswa', [
                'mahasiswas' => $mahasiswas,
            ]);
    }

    public function downloadmahasiswapdf(Request $request)
    {

        $mahasiswas = Mahasiswa::with('univ')->whereIn('id', $request->mahasiswas)->get();


        $pdf = PDF::loadview('mahasiswas.downloadmahasiswapdf', compact('mahasiswas'));

        return $pdf->stream('laporan-mahasiswa.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $univs = Univ::all();
        $ruangans = Ruangan::all();

        return view('mahasiswas.create', compact('univs', 'ruangans'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'univ_id' => 'required',
            'ruangan_id' => 'required',
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'jk' => 'required',
            'tk_pendidikan' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
            'Kelulusan' => 'required',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswas.index')
                        ->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {

            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('mahasiswas.show', compact('mahasiswa'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $univs = Univ::all();
        $ruangans = Ruangan::all();

        // $mahasiswa = DB::table('mahasiswas')
        //             ->join('univs', 'univs.iduniv', '=', 'mahasiswas.univ_id')
        //             ->join('ruangans', 'ruangans.idruangan', '=', 'mahasiswas.ruangan_id')
        //             ->get();
        // dd($mahasiswa);
            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('mahasiswas.edit', compact('mahasiswa', 'univs', 'ruangans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'univ_id' => 'required',
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'jk' => 'required',
            'tk_pendidikan' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
            'Kelulusan' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswas.index')
                        ->with('success', 'Mahasiswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')
                        ->with('success', 'Mahasiswa deleted successfully');

    }
}
