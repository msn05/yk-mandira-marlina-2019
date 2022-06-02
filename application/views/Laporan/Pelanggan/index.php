  <section id="content">
    <div class="page page-ui-portlets">
      <!-- bradcome -->
      <div class="b-b mb-10">
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <h1 class="h3 m-0">Laporan Pelanggan Daftar</h1>
            <small class="text-muted">Welcome to Falcon application</small>
          </div>
        </div>
      </div>
      <form method="POST" id="SimpanData" class="form-horizontal">
        <div class="row">
          <div class="col-sm-6">
            <section class="boxs">
              <div class="boxs-header bg-blush">
                <h3 class="custom-font">
                  <strong>Laporan Data</strong></h3>
                </div>
                <div class="boxs-body">
                 <div class="row">
                  <div class="form-group col-sm-6">
                   <div class="col-sm-12">
                    <input type="date" class="form-control" placeholder="Tuliskan Nama layanan ini..!" id="tanggal1"  name="tanggal1" autocomplete="off" />
                    <small class="text-danger ">Dari Tanggal </small>
                  </div>
                </div>
                <div class="form-group col-sm-6">
                  <div class="col-sm-12">
                    <input type="date" class="form-control" placeholder="Tuliskan Nama layanan ini..!" id="tanggal2"  name="tanggal2" autocomplete="off" />
                    <small class="text-danger ">Sampai Tanggal </small>
                  </div>
                </div>
              </div>
              <hr class="line-dashed full-witdh-line" />
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-raised btn-primary">Cari</button>
                  <a href="<?=base_url().'data/layanan';?>">
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
    $('#SimpanData').on('submit', function (e) {
     e.preventDefault();
     var base_url = "<?php echo base_url();?>";
     var SimpanData = $(this);
     $.ajax({
      type: "POST",
      url: base_url + 'data/Laporan/Pelanggan',
      data: SimpanData.serialize(),
      dataType: "JSON",
      cache : "false",
      success: function (respone) {
       if (respone.status == 'success') {
        swal({
         type: 'success',
         title: respone.status,
         text: respone.message,
       },
       function () {
        window.location.href = base_url + 'data/Laporan/PelangganLaporan?date1='+respone.kode+'&date2='+respone.kode2
      });
      }else{
        swal({
         type: 'error',
         title: respone.status,
         text: respone.message,
       },
       function () {
        location.reload(true);
      });
      }
    }
  });
   });

 </script>


