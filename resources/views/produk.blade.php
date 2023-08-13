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
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-6">
                    <h2 class=" d-flex justify-content-start">Data Produk</h4>
                </div>
                <div class="col-6 d-flex  justify-content-end h-50">
                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tambah"><i
                            class="fa fa-plus"></i> Tambah Data</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-secondary" style="color:wheat">
                    <i class="fa fa-paperclip"></i></i> Daftar Data Produk
                </div>
                <div class="table-responsive">

                    <table class="table m-3 ">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Harga</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($produk as $p)
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>{{ $p->kode_produk }}</td>
                                    <td>{{ $p->nama_vendor }}</td>
                                    <td>{{ $p->nama_produk }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->kota }}</td>
                                    <td>{{ $p->harga }}</td>
                                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit"
                                            onclick="edit('{{ $p->kode_produk }}')">Edit</button>
                                        <button class="btn btn-danger"
                                            onclick="deleteRecord('{{ $p->kode_produk }}')">Hapus</button>
                                    </td>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah produk --}}
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <form action="/produk/tambah" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="kode_produk" class="w-50">KODE PRODUK</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="kode_produk" name="kode_produk" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nama_supplier " class="w-50">NAMA SUPPLIER</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="nama_supplier" name="nama_supplier" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nama_produk " class="w-50">NAMA PRODUK</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="nama_produk"
                                        name="nama_produk" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="alamat " class="w-50">Alamat</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="alamat"
                                        name="alamat" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="kota " class="w-50">Kota</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="kota"
                                        name="kota" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="harga " class="w-50">Harga</label>
                                    <input type="number" class=" w-100    rounded border-primary fw-bold" id="harga"
                                        name="harga" required>
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

    {{-- Modal Edit produk --}}
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <form action="/produk/edit/" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="kode_produk" class="w-50">KODE PRODUK</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="kode_produk_edit" name="kode_produk_edit" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nama_supplier " class="w-50">NAMA SUPPLIER</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="nama_supplier_edit" name="nama_supplier_edit" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nama_produk " class="w-50">NAMA PRODUK</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="nama_produk_edit" name="nama_produk_edit" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="alamat " class="w-50">Alamat</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="alamat_edit" name="alamat_edit" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="kota " class="w-50">Kota</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="kota_edit"
                                        name="kota_edit" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="harga_edit" class="w-50">Harga</label>
                                    <input type="number" class=" w-100    rounded border-primary fw-bold"
                                        id="harga_edit" name="harga_edit" required>
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


    <script>
        // function tambah() {
        //     //buat nambah otomatis id nya
        //     let count = {{ $produk->count() }};
        //     // console.log(count);
        //     let id = document.getElementById('kode_produk');
        //     let x = "C" + (count + 1);
        //     console.log(x);
        //     id.value = x;
        // }

        function edit(kode) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/produk/edit') }}" + "/" + kode,
                success: function(data) {
                    let kodeEdit = document.getElementById('kode_produk_edit');
                    kodeEdit.value = kode;
                    console.log(data);
                    $("#nama_supplier_edit").val(data.nama_vendor);
                    $("#nama_produk_edit").val(data.nama_produk);
                    $("#alamat_edit").val(data.alamat);
                    $("#kota_edit").val(data.kota);
                    $("#harga_edit").val(data.harga);
                    // document.getElementById('jenis_produk_edit').value = data[0].jenis_produk;

                }
            })
        }

        function deleteRecord(kode) {
            console.log(kode);
            if (confirm('Apakah anda yakin akan menghapus ini?')) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/produk/' + kode, {
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
