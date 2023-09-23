{{-- <nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4">
        <div class="card d-flex justify-content-center" style="padding-left: 35px;">
            <h1 class="m-2 " style="margin-left: 25%;"><a href="/" class="logo"> <img src="/img/logo.png"
                        alt="" style="width: 75%;"><span>Sistem
                        Pemilihan</span></a></h1>
        </div>

        <ul class="list-unstyled components mb-5">
            <li>
                <a href="/"><span class="fa fa-home mr-3"></span> Home</a>
            </li>
            <li>
                <a href="/kriteria"><span class="fa fa-briefcase mr-3"></span>Data Kriteria</a>
            </li>
            <li>
                <a href="/subKriteria"><span class="fa fa-briefcase mr-3"></span>Data Sub Kriteria</a>
            </li>
            <li>
                <a href="/alternatif"><span class="fa fa-user mr-3"></span>Data Alternatif</a>
            </li>
            <li>
                <a href="/penilaian"><span class="fa fa-sticky-note mr-3"></span>Penilaian</a>
            </li>
            <li>
                <a href="/perhitungan"><span class="fa fa-suitcase mr-3"></span>Perhitungan SAW</a>
            </li>
            <li>
                <a href="/hasil"><span class="fa fa-cogs mr-3"></span>Hasil</a>
            </li>
        </ul>

        <div class="footer">
            <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>

    </div>
</nav> --}}

{{-- <div class="">
    <h1 class="px-4"><a href="index.html" class="logo"><img src="/logo.png" style="width:200px;" alt=""
                srcset=""></a></h1>
    <ul class="list-unstyled components mb-5">

        <li>
            <a href="/kriteria"><span class="fa fa-home mr-3"></span> Kriteria</a>
        </li>
        <li>
            <a href="/alternatif"><span class="fa fa-user mr-3"></span> Alternatif</a>
        </li>
        <li>
            <a href="#"><span class="fa fa-sticky-note mr-3"></span> Perhitungan</a>
        </li>
        <li>
            <a href="#"><span class="fa fa-cogs mr-3"></span> Services</a>
        </li>
        <li>
            <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a>
        </li>
    </ul>

</div> --}}
<style>
    #sidebar {
    height: 100%;
    position: fixed;
}

/* Adjust the height based on your sidebar's height */
#sidebar-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    /* width: 100%;? */
    /* background-color: #f8f9fa; Adjust background color as needed
    */
     color: #fffff;
    text-align: center;
    padding: 10px; /* Add padding to improve appearance */
}






</style>
<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="row">
            <div class="col-6 "> <img src="/usericon.png" style="width: 100px;" alt="" srcset=""></div>
            <div class="col-6 d-flex align-items-start  flex-column">
                {{-- <div> --}}
                <h5 class="align-middle mt-4" style="margin-left: -14%">{{ Auth::user()->role }}</h5>
                <div class="row ">
                    <div class="card"
                        style="margin-top:8%;width:10px; height:10px;border-radius:20px;;background-color:greenyellow;">
                    </div>
                    <span class="ms-5 mb-3" style="font-size: 15px; margin-left:10px; "> Online</span>
                </div>

                {{-- </div> --}}
                {{-- <br> --}}
                {{-- <div>

                </div> --}}

            </div>

        </div>

    </div>

    <ul class="list-unstyled components">
        {{-- <p>Dummy Heading</p> --}}
        @if ( Auth::user()->role == 'SPARE PART' )
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Data Master</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="/produk">Produk</a>
                </li>
                <li>
                    <a href="/kriteria">Kriteria</a>
                </li>
                <li>
                    <a href="/alternatif">Alternatif</a>
                </li>
                <li>
                    <a href="/surat/pengajuan">Surat Pengajuan</a>
                </li>
                <li>
                    <a href="/user">User</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="/perhitungan">Perhitungan</a>
        </li>
        <li>
            <a href="/validasi">Validasi</a>
        </li>
        @elseif (Auth::user()->role == 'SERVICE MANAGER' )
        <li>
            <a href="/">Dashboard</a>
        </li>
        <li>
            <a href="/perhitungan">Perhitungan</a>
        </li>
        <li>
            <a href="/surat/pengajuan">Surat Pengajuan</a>
        </li>
        <li>
            <a href="/validasi">Validasi</a>
        </li>
        @elseif (Auth::user()->role == 'HEAD OFFICE' )
        <li>
            <a href="/validasi">Validasi</a>
        </li>
        @endif

        <li>
            {{-- <a href="/laporan">Laporan</a> --}}
        </li>
    </ul>

     <!-- Footer content here -->
     <div class="sidebar-footer" id="sidebar-footer">
        <a href="/logout"><p style="color: white;">Logout</p></a>
    </div>

</nav>
