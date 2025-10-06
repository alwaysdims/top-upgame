 <!-- Pre-header Starts -->
 <div class="pre-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-7">
          <ul class="info">
            <li><a href="#"><i class="fa fa-envelope"></i>dimspedia@gmail.com</a></li>
            <li><a href="#"><i class="fa fa-phone"></i>010-020-0340</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-sm-4 col-5">
          <ul class="social-media">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-behance"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Pre-header End -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
                <div class="row">
                    <div class="col-6">
                        <img src="{{ '../../Front-end/' }}assets/images/haya.jpeg" alt="" style="width: 50px; height: 50px; border-radius: 100%;">
                    </div>
                    <div class="col-6">
                        <h4 class="text text-black text-lg text-center " style="margin-top: 34px"><strong>dPedia</strong></h4>
                    </div>
                </div>
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="{{ route('home.index') }}" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="{{ route('home.index') }}">Artikel</a></li>
              <li class="scroll-to-section"><a href="{{ route('home.cari') }}">Cari transaksi</a></li>
              <li class="scroll-to-section"><div class="border-first-button"><a href="{{ route('home.loginUser') }}"></a></div></li>
            </ul>
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
