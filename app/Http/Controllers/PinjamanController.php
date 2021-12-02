<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjaman = DB::table('tb_pinjam')
        ->join('tb_buku', 'tb_pinjam.id_buku', '=', 'tb_buku.id')
        ->join('users', 'tb_pinjam.id_user', '=', 'users.id')
        ->select('tb_pinjam.*', 'tb_buku.judul_buku', 'users.username' )
        ->get();

        $data['pinjaman'] = $pinjaman;

        return view('pinjaman.admin', with($data) );

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
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }

    public function approve($id){
        $pinjaman = Pinjaman::find($id);

        $pinjaman->status = '1';
        $pinjaman->tanggal_pinjam = Carbon::now();

        $pinjaman->save();

        return redirect()->route('pinjam.index')->with('status','Berhasil Approve Pinjaman');
    }

    public function reject($id){
        $pinjaman = Pinjaman::find($id);

        $pinjaman->status = '2';

        if($pinjaman->tanggal_pinjam){
            $pinjaman->tanggal_pinjam = null;
        }

        $pinjaman->save();

        return redirect()->route('pinjam.index')->with('status','Berhasil Reject Pinjaman');
    }

}
