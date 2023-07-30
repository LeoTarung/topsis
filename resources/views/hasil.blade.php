@extends('main')
@section('container')
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-6">
                    <h2 class=" d-flex justify-content-start">Hasil Akhir Perhitungan</h4>
                </div>
                <div class="col-6 d-flex  justify-content-end h-50"><a href="{{ route('print') }}"><button
                            class="btn btn-secondary mt-2 border-5 shadow-lg" style="background-color:aliceblue"><i
                                class="fa fa-print"></i>
                            Print</h4></a>

                </div>

            </div>
            <div class="table-responsive">

                <table class="table m-2 ">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="text-center">Ranking</th>
                            <th scope="col">Nama</th>
                            <th>Nilai Qi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($NilaiQi as $key)
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td>{{ $key['alternatif']['nama_vendor'] }}</td>
                                <td>{{ number_format($key['nilai_qi'], 3) }}</td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
