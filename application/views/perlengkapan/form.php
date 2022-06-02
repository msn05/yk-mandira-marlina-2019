  <section id="content">
  	<div class="page page-ui-portlets">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Perlengkapan Lanjutan Layanan</h1>
  					<small class="text-muted">Welcome to Falcon application</small>
  				</div>
  			</div>
  		</div>
  		<form method="POST" id="SimpanData" class="form-horizontal">
  			<div class="row">
  				<div class="col-sm-8">
  					<section class="boxs">
  						<div class="boxs-header bg-blush">
  							<h3 class="custom-font">
  								<strong>Perlengkapan Lanjutan Layanan</strong></h3>
  							</div>
  							<div class="boxs-body">
  								<div class="boxs-body">
  									<div class="row">
  										<div class="form-group col-sm-12">
  											<div class="col-sm-12">
  												<table class="table table-bordered"  id="dynamic_field">  
  													<tr bored='0'>
  														<td>
  															<input type="text" name="nama[]" class="form-control" id="nama" placeholder="Nama Barang..!" autocomplete="off">
  														</td>
  														<td>
  															<input type="number" name="jumlah[]" class="form-control" id="jumlah" placeholder="Jumlah...!" >
  														</td>
  														<td>
  															<button type="button" name="add" id="add" class="btn btn-success btn-raised fa fa-plus"></button>
  														</td>  
  													</tr>
  												</table>
  											</div>
  										</div>
  									</div>
  								</div>
  							</div>
  							<hr class="line-dashed full-witdh-line" />
  							<div class="form-group">
  								<div class="col-sm-offset-4 col-sm-10">
  									<button type="submit" class="btn btn-raised btn-primary">Simpan</button>
  									<a href="<?=base_url().'data/perlengkapan';?>">
  										<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
  									</a>
  								</div>
  							</div>
  						</section>
  					</div>
  				</div>
  			</form>
  		</div>
  	</section>

  	<script>

  		$(document).ready(function(){      
  			var i=1;  

  			$('#add').click(function(){  
  				i++;  
  				$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="nama[]" class="form-control" placeholder="Nama Barang..!" autocomplete="off" ></td><td><input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah...!"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-raised btn_remove fa fa-trash-o"></button></td></tr>');  
  			});

  			$(document).on('click', '.btn_remove', function(){  
  				var button_id = $(this).attr("id");   
  				$('#row'+button_id+'').remove();  
  			});  

     $('#SimpanData').on('submit', function (e) {
      e.preventDefault();
      var base_url = "<?php echo base_url();?>";
      var SimpanData = $(this);
      $.ajax({
       type: "POST",
       url: base_url + 'data/perlengkapan/simpan',
       data: SimpanData.serialize(),
       dataType: "JSON",
       cache : "false",
       success: function (respone) {
        if (respone.status == 'success') {
         swal({
          type: 'success',
          title: respone.status,
          text: respone.message,
          timer: 1200,
         },
         function () {
          location.reload(true);
         });
        }else{
         swal({
          type: 'error',
          title: respone.status,
          text: respone.message,
          timer: 1200,
         },
         function () {
          location.reload(true);
         });
        }
       }
      });
     });
    });


   </script>