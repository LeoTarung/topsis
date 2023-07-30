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
            <h5> Sistem Pendukung Keputusan Pemilihan Vendor </h5>
        </div>
        {{-- <img src="/img/guru.png" alt="" class="guru"> --}}
        {{-- </div> --}}
    </div>
@endsection
