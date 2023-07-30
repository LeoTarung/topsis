@extends('main')
@section('container')
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-6">
                    <h2 class=" d-flex justify-content-start">Data Alternatif</h4>
                </div>
                <div class="col-6 d-flex  justify-content-end h-50">
                    <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tambah" onclick="tambah()"><i
                            class="fa fa-plus"></i> Tambah Data</h4>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Daftar Data Alternatif
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Alternatif</th>
                                <th scope="col">Nama Vendor</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($alternatif as $a)
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td>{{ $a->kode_alternatif }}</td>
                                    <td>{{ $a->nama_vendor }}</td>
                                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit"
                                            onclick="edit('{{ $a->kode_alternatif }}')">Edit</button>
                                        <button class="btn btn-danger"
                                            onclick="deleteRecord('{{ $a->kode_alternatif }}')">Hapus</button>
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

    {{-- Modal Tambah kriteria --}}
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  ">
            <form action="/alternatif/tambah" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
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
                                    <label for="kode_alternatif" class="w-100">KODE ALTERNATIF</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="kode_alternatif" name="kode_alternatif" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nama_vendor " class="w-100">NAMA VENDOR</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="nama_vendor"
                                        name="nama_vendor" required>
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

    {{-- Modal edit kriteria --}}
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  ">
            <form action="/alternatif/edit" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
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
                                    <label for="kode_alternatif" class="w-100">KODE ALTERNATIF</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="kode_alternatif_edit" name="kode_alternatif" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nama_vendor " class="w-100">NAMA VENDOR</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="nama_vendor_edit" name="nama_vendor" required>
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
        function tambah() {
            //buat nambah otomatis id nya
            let count = {{ $alternatif->count() }};
            // console.log(count);
            let id = document.getElementById('kode_alternatif');
            let x = "A" + (count + 1);
            console.log(x);
            id.value = x;
        }


        function edit(kode) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/alternatif/edit') }}" + "/" + kode,
                success: function(data) {
                    let kodeEdit = document.getElementById('kode_alternatif_edit');
                    kodeEdit.value = kode;
                    console.log(data);
                    $("#nama_vendor_edit").val((data.nama_vendor));
                }
            })
        }

        function deleteRecord(kode) {
            console.log(kode);
            if (confirm('Apakah anda yakin akan menghapus ini?')) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/alternatif/' + kode, {
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
