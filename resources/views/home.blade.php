@extends('layout.master')

@section('title')
    My Perpus
@endsection

@section('content')
    <center><div id="cover"></div></center>
		  <!-- Page Heading -->
		  <div class="col-lg-4">
			  <div class="col-lg-12">
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Daftar Buku</h1>
					</div>
			  </div>
		  </div>


        <div class="content" style="margin: 10px;">

        	<?php
			//Columns must be a factor of 12 (1,2,3,4,6,12)
			$numOfCols = 3;
			$rowCount = 0;
			$bootstrapColWidth = 12 / $numOfCols;
			?>

        	 <div class="row row-content" >
        	 	<?php
					foreach ($dataBuku as $row){
					?>   <div class="col-lg-<?php echo $bootstrapColWidth; ?> col-content mb-4" data-id="<?= $row->id ?>">
					            <div class="col-lg-12 mb-4">
				          			<div class="card card-class h-100">
				          				<center>
										  <img height="300" src="{{ url('uploads').'/'.$row->cover_buku }}" class="card-img-top img-cover" alt="<?php echo $row->judul_buku; ?>">
										</center>
										  <div class="card-body d-flex flex-column align-content-center flex-wrap">
										    <h5 class="card-title" style="height: 50px" ><a href="{{ route('home.lihat',$row->id) }}"><?= $row->judul_buku ?></a></h5>
										    <p class="card-text"><?= substr($row->keterangan_buku,0,150).'....' ?></p>
										    <a href="{{ route('home.lihat',$row->id) }}" class="btn btn-primary">Lihat Buku</a>
										  </div>
										</div>
				          		</div>
					        </div>
					<?php
					    $rowCount++;
					    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
					}
					?>
          <?php if (sizeof($dataBuku) >= 3 ): ?>
  					<div class="col-lg-12">
  						<div class="col-lg-12">
  								<div align="center"><button class="btn btn-lg btn-success btn-split btn-load-more">Load More</button></div>
  						</div>
  					</div>
          <?php endif; ?>


          	</div>



          </div>  <!-- end content -->
@endsection

@push('scripts')
	<script>
		$(document).ready(function(){
		$('.btn-load-more').on('click',function(){
			var id_last = $('.col-content:last').attr('data-id');
			$('.loader').show();
			$.ajax({
				url: '{{ route("home.loadMore") }}',
				data: {id_last: id_last},
				success: function(response){
					setTimeout(function(){
						$('.loader').hide();
						$('.col-content:last').after(response);
						$('.card-class').matchHeight();
						$('html, body').animate({
						scrollTop: $(".card-body:last").offset().top
						}, 2000);
					},2000)
				}
			})
		})
		})
	</script>
@endpush