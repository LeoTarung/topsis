@extends('main')
@section('container')
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-6">
                    <h2 class=" d-flex justify-content-start">Perhitungan Topsis</h4>
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
                                <th scope="col">Nama Produk</th>
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
                                <th scope="col">Nama Produk</th>
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
                                <th scope="col">Nama Produk</th>
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
                                    <td>{{ $max[$i] }}</td>
                                @endfor
                            </tr>
                            <tr>
                                <td>Minimal</td>
                                @for ($j = 0; $j < $kriteriaCount; $j++)
                                    <td>{{ $min[$j] }}</td>
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
                                <th scope="col">Nama Produk</th>
                                <th>D+</th>
                                <th>D-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($a = 0; $a < $alternatifCount; $a++)
                                <tr>
                                    <td>{{ $alternatif[$a] }}</td>
                                    <td>{{ $alternatifProduk[$a] }}</td>
                                    <td>{{ $D_plus[$a] }}</td>
                                    <td>{{ $D_min[$a] }}</td>
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
                                <th scope="col">Nama Produk</th>
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
    </div>


    <script></script>
@endsection
