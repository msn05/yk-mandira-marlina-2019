   <section id="search_container">
 <div id="search">
           	    <div class="row">
           	  
    <div class='col-lg-4'>
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
       <?php
       $result = $this->db->get_where('tb_image_slide',array('action'=>1));
       for ($i=0; $i <$result->num_rows() ; $i++) { 
        echo '
        <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
        if($i==0){echo'class="active"';}echo'></li>';
      }
      ?> 
    </ol>
    <div class="carousel-inner">
     <?php
     if($result->num_rows > 0){
      foreach ($result->result_array() as $row ) {
       $Gambar = $this->db->get_where('tb_dokumentasi',array('id'=>$row['image']))->row_array();
       if($row['id'] == 1){
        echo'<div class="carousel-item active">';
      }else{echo'<div class="carousel-item">';
    }
    ?>
    <img class="d-block w-100"  height="450px" src='<?=base_url().'image/galeri/'.$Gambar['foto'].'';?>' alt='<?=$Gambar['keterangan'];?>'>
   
  </div>
<?php }}?>
			
					</div>
			</div>	</div>
		<div class="col-lg-8">
    <ul class="nav nav-tabs">
   			<li><a href="#tours" data-toggle="tab" class="active show">Pariwisata</a></li>
   		</ul>

   		<div class="tab-content">
   		    			<div class="tab-pane active show" id="tours">
   				<form id="PostData" method="post" action="<?=base_url().'welcome/SearchParis';?>">
   					<h3>Search Paket Pariwisata</h3>
   					<?php if($this->session->flashdata('mess')){?>
 <div class="alert alert-danger">      
    <?php echo $this->session->flashdata('mess')?>
 </div>
 <?php }?>
   					<div class="row">
   						<div class="col-md-4">
   							<div class="form-group">
   								<label><i class="icon-calendar-7"></i> Tanggal</label>
   								<input type="date" name="tanggal" id="tanggal" class="form-control">
   							</div>
   						</div>
   						<div class="col-md-4">
   							<div class="form-group">
   								<label><i class="icon-calendar-7"></i> Dari</label>
   								<input type="text" name="dari" id="dari" class="form-control">
   							</div>
   						</div>
   						<div class="col-md-4">
   							<div class="form-group">
   								<label><i class="icon-calendar-7"></i> Tujuan</label>
   								<input type="text" name="tujuan" id="tujuan" class="form-control">
   							</div>
   						</div>
   					</div>
   					<hr>
   					<button class="btn_1 green" type="submit"><i class="icon-search"></i>Cari</button>
   				</form>
   			</div>
   			</div>
   		</div>
   	</div>

   </div>

      
</section>

<main>

	<div class="container margin_60">

		<div class="main_title">
			<h2>Mengapa <span>Memilih</span> YEKA Madira</h2>
		</div>
		<div class="row">
			<div class="col-lg-4 wow zoomIn" data-wow-delay="0.2s">
				<div class="feature_home">
					<i class="fa fa-file"></i>
					<h3>Dokumen </h3>
					<p>
						Membantu mengurusi dokumen-dokumen yang kurang lengkap / tidak dimiliki pelanggan
					</p>
				</div>
			</div>

			<div class="col-lg-4 wow zoomIn" data-wow-delay="0.4s">
				<div class="feature_home">
					<i class="icon_set_1_icon-30"></i>
					<h3><span>+1000</span> Customers</h3>
					<p>
						Memiliki pelanggan / customer yang telah menjadi langggang menggunakan jasa perusahaan
					</p>
				</div>
			</div>

			<div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
				<div class="feature_home">
					<i class="icon_set_1_icon-57"></i>
					<h3><span>+24 </span> Support</h3>
					<p>
						Mempunyai customer service yang cepat tanggap dan memberikan informasi tepat waktu
					</p>
				</div>
			</div>

		</div>

		<hr>


	</div>
</main>