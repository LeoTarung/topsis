@extends('main')
@section('container')
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-6">
                    <h2 class=" d-flex justify-content-start">Perhitungan Topsis</h4>
                </div>
                <div class="col-6 d-flex  justify-content-end h-50">
                    <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#ModalTerpilih"><i
                            class="fas fa-eye"></i> Hasil</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Data Penilaian
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Kode Produk</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $alternatifCount; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    <td>{{ $alternatifProduk[$a] }}</td>
                                    @if ($penilaian->where('kode_alternatif', $alternatifKode[$a])->first() != null)
                                        {{-- @php
                                            dd($penilaian->where('kode_alternatif', $alternatifKode[$a])->get());
                                        @endphp --}}
                                        @foreach ($penilaian->where('kode_alternatif', $alternatifKode[$a])->get() as $p)
                                            <td>{{ $p->nilai }}</td>
                                            {{-- @endfor --}}
                                        @endforeach
                                    @else
                                        @for ($b = 1; $b <= $kriteriaCount; $b++)
                                            <td></td>
                                        @endfor
                                    @endif
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i>MATRIX KEPUTUSAN TERNOMALISASI
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Kode Produk</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $dataCountMatrix; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    <td>{{ $alternatifProduk[$a] }}</td>
                                    @for ($b = 0; $b < $kriteriaCount; $b++)
                                        <td>{{ number_format($dataMatrix[$a][$b], 2) }}</td>
                                    @endfor

                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i>MATRIX KEPUTUSAN TERNOMALISASI DAN TERBOBOT
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Kode Produk</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $dataCountMatrix2; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    <td>{{ $alternatifProduk[$a] }}</td>
                                    @for ($b = 0; $b < $kriteriaCount; $b++)
                                        <td>{{ number_format($dataMatrix2[$a][$b], 2) }}</td>
                                    @endfor

                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Nilai Solusi Max Positif dan Min Negatif
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Keterangan</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Maximal</td>
                                @for ($i = 0; $i < $kriteriaCount; $i++)
                                    <td>{{ number_format($max[$i], 2) }}</td>
                                @endfor
                            </tr>
                            <tr>
                                <td>Minimal</td>
                                @for ($j = 0; $j < $kriteriaCount; $j++)
                                    <td>{{ number_format($min[$j], 2) }}</td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i>D- dan D+
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Kode Produk</th>
                                <th>D+</th>
                                <th>D-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $alternatifCount; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    <td>{{ $alternatifProduk[$a] }}</td>
                                    <td>{{ number_format($D_plus[$a], 2) }}</td>
                                    <td>{{ number_format($D_min[$a], 2) }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Data MIN MAX
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Keterangan</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Maximum</td>
                                @for ($i = 0; $i < $kriteriaCount; $i++)
                                    <td>{{ $penilaian->where('kode_kriteria', 'C' . ($i + 1))->max('nilai') }}</td>
                                @endfor
                            </tr>
                            <tr>
                                <td>Minimum</td>
                                @for ($j = 0; $j < $kriteriaCount; $j++)
                                    <td>{{ $penilaian->where('kode_kriteria', 'C' . ($j + 1))->min('nilai') }}</td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        {{-- <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i> NORMALISASI
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $dataCount; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    @for ($b = 0; $b < $kriteriaCount; $b++)
                                        <td>{{ number_format($data[$a][$b], 2) }}</td>
                                    @endfor

                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        {{-- <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i> PERANKINGAN
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama</th>
                                @for ($k = 0; $k < $kriteriaCount; $k++)
                                    <th class="text-center" scope="col">{{ $kriteria[$k] }}</th>
                                @endfor
                                <th class="text-center">Total Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $dataCount; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    @for ($b = 0; $b < $kriteriaCount; $b++)
                                        <td class="text-center">{{ number_format($rank[$a][$b], 2) }}</td>
                                    @endfor
                                    <td class="text-center">{{ number_format($hasil[$a], 2) }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i>Perankingan
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Kode Produk</th>
                                <th>Nilai Qi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $alternatifCount; $a++)
                                <tr>
                                    <td>{{ $rank[$a]['Supplier'] }}</td>
                                    <td>{{ $rank[$a]['Produk'] }}</td>
                                    <td>{{ $rank[$a]['Nilai'] }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i>Supplier Terpilih
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Kode Produk</th>
                                <th>Nilai Qi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $rank[0]['Supplier'] }}</td>
                                <td>{{ $rank[0]['Produk'] }}</td>
                                <td>{{ $rank[0]['Nilai'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalTerpilih" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-6" id="ModalDeclineLabel">Hasil Perhitungan</h3>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2">
                        <table class="table m-2 ">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="text-center">Nama Supplier</th>
                                    <th scope="col" class="text-center">Kode Produk</th>
                                    <th class="text-center">Nilai Qi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $rank[0]['Supplier'] }}</td>
                                    <td class="text-center">{{ $rank[0]['Produk'] }}</td>
                                    <td class="text-center">{{ $rank[0]['Nilai'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
