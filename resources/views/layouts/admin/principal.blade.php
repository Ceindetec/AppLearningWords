<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name='csrf-param' content='authenticity_token'>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Control RFID! | </title>

  <!-- Bootstrap -->
  {!!Html::style('vendors/bootstrap/dist/css/bootstrap.min.css')!!} 
  <!-- Font Awesome -->
  {!!Html::style('vendors/font-awesome/css/font-awesome.min.css')!!}
  <!-- iCheck -->
  <!-- {!!Html::style('vendors/iCheck/skins/flat/green.css')!!}-->
  <!-- bootstrap-progressbar -->
  {!!Html::style('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')!!}
  <!-- jVectorMap -->
  <!-- {!!Html::style('css/maps/jquery-jvectormap-2.0.3.css')!!} -->
  <!-- Custom Theme Style -->
  {!!Html::style('build/css/custom.css')!!}
  <!-- Kendo css-->
  {!!Html::style('css/kendo/kendo.common.min.css')!!}
  {!!Html::style('css/kendo/kendo.bootstrap.min.css')!!}
  <!-- msgbox css-->
  {!!Html::style('css/msgbox/jquery.msgbox.css')!!}

  <!-- Datatables -->
  
  {!!Html::style('vendors/datatable/css/jquery.dataTables.css')!!}

  {!!Html::style('css/general.css')!!}

  @yield('css')

</head>

<body class="nav-md">

  <div class="animacarga">
    
    <div class="cssload-thecube">
      <div class="cssload-cube cssload-c1"></div>
      <div class="cssload-cube cssload-c2"></div>
      <div class="cssload-cube cssload-c4"></div>
      <div class="cssload-cube cssload-c3"></div>
    </div>

  </div>

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Control RFID!</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <!-- <div class="profile">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>John Doe</h2>
            </div>
          </div>  Esta seria usada en caso que este manejando usuarios con avatar   --> 
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          @include('layouts.admin.menusliderbar')
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <!--@include('layouts.admin.menufootherslider')-->
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->

      @include('layouts.admin.menutop')

      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         @yield('content')
       </div>


     </div>
     <!-- /page content -->

     <!-- footer content -->
     <footer>
      <div class="pull-right">
        Ceindetec llanos - 2016
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>


<!-- Modal Bootstrap-->
<div id='modalBs' class='modal fade bs-example-modal-lg'>
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- jQuery -->
{!!Html::script('vendors/jquery/dist/jquery.min.js')!!}
<!-- Bootstrap -->
{!!Html::script('vendors/bootstrap/dist/js/bootstrap.min.js')!!}
<!-- FastClick -->
<!-- {!!Html::script('vendors/fastclick/lib/fastclick.js')!!} -->
<!-- NProgress -->
<!-- {!!Html::script('vendors/nprogress/nprogress.js')!!} -->
<!-- Chart.js -->
<!-- {!!Html::script('vendors/Chart.js/dist/Chart.min.js')!!} -->
<!-- gauge.js -->
<!-- {!!Html::script('vendors/gauge.js/dist/gauge.min.js')!!} -->
<!-- bootstrap-progressbar -->
{!!Html::script('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')!!}
<!-- iCheck -->
<!-- {!!Html::script('vendors/iCheck/icheck.min.js')!!} -->
<!-- Skycons -->
<!-- {!!Html::script('vendors/skycons/skycons.js')!!} -->
<!-- Flot -->
<!-- {!!Html::script('vendors/Flot/jquery.flot.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.pie.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.time.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.stack.js')!!}
{!!Html::script('vendors/Flot/jquery.flot.resize.js')!!} -->
<!-- Flot plugins -->
<!-- {!!Html::script('js/flot/jquery.flot.orderBars.js')!!}
{!!Html::script('js/flot/date.js')!!}
{!!Html::script('js/flot/jquery.flot.spline.js')!!}
{!!Html::script('js/flot/curvedLines.js')!!} -->
<!-- jVectorMap -->
<!-- {!!Html::script('js/maps/jquery-jvectormap-2.0.3.min.js')!!} -->
<!-- bootstrap-daterangepicker -->
{!!Html::script('js/moment/moment.min.js')!!}
{!!Html::script('js/datepicker/daterangepicker.js')!!}

<!-- Datatables -->
{!!Html::script('vendors/datatable/js/jquery.dataTables.js')!!}

<!-- Custom Theme Scripts -->
{!!Html::script('build/js/custom.min.js')!!}

<!-- msgbox js-->
{!!Html::script('js/msgbox/jquery.msgbox.js')!!}



<!--kendojs -->
{!!Html::script('js/kendo/kendo.all.min.js')!!}
{!!Html::script('js/kendo/cultures/kendo.culture.es-ES.min.js')!!}
{!!Html::script('js/kendo/lang/kendo.es-ES.js')!!}


<script type="text/javascript">
kendo.culture("es-ES");
</script>

{!!Html::script('js/inicio.js')!!}  


<!-- jVectorMap -->
<!--{!!Html::script('js/maps/jquery-jvectormap-world-mill-en.js')!!}
{!!Html::script('js/maps/jquery-jvectormap-us-aea-en.js')!!}
{!!Html::script('js/maps/gdp-data.js')!!}-->

@yield('scripts')

</body>
</html>