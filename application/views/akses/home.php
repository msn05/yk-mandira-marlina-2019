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
        <section class="boxs">
          <div class="boxs-body">
            <div class="alert alert-danger alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Selamat Anda Telah Masuk Sebagai <?=$NamaLevel;?> Pada Sistem Informasi Tour and Travel Yeka Mandira</div>
            </div>
          </section>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <section class="boxs">
            <div class="boxs-header">
              <h3 class="custom-font">
                <i class="fa fa-users">
                  <strong>Total Pelanggan </strong></h3></i>
                  <div class="boxs-body">
                    <h1>
                      <?=$TotalPelanggan['TotalPelangganData'];?> Orang
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
                      <strong>Total Mitra Penerbangan </strong></h3></i>
                      <div class="boxs-body">
                        <h1>
                          <?=$TotalMitraPener['TotalPenerData'];?> Mitra
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
                          <strong>Total Mitra Bus </strong></h3></i>
                          <div class="boxs-body">
                            <h1>
                              <?=$TotalMitraBus['TotalBusData'];?> Mitra
                            </h1>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
                  <div class="row clearfix">
                   <div class="col-md-3 col-sm-6 col-xs-12">
                    <section class="boxs boxs-simple text-center">
                      <div class="boxs-widget l-green p-30 -t">
                        <i class="fa fa-shopping-cart fa-3x"></i>
                      </div>
                      <div class="boxs-body">
                        <h2 class="m-0"> <?=$TotalPesananTiket['TotalPesan'];?>Buah</h2>
                        <strong>Pesanan Tiket </strong></h3></i>
                      </div>
                    </section>                       
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <section class="boxs boxs-simple text-center">
                      <div class="boxs-widget l-blue p-30 -t">
                        <i class="fa fa-shopping-cart fa-3x"></i>
                      </div>
                      <div class="boxs-body">
                        <h2 class="m-0">  <?=$TotalPesananUmroh['TotalPesanNya'];?> Orang</h2>
                        <strong>Pesanan Umroh </strong></h3></i>
                      </div>
                    </section>                       
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <section class="boxs boxs-simple text-center">
                      <div class="boxs-widget bg-info p-30 -t">
                        <i class="fa fa-shopping-cart fa-3x"></i>
                      </div>
                      <div class="boxs-body">
                        <h2 class="m-0">  <?=$TotalPesananHaji['TotalPesanNya'];?> Orang</h2>
                        <strong>Pesanan Haji </strong></h3></i>
                      </div>
                    </section>                       
                  </div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <section class="boxs boxs-simple text-center">
                      <div class="boxs-widget bg-red p-30 -t">
                        <i class="fa fa-shopping-cart fa-3x"></i>
                      </div>
                      <div class="boxs-body">
                        <h2 class="m-0">  <?=$TotalPesananParis['TotalPesanNya'];?> Orang</h2>
                        <strong>Pesanan Tour </strong></h3></i>
                      </div>
                    </section>                       
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <section class="boxs">
                      <div class="boxs-header">
                        <h3 class="custom-font">
                          <strong>Pelanggan</strong></h3>
                        </div>
                        <div class="boxs-body">
                          <div id="bar-example" ></div>
                        </div>
                      </section>
                    </div>
                  </div>

                  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/gaugejs/gauge.min.js';?>"></script>
                  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/raphael/raphael-min.js';?>"></script>
                  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/d3/d3.v2.js';?>"></script>
                  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/rickshaw/rickshaw.min.js';?>"></script>
                  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/easypiechart/jquery.easypiechart.min.js';?>"></script>
                  <script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/js/vendor/countTo/jquery.countTo.js';?>"></script>
                  <script type="text/javascript">
                   $(window).load(function () {   
                    Morris.Bar({
                      element: 'bar-example',
                      data: [
                      { y: '2009', a: 75, b: 65 },
                      { y: '2010', a: 50, b: 40 },
                      { y: '2011', a: 75, b: 65 },
                      { y: '2012', a: 100, b: 90 }
                      ],
                      xkey: 'y',
                      ykeys: ['a'],
                      labels: ['Series A'],
                      barColors: ['#2ec7c9']
                    });
                  });


                </script>