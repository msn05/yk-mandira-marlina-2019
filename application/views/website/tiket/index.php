   <section id="search_container">
   	<div id="search">
   		<ul class="nav nav-tabs">
   			<li><a href="#tours" data-toggle="tab" class="active show">Tiket</a></li>
   		</ul>
   		<div class="tab-content">
   			<div class="tab-pane active show" id="tours">
   				<form id="PostData" method="post" action="<?=base_url().'welcome/SearchTiket';?>">
   					<h3>Search</h3>
   					<div class="row">
   						<div class="col-md-4">
   							<div class="form-group">
   								<label><i class="icon-calendar-7"></i> Tanggal Berangkat</label>
   								<input type="date" name="tanggal" id="tanggal" class="form-control">
   							</div>
   						</div>
   						<!-- <div class="col-md-3">
   							<div class="form-group">
   								<label><i class="fa fa-clock-o" aria-hidden="true"></i> Jam</label>
   								<input type="time" name="1dass" id="1dass" class="form-control">
   							</div>
   						</div> -->
   						<div class="col-md-4">
   							<div class="form-group">
   								<label><i class="fa fa-map-marker"></i> Dari</label>
   								<input type="text" name="1da" id="1da" class="form-control">
   							</div>
   						</div>
   						<div class="col-md-4">
   							<div class="form-group">
   								<label><i class="fa fa-map-marker"></i> Tujuan</label>
   								<input type="text" name="1das" id="1das" class="form-control">
   							</div>
   						</div>

   					</div>
   					<hr>
   					<button class="btn_1 green" type="submit"><i class="icon-search"></i>Cari</button>
   				</form>
   			</div>
   			<!-- End rab -->
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