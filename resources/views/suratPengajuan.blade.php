@extends('main')
@section('container')
    <!-- Page Content  -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="content" class="p-4 p-md-5 ">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-6">
                    <h2 class=" d-flex justify-content-start">Daftar Surat Pengajuan</h4>
                </div>
                <div class="col-6 d-flex  justify-content-end h-50">
                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tambah" onclick="tambah()"><i
                            class="fa fa-plus"></i> Tambah Data</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-secondary" style="color:wheat">
                    {{-- <i class="fa fa-paperclip"></i></i> Daftar Data Kriteria --}}
                </div>
                <div class="table-responsive">

                    <table class="table m-3 ">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No Surat</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col" class="text-center"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                // dd($dbRequest->first());
                            @endphp
                            @foreach ($dbRequest as $key)
                                <tr>
                                    <td scope="col">{{ $no }}</td>
                                    <td scope="col">{{ $key->no_request }}</td>
                                    <td scope="col">{{ $key->kode_produk }}</td>
                                    <td scope="col">{{ $key->produk->nama_produk }}</td>
                                    <td scope="col">{{ $key->jumlah }}</td>
                                    <td scope="col">pcs</td>
                                    <td scope="col">{{ $key->total_harga }}</td>
                                    <td scope="col">{{ $key->total_akhir }}</td>
                                    <td scope="col"> <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit" onclick="edit('{{ $key->no_request }}')">Edit</button>
                                        <button class="btn btn-danger"
                                            onclick="deleteRecord('{{ $key->no_request }}')">Hapus</button>
                                    </td>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    @php
                                        $no = $no + 1;
                                        // dd($key->no_request);
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah kriteria --}}
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  ">
            <form action="/pengajuan/tambah" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="no_request" class="w-50">NO REQUEST</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="no_request" name="no_request" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="jenis_kriteria " class="w-50">KODE PRODUK</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="kode_produk"
                                        name="kode_produk" value="{{ $produkTerpilih['Produk'] }}" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">HARGA SATUAN</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="harga_satuan"
                                            name="harga_satuan" value="{{ $hargaSatuan }}" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="keterangan" class="w-50">JUMLAH </label>
                                    <input type="number" class=" w-100 rounded border-primary fw-bold"
                                        aria-label="Dollar amount (with dot and two decimal places)" id="jumlah"
                                        name="jumlah" required onchange="jumlah_tambah()">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">DISKON</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="diskon"
                                            onchange="jumlah_tambah()" name="diskon" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">PPN</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="ppn"
                                            name="ppn" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">TOTAL AKHIR</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="total_akhir"
                                            name="total_akhir" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-cancel"
                            data-bs-dismiss="modal">Cancel</button>
                        {{-- <button type="submit" class="btn btn-primary" onclick="redirect()">Lanjutkan</button> --}}
                        <button type="submit" id="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Modal Edit kriteria --}}
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  ">
            <form action="/pengajuan/edit" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="no_request" class="w-50">NO REQUEST</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="no_request_edit" name="no_request" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="jenis_kriteria " class="w-50">KODE PRODUK</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="kode_produk_edit" name="kode_produk" value="{{ $produkTerpilih['Produk'] }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">HARGA SATUAN</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)"
                                            id="harga_satuan_edit" name="harga_satuan" value="{{ $hargaSatuan }}"
                                            required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="keterangan" class="w-50">JUMLAH </label>
                                    <input type="number" class=" w-100 rounded border-primary fw-bold"
                                        aria-label="Dollar amount (with dot and two decimal places)" id="jumlah_edit"
                                        name="jumlah" required onchange="total_edit()">

                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">DISKON</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="diskon_edit"
                                            onchange="total_edit()" name="diskon" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">PPN</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="ppn_edit"
                                            name="ppn" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">TOTAL AKHIR</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)"
                                            id="total_akhir_edit" name="total_akhir" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-cancel"
                            data-bs-dismiss="modal">Cancel</button>
                        {{-- <button type="submit" class="btn btn-primary" onclick="redirect()">Lanjutkan</button> --}}
                        <button type="submit" id="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @php
        $last = $dbRequest->last();
        // $last = $data->last();
        // dd($last_pr);
    @endphp

    <script>
        //Untuk Tambah Surat Request//
        function tambah() {
            @if ($last == null)

                let urutan = 0;
                var angka = 0;
            @else

                let last_wo = '{{ $last->no_request }}';
                let lastValue = last_wo.substring(last_wo.lastIndexOf('-') + 1);
                let lastValueNumber = parseInt(lastValue);
                let urutan = lastValueNumber;
                var angka = 0;
            @endif



            if (urutan == 0) {
                angka = '00000' + (urutan + 1);
            } else if (urutan < 10) {
                angka = '00000' + (urutan + 1);
            } else if (urutan < 100) {
                angka = '0000' + (urutan + 1);
            } else if (urutan < 1000) {
                angka = '000' + (urutan + 1);
            } else if (urutan < 10000) {
                angka = '00' + (urutan + 1);
            }
            let nomor = angka;
            // document.getElementById("judulWO").innerHTML = wo;
            console.log(nomor);
            document.getElementById("no_request").value = 'REQ-' +
                nomor;

        }


        function jumlah_tambah() {
            let jumlah = document.getElementById("jumlah").value;
            let harga_satuan = document.getElementById("harga_satuan").value;
            let diskon = document.getElementById("diskon").value;
            let jumlahHarga = (jumlah * harga_satuan) - diskon;
            let ppn = jumlahHarga * 0.11;
            document.getElementById("ppn").value = ppn
            document.getElementById("total_akhir").value = jumlahHarga + ppn;
        }
        //Untuk Tambah Surat Request//



        //Untuk Edit Surat Request//


        function edit(kode) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/pengajuan/edit') }}" + "/" + kode,
                success: function(data) {
                    let kodeEdit = document.getElementById('no_request_edit');
                    kodeEdit.value = kode;
                    console.log(data);
                    // let option = document.getElementById('optionCore');
                    $("#kode_produk_edit").val(data.kode_produk);
                    $("#diskon_edit").val(data.diskon);
                    $("#jumlah_edit").val(data.jumlah);
                    $("#total_harga_edit").val(data.total_harga);
                    $("#ppn_edit").val(data.ppn);
                    // console.log($("#ppn_edit"));
                    // console.log(data.ppn);
                    $("#total_akhir_edit").val(data.total_akhir);
                    // console.log($("#total_akhir_edit"));
                    // console.log(data.total_akhir);
                    // option.innerHTML = data.keterangan;
                }
            })

        }

        function total_edit() {
            let jumlah_Edit = document.getElementById("jumlah_edit").value;
            let harga_satuan_Edit = document.getElementById("harga_satuan_edit").value;
            let diskon_Edit = document.getElementById("diskon_edit").value;
            let jumlahHarga_Edit = (jumlah_Edit * harga_satuan_Edit) - diskon_Edit;
            let ppn_Edit = jumlahHarga_Edit * 0.11;
            document.getElementById("ppn_edit").value = ppn_Edit
            document.getElementById("total_akhir_edit").value = jumlahHarga_Edit + ppn_Edit;
        }

        //Untuk Edit Surat Request//

        function deleteRecord(kode) {
            console.log(kode);
            if (confirm('Apakah anda yakin akan menghapus ini?')) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/pengajuan/' + kode, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-Token': csrfToken
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        console.log('Delete request failed.');
                    }
                });
            } else {

            }
        }
    </script>
@endsection
