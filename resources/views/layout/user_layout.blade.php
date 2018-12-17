<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

<!--User define meta tag-->
<meta name="Author" content="A N M Suza"/>

<title>@yield('title') </title>
<!-- Bootstrap CSS and other -->
<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('user/css/font-awesome-all.min.css')}}"/>
<link rel="stylesheet" href="{{asset('user/css/mystyle.css')}}"/>
<link rel="stylesheet" href="{{asset('user/css/jquery-ui.css')}}"/>  
<!--link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css"/-->

<div class="header container"><!-- Starting header-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<a class="navbar-brand" href="#"><img src="/user/images/snalogo.png" alt="Loading..." /></a>

<ul class="navbar-nav mr-auto">

      <li class="nav-item active">
        <a class="nav-link"  href="/sna_lms/home.php">Home</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link"  href="/sna_lms/files/viewdata.php">View</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/sna_lms/files/leave_submit.php">Submit</a>
      </li>

</ul>
<a href="#"> <i class="fas fa-user"></i>

<form class="form-inline my-2 my-lg-0"">
	<label style="padding-left:7px; padding-right: 20px;">

		<!--<a class="nav-link" data-toggle="modal" href="#pass-change">Change Passwrod</a>-->
	    <a class="nav-link" href="/sna_lms/files/logout.php">Logout</a>
	</label>
  <!--<input class="form-control " type="search" placeholder="Search">
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
</form> </a>	
</nav>
</div><!--End header-->
<!--Linking Script files-->
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script src="{{asset('user/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('user/js/popper.min.js')}}"></script>
<script src="{{asset('user/js/fontawesome-all.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/jquery-ui.js')}}"></script>

@yield('body')


<!-- Footer -->
<footer class="page-footer font-small teal pt-4">

    <!-- Footer Text -->
    <div class="container-fluid text-center text-md-left">

      <!-- Grid row -->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-6 mt-md-0 mt-3">

          <!-- Content -->
          <h5 class="text-uppercase font-weight-bold">Footer text 1</h5>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita sapiente sint, nulla, nihil repudiandae commodi voluptatibus corrupti animi sequi aliquid magnam debitis, maxime quam recusandae harum esse fugiat. Itaque, culpa?</p>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none pb-3">

        <!-- Grid column -->
        <div class="col-md-6 mb-md-0 mb-3">

          <!-- Content -->
          <h5 class="text-uppercase font-weight-bold">Footer text 2</h5>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio deserunt fuga perferendis modi earum commodi aperiam temporibus quod nulla nesciunt aliquid debitis ullam omnis quos ipsam, aspernatur id excepturi hic.</p>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Text -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->