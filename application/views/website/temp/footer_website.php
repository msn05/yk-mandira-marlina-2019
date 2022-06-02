
<div class="footer">
 <div class="container footer-top">
 </div>
 <div class="container-fluid footer-bottom px-0">
  <div class="row no-gutters mx-0">

   <div class="col-md-12 text-center">

    <p>Copyright © 2020 <span class="template-name">LeadPage</span>. Designed by <a href="https://themeforest.net/user/epic-themes/portfolio?ref=Epic-Themes" target="_blank">Epic-Themes</a> Modified by Marlina dan Nanda</p>

  </div>
  <!--end col-md-6 -->

</div>
<!--end row -->

</div>
<!--end container -->

</div>

<script src="<?=base_url().'assets/leadPage/js/jquery-3.3.1.min.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/bootstrap.min.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/jquery.scrollTo-min.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/jquery.magnific-popup.min.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/jquery.nav.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/wow.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/plugins.js';?>"></script>
<script src="<?=base_url().'assets/leadPage/js/custom.js';?>"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
 CKEDITOR.replace( 'editor1',{
  height: 150,
  toolbar:[
  ],
} );
 CKEDITOR.replace( 'editor2',{
  height: 150,
  toolbar:[
  ],
} );

$('.Login').on(click,function(){
     document.location.href = 'index.php/Login';
})
</script>
</body>
</html>