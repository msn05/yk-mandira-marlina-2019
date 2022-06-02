  <section id="content">
  	<div class="page page-forms-common">
  		<!-- bradcome -->
  		<div class="b-b mb-10">
  			<div class="row">
  				<div class="col-sm-6 col-xs-12">
  					<h1 class="h3 m-0">Dokument Mitra Bus Perusahaan</h1>
  					<small class="text-muted">Welcome to </small>
  				</div>
         <div class="col-md-12">
          <section class="boxs ">
           <div class="boxs-body">
             <div class="table-responsive">
              <table id="datatable" class="display" style="width:100%">
                <thead>
                  <tr>
                   <th>No</th>
                   <th>Nama Bus</th>
                   <th>Data Dokumen</th>
                 </tr>
               </thead>
               <tfoot>
                <tr>
                 <tr>
                   <th>No</th>
                   <th>Nama Bus</th>
                   <th>Data Dokumen</th>
                 </tr>
               </tr>
             </tfoot>
             <tbody>
             </tbody>
           </table>
         </div>
       </div>
     </section>
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
     "cache"  : true,
     "ajax":{
       url :  base_url + 'data/DokumenKemitraan/DataBus',
       type : 'POST',
     },
     "columnDefs": [{ 
       "targets": [0],
       "orderable": false
     }]
   });
 });
</script>
