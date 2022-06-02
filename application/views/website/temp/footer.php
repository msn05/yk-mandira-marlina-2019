<footer class="revealed">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div id="social_footer">
					<p>© Citytours 2018 Modifed by Nanda and MArlina</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/js/common_scripts_min.js';?>"></script>
<script src="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/js/functions.js';?>"></script>

<script>
	$('input.date-pick').datepicker('setDate', 'today');
	$('input.time-pick').timepicker({
		minuteStep: 15,
		showInpunts: false
	})
</script>

<script src="<?=base_url().'assets/citytourshtml-51/citytours_5.1/html/js/jquery.ddslick.js';?>"></script>
<script>
	$("select.ddslick").each(function() {
		$(this).ddslick({
			showSelectedHTML: true
		});
	});
</script>




</body>
</html>