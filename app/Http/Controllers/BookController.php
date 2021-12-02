<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tabelBuku'] = Book::all();

        return view('book.book', with($data) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MaxNoBuku = Book::select(DB::raw('MAX(no_buku) as no_buku'))->get();

        $data['NoBuku'] = $MaxNoBuku;

        return view('book.create', with($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|max:3072|mimes:png,jpg,jpeg,gif',
                'no_buku' => 'required',
                'judul_buku' => 'required',
                'keterangan_buku' => 'required',
                'pengarang' => 'required',
                'tanggal_rilis' => 'required',
                'sinopsis_buku' => 'required'
            ]
            );
        
        $input = $request->all();


        $image = $request->file('file');
        $destinationPath = 'uploads/';
        $imageName = $image->getClientOriginalName();
        $image->move($destinationPath, $imageName);
        $input['cover_buku'] = $imageName;
        
        Book::create($input);


        return redirect()->route('book.index')->with('insert', 'Berhasil menambahkan buku!');
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
        $data['detailBuku'] = Book::find($id)->get();   

        return view ('book.edit', with($data));
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
        $request->validate(
            [
                'no_buku' => 'required',
                'judul_buku' => 'required',
                'keterangan_buku' => 'required',
                'pengarang' => 'required',
                'tanggal_rilis' => 'required',
                'sinopsis_buku' => 'required'
            ]
            );
        
        $input = $request->all();

        if($request->file('file')){
            $image = $request->file('file');
            $destinationPath = 'uploads/';
            $imageName = $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $input['cover_buku'] = $imageName;
        }
        
        $book = Book::find($id);

        $book->update($input);


        return redirect()->route('book.index')->with('update', 'Berhasil mengupdate buku!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

    }

    public function remove($id){
        
        $book = Book::find($id);
        
        $status['int'] = 0;
        $status['message'] = "Gagal Menghapus!";

        if($book->destroy($id)){
            $status['int'] = 1;
            $status['message'] = "Sukses Menghapus";
        }       

        return redirect()->route('book.index')->with('status', $status);

    }
}
