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
					<strong>Form Tambah Bus Travel</strong></h3>
				</div>
				<form method="POST" id="DataNya" action="<?=base_url().'data/bus/simpanPerubahan';?>" enctype="multipart/form-data" class="form-horizontal">
					<div class="boxs-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="hidden" name="idData" class="form-control" id="idData" placeholder="Kode Bus" value="<?=$idKemitraan;?>"  autocomplete="off" readonly/>
										<input type="text" name="kode" class="form-control" id="kode" placeholder="Kode Bus" value="<?=$kode;?>"  autocomplete="off" readonly/>
										<small class="text-danger text-center">Harap isi Dengan Angka..!</small>
									</div>
								</div>
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="text" name="nama_perusahaan" value="<?=$nama_perusahaan;?>" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan" autocomplete="off">
										<small class="text-danger">* Harap Isi Nama Mitra!</small>
									</div>
								</div>

								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="text" name="nama" class="form-control" value="<?=$bus;?>" id="nama" placeholder="Nama Bus" autocomplete="off">
										<small class="text-danger">* Harap Diisi Nama Bus!</small>
									</div>
								</div>
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="number" name="ks" class="form-control" value="<?=$ks;?>" id="ks" placeholder="Kapasitas Orang" autocomplete="off">
										<small class="text-danger">* Harap Angka!</small>
									</div>
								</div>
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="number" name="nilaiKerjasama" value="<?=$nilai_kerjasama;?>" class="form-control" id="nilaiKerjasama" placeholder="Nilai Kerjasama"  autocomplete="off">
										<small class="text-danger text-center">Harap isi Nilai Kerjasama..!</small>
									</div>
								</div>
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="date" name="tanggalBerlaku" class="form-control" value="<?=$tanggal_berlaku;?>" id="tanggalBerlaku" placeholder="Tanggal Berlaku"  autocomplete="off">
										<small class="text-danger text-center">Harap isi tanggal mulai kerjasama..!</small>
									</div>
								</div>

								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="date" name="tanggalBerakhir" class="form-control" value="<?=$tanggal_berakhir;?>" id="tanggalBerakhir" placeholder="Tanggal Berakhir"  autocomplete="off">
										<small class="text-danger text-center">Harap isi tanggal berakhir kerjasama..!</small>
									</div>
								</div>
								<div class="form-group col-sm-4">
									<div class="col-sm-12">
										<input type="text" name="namaPemberiKerjasama" class="form-control" id="namaPemberiKerjasama" placeholder="Pemberi Kerjasama" value="<?=$nama_pemberi_kerjasama;?>"  autocomplete="off">
										<small class="text-danger text-center">Harap isi nama pemberi kerjasama..!</small>
									</div>
								</div>
								<div class="form-group col-sm-12">
									<div class="col-sm-12">
										<a target="_blank" href="<?=base_url().'image/kemitraan/'.$file_kemitraan;?>"><span class="form-control"><?=$file_kemitraan;?></span></a>
										<label for="username">Dokumen Kerjasama Mitra</label>
										<input type="file" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox"   id="ktp" name="ktp">
										<small class="text-danger ">Harap Diisi.  Format PDF max size 2mb..!</small>
									</div>
								</div>
								<div class="form-group col-sm-12">
									<div class="col-sm-12">
										<textarea class="form-control" name="catatan"  id="catatan" > <?=$keterangan;?></textarea>
										<small class="text-danger ">Jika Ada Catatan Untuk Pengguna Silakan Isi..!</small>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-10">
								<?php if($Params == 'Ubah'){?>
									<button type="submit" class="btn btn-raised btn-primary">Update</button>
								<?php }?>
								<a href="<?=base_url().'data/bus';?>">
									<button type="button"  class="btn btn-raised btn-warning">Kembali</button>
								</a>
							</div>
						</div>
					</div>
				</form>
			</section>
		</div>
	</section>
	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/chosen/chosen.jquery.min.js';?>"></script> 
	<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/filestyle/bootstrap-filestyle.min.js';?>"></script> 
	<script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'catatan',{
			height: 200
		});
	</script>