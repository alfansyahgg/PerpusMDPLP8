@extends('layout.master')

@section('title')
    Tabel Pinjaman User
@endsection

@section('content')
    @if (session('status'))
        <script>Swal.fire('Berhasil', '{{ session("status") }}', 'success')</script>
    @endif
    @if (session('delete'))
        <script>Swal.fire('Berhasil', 'Berhasi Menghapus Buku', 'success')</script>
    @endif  
    <div class="row">
        <div class="card">
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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Request</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($pinjaman as $value)
                                @php
                                    $no++;
                                @endphp
                                <tr>
                                    <td style="width: 3%"><?= $no; ?></td>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->judul_buku }}</td>
                                    <td>{{ date('d F Y H:i:s', strtotime($value->tanggal_request)) }}</td>
                                    <td>{{ $value->tanggal_pinjam ? date('d F Y H:i:s', strtotime($value->tanggal_pinjam))  : ' - ' }}</td>
                                    <td>{{ $value->tanggal_kembali ? date('d F Y H:i:s', strtotime($value->tanggal_kembali))  : ' - ' }}</td>
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
                                    <td style="white-space: nowrap;width: 10%;" class="text-center">
                                        @if ($value->status == '0')                                        
                                            <a href="{{ route('pinjam.approve', $value->id) }}" class="btn btn-success">
                                                <i class="fa fa-check"></i>
                                                Approve
                                            </a> 
                                            <a href="{{ route('pinjam.reject', $value->id) }}" class="btn btn-danger">
                                                <i class="fa fa-times"></i>
                                                Reject
                                            </a>
                                        @else 
                                            @switch($value->status)
                                                @case(1)
                                                    <a href="{{ route('pinjam.reject', $value->id) }}" class="btn btn-danger">
                                                        <i class="fa fa-times"></i>
                                                        Reject
                                                    </a>
                                                    @break
                                                @case(2)
                                                    <a href="{{ route('pinjam.approve', $value->id) }}" class="btn btn-success">
                                                        <i class="fa fa-check"></i>
                                                        Approve
                                                    </a>
                                                    @break
                                                @default
                                                    
                                            @endswitch                                          
                                        @endif                                       
                                    </td>
                                </tr>                                    
                                @endforeach
                            </tbody>
                    </table>    
                </div>    
            </div>    
        </div>    
    </div>    
@endsection