<script src="{{asset('assets/js/core/jquery.min.js')}}"></script> 
<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('assets/img/sidebar-1.jpg')}}">
 <!-- tip 1: you can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"tip 2: you can also add an image using data-image tag --> 
 <div class="logo"> 
  <a href="" class="simple-text logo-mini"> H </a> 
  <a href="" class="simple-text logo-normal"> Hotel </a> 
</div> <div class="sidebar-wrapper ps-container ps-theme-default ps-active-y" data-ps-id="1d9eb305-f1eb-ddfb-9b45-c18f312e7051"> 
  <div class="user"> 
    <div class="photo">
     <img src="{{asset('assets/img/faces/'.session('images'))}}"> </div> 
     <div class="user-info"> 
      <a data-toggle="collapse" href="#collapseexample" class="username"> 
        <span> {{session('name')}}
          <b class="caret"></b> 
        </span> 
      </a> 
      <div class="collapse @yield('show-profile')" id="collapseexample">
       <ul class="nav"> 
        <li class="nav-item @yield('active-profile')">  <a class="nav-link" href="{{route('logout')}}"> <span class="sidebar-mini"> <i class="material-icons"> exit_to_app </i> </span> <span class="sidebar-normal"> Log out </span> </a> 
        </li> 
      </ul> 
    </div> 
  </div> 
</div> 
<ul class="nav">
  <li class="nav-item @yield('active-dashboard')"> 
    <a class="nav-link " href="{{route('dashboard')}}"> 
      <i class="material-icons">dashboard</i> 
      <p> Dashboard </p> 
    </a> 
  </li>
  <li class="nav-item @yield('active-check')">
    <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
      <i class="fa fa-key"></i>
      <p> Check In / Out
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @yield('show-check')" id="pagesExamples">
      <ul class="nav">
        <li class="nav-item @yield('active-checkin')">
          <a class="nav-link" href="{{ route('checkin') }}">
            <span class="sidebar-mini"> CI </span>
            <span class="sidebar-normal"> Check In </span>
          </a>
        </li>
        <li class="nav-item @yield('active-checkout')">
          <a class="nav-link" href="{{route('checkout')}}">
            <span class="sidebar-mini"> CO </span>
            <span class="sidebar-normal"> Check Out </span>
          </a>
        </li>
        <li class="nav-item @yield('active-tamuinhouse')">
          <a class="nav-link" href="{{route('tamuinhouse')}}">
            <span class="sidebar-mini"> TH </span>
            <span class="sidebar-normal"> Tamu in House </span>
          </a>
        </li>
      </ul>
    </div>
  </li> 
  <li class="nav-item @yield('active-room')">
    <a class="nav-link" data-toggle="collapse" href="#pagesExamplesa">
      <i class="material-icons">book</i>
      <p> Room Services
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @yield('show-room')" id="pagesExamplesa">
      <ul class="nav">
        <li class="nav-item @yield('active-pesanlayanan')">
          <a class="nav-link" href="{{ route('pesanlayanan') }}">
            <span class="sidebar-mini"> PL </span>
            <span class="sidebar-normal"> Pesan Layanan / Produk </span>
          </a>
        </li>
        <li class="nav-item @yield('active-pembersihankamar')">
          <a class="nav-link" href="{{route('pembersihankamar')}}">
            <span class="sidebar-mini"> PK </span>
            <span class="sidebar-normal"> Pembersihan Kamar </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item @yield('active-kamar')">
    <a class="nav-link" data-toggle="collapse" href="#pagesExamplesw">
      <i class="fa fa-bed"></i>
      <p> Kamar
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @yield('show-kamar')" id="pagesExamplesw">
      <ul class="nav">
        <li class="nav-item @yield('active-lkamar')">
          <a class="nav-link" href="{{ route('lkamar') }}">
            <span class="sidebar-mini"> LK </span>
            <span class="sidebar-normal"> Lihat Kamar </span>
          </a>
        </li>
        <li class="nav-item @yield('active-tkamar')">
          <a class="nav-link" href="{{route('tkamar')}}">
            <span class="sidebar-mini"> TK </span>
            <span class="sidebar-normal"> Tipe Kamar </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item @yield('active-layanan')">
    <a class="nav-link" data-toggle="collapse" href="#pagesExampless">
      <i class="fa fa-cutlery"></i>
      <p> Layanan
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @yield('show-layanan')" id="pagesExampless">
      <ul class="nav">
        <li class="nav-item @yield('active-llayanan')">
          <a class="nav-link" href="{{route('llayanan')}}">
            <span class="sidebar-mini"> LL </span>
            <span class="sidebar-normal"> Lihat Layanan </span>
          </a>
        </li>
        <li class="nav-item @yield('active-klayanan')">
          <a class="nav-link" href="{{route('klayanan')}}">
            <span class="sidebar-mini"> KL </span>
            <span class="sidebar-normal"> Kategori Layanan </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item @yield('active-transaksi')">
    <a class="nav-link" data-toggle="collapse" href="#pagesExamplesss">
      <i class="material-icons">assignment</i>
      <p> Laporan
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @yield('show-transaksi')" id="pagesExamplesss">
      <ul class="nav">
        <li class="nav-item @yield('active-transkamar')">
          <a class="nav-link" href="{{route('transkamar')}}">
            <span class="sidebar-mini"> TK </span>
            <span class="sidebar-normal"> Transaksi Kamar </span>
          </a>
        </li>
        <li class="nav-item @yield('active-translayanan')">
          <a class="nav-link" href="{{route('translayanan')}}">
            <span class="sidebar-mini"> TL </span>
            <span class="sidebar-normal"> Transaksi Layanan </span>
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item @yield('active-tamu')"> 
    <a class="nav-link " href="{{route('tamu')}}"> 
      <i class="material-icons">work</i> 
      <p> Buku Tamu </p> 
    </a> 
  </li> 
  <li class="nav-item @yield('active-user')"> 
    <a class="nav-link " href="{{route('user')}}"> 
      <i class="material-icons">face</i> 
      <p> User Management </p> 
    </a> 
  </li>
</ul> 
<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"> 
  <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"> 
  </div> 
</div>
<div class="ps-scrollbar-y-rail" style="top: 0px; height: 550px; right: 0px;"> 
  <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 493px;"> 
  </div>
</div>
</div>
<div class="sidebar-background" style="background-image: url(../assets/img/sidebar-1.jpg) "> 
</div> 
</div>