<section id="content">
	<div class="page page-ui-portlets">
		<!-- bradcome -->
		<div class="b-b mb-10">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<h1 class="h3 m-0">Bus Travel</h1>
					<small class="text-muted">Welcome to Falcon application</small>
				</div>
			</div>
		</div>
		<section class="boxs">
			<div class="boxs-header bg-green">
				<h3 class="custom-font">
					<strong>Keterangan Peringatan</strong></h3>
				</div>
				<div class="boxs-body">
					<div class="row">
						<div class="form-group col-sm-12">
							<div class="col-sm-12">
								<textarea class="form-control" name="catatan"  id="catatan" ><?=$keterangan;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-5 col-sm-12">
								<a href="<?=base_url().'data/bus';?>">
									<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
								</a>
							</div>
						</div>
					</div>
				</section>
			</div>
		</section>
		<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'catatan',{
				height: 200,
				toolbar:[
				],
			});
		</script>