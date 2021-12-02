@extends('layout.master')

@section('title')
    Tabel Buku
@endsection

@section('heading')
    Manage Buku
@endsection

@push('top')    
    <a href="{{ route('book.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Tambah Buku</a>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ url('assets/sweet-alert/sweetalert2.min.css') }}">
    <script src="{{ url('assets/sweet-alert/sweetalert2.all.min.js') }}"></script>
@endpush

@section('content')
    @if (session('insert'))
        <script>Swal.fire('Berhasil', 'Berhasi Menambahkan Buku', 'success')</script>
    @endif
    @if (session('delete'))
        <script>Swal.fire('Berhasil', 'Berhasi Menghapus Buku', 'success')</script>
    @endif
    @if (session('update'))
        <script>Swal.fire('Berhasil', 'Berhasi Mengupdate Buku', 'success')</script>
    @endif  
    <div class="row">
        <div class="card-body">
            @if ($errors->any())                                        
            <div class="form-group">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>                                            
            @endif
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl_buku" width="100%">
					<thead>
					<tr>
						<th>No</th>
						<th>Action</th>
						<th>Nomor Buku</th>
						<th>Judul Buku</th>
						<th>Keterangan Buku</th>
						<th>Sinopsis Buku</th>
						<th>Cover Buku</th>
					</tr>
					</thead>
					<tbody id="tbl_body">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($tabelBuku as $value)
                        @php
                            $no++;
                        @endphp                       
					    <tr>
                            <td style="width: 3%"><?= $no; ?></td>
                            <td style="white-space: nowrap;width: 10%;">
                            <a href="{{ route('book.edit', $value->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('remove', $value->id) }}" onclick="return confirm('Ingin Hapus?')" class="btn btn-warning btn-delete">Delete</a>
                            </td>
                            <td style="width: 5%;"><?= $value->no_buku ?></td>
                            <td><?= $value->judul_buku ?></td>
                            <td style="width: 30%;"><?= substr($value->keterangan_buku,0,200) ?></td>
                            <td style="width: 30%;"><?= substr($value->sinopsis_buku,0,200) ?></td>
                            <td style="width: 10%;">
                            <center>
                                <img style="width: 150px;height: 100%" src="{{ url('uploads').'/'.$value->cover_buku }}">
                            </center>
                            </td>
                        </tr>                            
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
    </div>
@endsection

@push('scripts')
    
@endpush