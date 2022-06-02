   <section id="search_container">
   	<div id="search">
   		<ul class="nav nav-tabs">
   			<li><a href="#tours" data-toggle="tab" class="active show">Umroh</a></li>
   			<li><a href="#hotels" data-toggle="tab">Haji</a></li>
   		</ul>
   		<div class="tab-content">
   			<div class="tab-pane active show" id="tours">
   				<form id="PostData" method="post" action="<?=base_url().'welcome/SearchUmroh';?>">
   					<h3>Search Paket Umroh</h3>
   					<div class="row">
   						<div class="col-md-12">
   							<div class="form-group">
   								<label><i class="icon-calendar-7"></i> Tanggal Berangkat</label>
   								<input type="date" name="tanggal" id="tanggal" class="form-control">
   							</div>
   						</div>
   					</div>
   					<hr>
   					<button class="btn_1 green" type="submit"><i class="icon-search"></i>Cari</button>
   				</form>
   			</div>
   			<!-- End rab -->
   			<div class="tab-pane" id="hotels">
   				<form id="PostData" method="post" action="<?=base_url().'welcome/SearchHaji';?>">
   					<h3>Search Haji</h3>
   					<!-- End row -->
   					<div class="row">
   						<div class="col-md-12">
   							<div class="form-group">
   								<label><i class="icon-calendar-7"></i> Tanggal Berangkat</label>
   								<input type="date" name="tanggal" id="tanggal" class="form-control">
   							</div>
   						</div>
   					</div>
   					<hr>
   					<button class="btn_1 green"><i class="icon-search"></i>Search now</button>
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