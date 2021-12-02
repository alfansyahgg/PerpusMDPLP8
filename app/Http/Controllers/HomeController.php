<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $data['dataBuku'] = Book::limit(3)->offset(0)->get();
        
        return view('home' , with($data) );
    }

    public function getDataMore(Request $request){
        $id_last    = $request->get('id_last');
        $data       = Book::where('id', '>', $id_last)->limit(3)->get();

        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        $more = '';
        foreach ($data as $key => $dt) {
           $more .= '<div class="col-lg-'.$bootstrapColWidth.' col-content" data-id="'.$dt->id.'">';
           $more .= '<div class="col-lg-12 mb-4">';
           $more .= '<div class="card card-class">';
           $more .= '<center>';
           $more .= '<img height="300" src='.url('uploads').'/'.$dt->cover_buku.' class="card-img-top img-cover" alt='.$dt->judul_buku.'>';
           $more .= '</center>';
           $more .= '<div class="card-body d-flex flex-column align-content-center flex-wrap">';
           $more .= '<h5 class="card-title" style="height: 50px"><a href='.route('book.show',$dt->id).'>'.$dt->judul_buku.'</a></h5>';
           $more .= '<p class="card-text">'.substr($dt->keterangan_buku,0,150).'...</p>';
           $more .= '<a href='.route('home.lihat',$dt->id).' class="btn btn-primary">Lihat Buku</a>';
           $more .= '</div>';
           $more .= '</div>';
           $more .= '</div>';
           $more .= '</div>';
        }
 
        echo $more;
    }

    public function lihat(Request $request, $id){
        $book = Book::where('id', $id)->get();

        $data['buku'] = $book;

        return view('book.lihat', with($data));
    }

    public function pinjam(Request $request, $id){
        
        $user = Auth::user();
        $book = Book::find($id);

        $id_user = $user->id;
        $id_buku = $book->id;
        
        $pinjaman = new Pinjaman;

        $pinjaman->id_user = $id_user;
        $pinjaman->id_buku = $id_buku;
        $pinjaman->tanggal_request = Carbon::now();

        $pinjaman->save();

        return redirect()->route('home.pinjaman', Auth::user()->id)->with('status', 'Berhasil menambahkan ke pinjaman saya!');

    }

    public function pinjaman($userid){
        
        $pinjaman = DB::table('tb_pinjam')->select('tb_pinjam.*','tb_buku.judul_buku', 'tb_buku.cover_buku')
        ->join('tb_buku', 'tb_pinjam.id_buku', '=', 'tb_buku.id')
        ->join('users', 'tb_pinjam.id_user', '=', 'users.id')
        ->where('tb_pinjam.id_user', $userid)
        ->get();

        $data['pinjaman'] = $pinjaman;

        return view('pinjaman.member', with($data));

    }

    public function kembali($id_pinjam){

        $pinjaman = Pinjaman::find($id_pinjam);
        $pinjaman->tanggal_kembali = Carbon::now();
        
        $pinjaman->save();

        return redirect()->route('home.pinjam', Auth::user()->id);
    }
}
