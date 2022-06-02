  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Dokument Penerbangan</h1>
  					<small class="text-muted">Welcome to </small>
          </div>
        </div>
        <div class="row">
         <div class="col-md-12">
          <section class="boxs ">
            <div class="boxs-body">
             <div class="table-responsive">
              <table id="datatable" class="display" style="width:100%">
               <thead>
                <tr>
                 <th>No</th>
                 <th>Kode Penerbangan</th>
                 <th>File Dokumen</th>
               </tr>
             </thead>
             <tfoot>
              <tr>
               <th>No</th>
               <th>Kode Penerbangan</th>
               <th>File Dokumen</th>
             </tr>
           </tfoot>
         </table>
       </div>
     </div>
   </section>
 </div>
</div>
</div>
</div>
</div>
</section>

<script>

  $(document).ready(function() {
   var base_url = "<?php echo base_url();?>";
   $('#datatable').DataTable({
    "serverSide": true,
    "cache"  : false,
    "ajax":{
     url :  base_url + 'data/DokumenKemitraan/Datapenerbangan',
     type : 'POST',
   },
   "columnDefs": [{ 
     "targets": [0],
     "orderable": false
   }]
 });
 });

</script>