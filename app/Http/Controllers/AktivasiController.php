<?php

namespace App\Http\Controllers;

use App\Models\Aktivasi;
use Illuminate\Http\Request;

class AktivasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enableButton($id){
        
        $aktif = Aktivasi::where('id', $id)->first();
        $aktif->status_aktif = 'enable';
        $aktif->save();

        return back()->with('aktifbutton', 'Pengajuan berhasil diakifkan...!');
    }

    public function disableButton($id){
        $aktif = Aktivasi::where('id', $id)->first();
        $aktif->status_aktif = 'disable';
        $aktif->save();

        return back()->with('aktifbutton', 'Pengajuan berhasil dinonaktifkan...!');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aktivasi  $aktivasi
     * @return \Illuminate\Http\Response
     */
    public function show(Aktivasi $aktivasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aktivasi  $aktivasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Aktivasi $aktivasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aktivasi  $aktivasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aktivasi $aktivasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aktivasi  $aktivasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aktivasi $aktivasi)
    {
        //
    }
}
