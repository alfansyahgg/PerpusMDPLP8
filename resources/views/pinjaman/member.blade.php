@extends('layout.master')

@section('title')
    Pinjaman Ku
@endsection

@push('css')
    <link rel="stylesheet" href="{{ url('assets/sweet-alert/sweetalert2.min.css') }}">
    <script src="{{ url('assets/sweet-alert/sweetalert2.all.min.js') }}"></script>
@endpush

@section('content')
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
						<th>Judul Buku</th>
						<th>Cover Buku</th>
                        <th>Tanggal Request</th>
						<th>Tanggal Pinjam</th>
						<th>Tanggal Kembali</th>
                        <th>Status</th>
						<th class="text-center">Action</th>
					</tr>
					</thead>
					<tbody id="tbl_body">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($pinjaman as $value)
                        @php
                            $no++;
                        @endphp                       
					    <tr>
                            <td style="width: 3%"><?= $no; ?></td>
                            <td>{{ $value->judul_buku }}</td>
                            <td style="width: 20%">
                                <img width="100%" height="150" src="{{ url('uploads').'/'.$value->cover_buku }}" alt="">
                            </td>
                            <td>{{ date('d F Y H:i:s', strtotime($value->tanggal_request)) }}</td>
                            <td>
                                @if ($value->status == '0')
                                    <span class="badge badge-warning">Belum Approve</span>
                                @else 
                                    {{ date('d F Y H:i:s', strtotime($value->tanggal_pinjam)) }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if (empty($value->tanggal_kembali))
                                    @if ($value->status == '1')
                                        <span class="badge badge-danger text-center">Belum Dikembalikan</span>                                        
                                    @else                                        
                                        - 
                                    @endif
                                @else
                                    <span class="badge badge-success text-center">{{ $value->tanggal_kembali }}</span>
                                @endif
                                
                            </td>

                            <td>
                                @switch($value->status)
                                    @case(0)
                                        <span class="badge badge-secondary">Waiting</span>
                                        @break
                                    @case(1)
                                        <span class="badge badge-success">Approved</span>
                                        @break
                                    @case(2)
                                        <span class="badge badge-danger">Rejected</span>
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
                            
                            <td style="white-space: nowrap;width: 10%;">
                                <a href="{{ route('home.lihat', $value->id) }}" class="btn btn-warning">
                                    <i class="fa fa-eye">&nbsp;</i>
                                    Lihat Buku
                                </a>
                                @if ($value->status == '1')
                                    @if (empty($value->tanggal_kembali))
                                        <form id="kembali-form" action="{{ route('book.kembali', $value->id) }}" method="post">
                                            @csrf
                                        </form>

                                        <a href="{{ route('book.kembali', $value->id) }}" onclick="event.preventDefault(); document.getElementById('kembali-form').submit() " class="btn btn-primary">
                                            <i class="fa fa-book">&nbsp;</i>
                                            Kembalikan
                                        </a>
                                    @endif;                                    
                                @endif
                                    
                            </td>
                            
                        </tr>                            
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
    </div>
@endsection