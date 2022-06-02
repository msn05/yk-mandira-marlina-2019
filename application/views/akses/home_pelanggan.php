     <link rel="stylesheet" href="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/rickshaw/rickshaw.min.css';?>">
     <section id="content">
     	<div class="page charts-page">
     		<!-- bradcome -->
     		<div class="b-b mb-10">
     			<div class="row">
     				<div class="col-sm-6 col-xs-12">
     					<h1 class="h3 m-0">Dashboard</h1>
     					<small class="text-muted">Welcome to Falcon application</small>
     				</div>
     			</div>
     		</div>
     		<div class="row">
     			<div class="col-md-12">
             <div class="boxs-body">
              <div class="alert alert-danger alert-dismissable">
               <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Selamat Anda Telah Masuk Sebagai <?=$NamaLevel;?> Pada Sistem Informasi Tour and Travel Yeka Madira</div>
             </div>
           </div>
         </div>
         <div class="row">
          <div class="col-md-4">
           <section class="boxs">
            <div class="boxs-header">
             <h3 class="custom-font">
              <i class="fa fa-users">
               <strong>Total Pesanan Paket</strong></h3></i>
               <div class="boxs-body">
                <h1>
                 <?=$TotalPesananPaket['Total'];?> Pesanan
               </h1>
             </div>
           </div>
         </section>
       </div>
       <div class="col-md-4">
         <section class="boxs">
          <div class="boxs-header">
           <h3 class="custom-font">
            <i class="fa fa-users">
             <strong>Total Pesanan Tiket  </strong></h3></i>
             <div class="boxs-body">
              <h1>
               <?=$TotalPesanan['Total'];?> Pesanan 
             </h1>
           </div>
         </div>
       </section>
     </div>
     <div class="col-md-8">
       <section class="boxs">
        <div class="boxs-header">
         <h3 class="custom-font">
          <i class="fa fa-users">
           <strong>YEKA MADIRA </strong></h3></i>
           <hr>
           <div class="boxs-body">
            <div class="row">
             <div class="col-md-6">
              <h3>* Nama Perusahaan : <?=$Perusahaan->nama_perusahaan;?></h3>
            </div>
            <div class="col-md-6">
              <h3>* Nomor Registrasi : <?=$Perusahaan->nomor_registrasi;?></h3>
            </div>
          </div>
          <br>
          <div class="row">
           <div class="col-md-6">
            <h3>* Alamat Perusahaan : <?=$Perusahaan->alamat;?></h3>
          </div>
          <div class="col-md-6">
            <h3>* Email Registrasi : <?=$Perusahaan->email;?></h3>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="col-md-4">                       
 <section class="boxs bg-slategray widget-calendar">
  <div class="boxs-header">
   <h3 class="custom-font">Calendar</h3>
 </div>
 <div class="boxs-body p-0">
   <div id="mini-calendar"></div>
 </div>
</section>
</div>

</div>
<script type="text/javascript">
  $('#mini-calendar').datetimepicker({
   inline: true
 });
</script>
