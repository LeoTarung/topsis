@extends('main')
@section('container')
    <style>
        .background {
            background-image: url('{{ asset('/img/dashboard.jpg') }}');
            /* width: 100; */
            height: auto;
            position: relative;
            z-index: 0;
            height: 100px weight:100px
        }

        .guru {
            width: 75%;
            height: auto;
            margin-top: -450px;
            margin-left: 100px;
        }
    </style>
    <!-- Page Content  -->
    <div class="container-fluid">
        {{-- <div class="background"> --}}
        <div id="content" class="px-4  p-md-5 pt-5 ">
            <h2 class="mb-4">Selamat Datang, </h2>
            <h5> Sistem Pendukung Keputusan Pemilihan Supplier </h5>
            <div class="row mt-4">
                <div class="col-3">
                    <div class="card" style="background-color: #6F807F;">
                        <div class="card-body">
                          <h4>Calon Supplier</h4>
                          <div class="row">
                            <div class="col-6">
                                <div style="font-size: 70px;">{{ $produk->count()}}</div>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <img src="/useruser.png" style="width: 100px" alt="">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="background-color: #6F807F;">
                        <div class="card-body">
                          <h4>Supplier Terpilih</h4>
                          <div class="row">
                            <div class="col-6">
                                <div style="font-size: 70px;">{{ $countValidasi }}</div>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <img src="/useruser.png" style="width: 100px" alt="">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->role == 'SERVICE MANAGER')

                @else
                <div class="col-3">
                    <div class="card" style="background-color: #6F807F;">
                        <div class="card-body">
                            <h4>Jumlah Surat</h4>
                            <div class="row">
                                <div class="col-6">
                                    <div style="font-size: 70px;">{{ $request->where('validasi', null)->count()}}</div>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <img src="/doc.png" style="width: 100px" alt="">
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
        {{-- <img src="/img/guru.png" alt="" class="guru"> --}}
        {{-- </div> --}}


    </div>
@endsection
