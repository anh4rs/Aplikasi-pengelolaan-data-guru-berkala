
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Aplikasi Pengelolaan Data Guru Berkala
  </title>
  <link href="{{asset('img/logo.png')}}" rel="icon" type="image/png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="{{asset('admin/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
  <link href="{{asset('css/datatable/datatable.css')}}" rel="stylesheet" />
  <link href="{{asset('datepicker/bootstrapDatePicker.min.css')}}" rel="stylesheet"/>
</head>
<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand pt-0" href="{{Route('adminIndex')}}">
        <img src="{{asset('img/logo.png')}}" class="navbar-brand-img" alt="..."> Disdik Tapin
      </a>
      <p style="text-align:center">Admin Disdik Tapin</p>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link " href="{{Route('golonganIndex')}}">
              <i class="ni ni-bullet-list-67 "></i> golongan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{Route('jabatanIndex')}}">
              <i class="ni ni-bullet-list-67 "></i> Jabatan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{Route('sekolahIndex')}}">
              <i class="ni ni-building "></i> Sekolah
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{Route('mpIndex')}}">
              <i class="ni ni-book-bookmark "></i> Mata Pelajaran
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{Route('guruIndex')}}">
              <i class="ni ni-single-02 "></i> Guru
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{Route('diklatIndex')}}">
              <i class="ni ni-single-02 "></i> Program Diklat
            </a>
          </li>
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading text-muted">Berkala</h6>
        <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
            <a class="nav-link" href="{{Route('gajiFilterTahun')}}">
              <i class="ni ni-satisfied"></i> Data Gajih Guru
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('dataPermohonanIndex')}}">
              <i class="ni ni-archive-2"></i> Data Permohonan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('dataBerkalaIndex')}}">
              <i class="ni ni-archive-2"></i> Data Berkala
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="">
              <i class="ni ni-paper-diploma"></i> Jenjang karir
            </a>
          </li> -->
        </ul>
        <hr class="my-3">
        <h6 class="navbar-heading text-muted">Dinas pendidikan</h6>
        <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
            <a class="nav-link" href="{{Route('beritaIndex')}}">
              <i class="ni ni-single-copy-04"></i> Berita
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('karyawanIndex')}}">
              <i class="ni ni-circle-08"></i> Karyawan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{Route('pejabatStrukturalIndex')}}">
              <i class="ni ni-active-40"></i> Pejabat Struktural
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Aplikasi Pengelolaan Data Berkala guru</a>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{asset('img/user/default.jpg')}}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    @yield('content')
     <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{{asset('admin/js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('admin/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin/js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('admin/js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
  <script src="{{asset('admin/js/argon-dashboard.min.js?v=1.1.0')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="{{asset('js/datatable/dataTable.bootstrap.js')}}"></script>
  <script src="{{asset('js/datatable/jquery.dataTable.js')}}"></script>
  <script src="{{asset('js/sweetalert/sweetalert.all.min.js')}}"></script>
  <script src="{{asset('datepicker/bootstapDatePicker.min.js')}}"></script>


@yield('script')
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>
