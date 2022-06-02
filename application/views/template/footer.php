
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/flotscripts.bundle.js';?>"></script>    
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/d3cripts.bundle.js';?>"></script>
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/sparkline.bundle.js';?>"></script>
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/raphael.bundle.js';?>"></script>
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/morris.bundle.js';?>"></script>
<script src="<?=base_url().'assets/temp_dep/falconadmin/html/assets/bundles/loadercripts.bundle.js';?>"></script>

<script>
	
	$('#Keluar').click(function(){
		var base_url = "<?php echo base_url();?>";
		$.ajax({
			type: "POST",
			url: base_url + 'login/ProsesKeluar',
			dataType: "JSON",
			success: function (respone) {
				if (respone.status == 'success') {
					swal({
						type: 'success',
						title: respone.status,
						text: respone.message,
						timer: 1200,
					},
					function () {
						window.location.href = base_url + 'login';
					});
				}else{
					swal({
						type: 'error',
						title: respone.status,
						text: respone.message,
						timer: 1200,
					})
				}
			}
		});
	});

</script>

</body>
</html>