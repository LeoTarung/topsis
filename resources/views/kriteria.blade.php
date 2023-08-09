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
                    <h2 class=" d-flex justify-content-start">Data Kriteria</h4>
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
                    <i class="fa fa-paperclip"></i></i> Daftar Data Kriteria
                </div>
                <div class="table-responsive">

                    <table class="table m-3 ">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Kriteria</th>
                                <th scope="col">Nama Kriteria</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($kriteria as $k)
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>{{ $k->kode_kriteria }}</td>
                                    <td>{{ $k->jenis_kriteria }}</td>
                                    <td>{{ $k->bobot }}</td>
                                    <td>{{ $k->keterangan }}</td>
                                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit"
                                            onclick="edit('{{ $k->kode_kriteria }}')">Edit</button>
                                        <button class="btn btn-danger"
                                            onclick="deleteRecord('{{ $k->kode_kriteria }}')">Hapus</button>
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
            <form action="/kriteria/tambah" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
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
                                    <label for="kode_kriteria" class="w-50">KODE KRITERIA</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="kode_kriteria" name="kode_kriteria" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="jenis_kriteria " class="w-50">NAMA KRITERIA</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="jenis_kriteria" name="jenis_kriteria" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">BOBOT</label>
                                        <input type="number" class=" w-100 rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="bobot"
                                            name="bobot" required>
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="keterangan" class="w-50">KETERANGAN</label>
                                    <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                        id="floatingSelect" aria-label="Floating label select example" id="keterangan"
                                        name="keterangan" required>
                                        <option selected> </option>
                                        <option value="benefit">BENEFIT</option>
                                        <option value="cost">COST</option>
                                    </select>
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
        <div class="modal-dialog modal-md  ">
            <form action="/kriteria/edit" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
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
                                    <label for="kode_kriteria" class="w-50">KODE KRITERIA</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="kode_kriteria_edit" name="kode_kriteria" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="jenis_kriteria " class="w-50">NAMA KRITERIA</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="jenis_kriteria_edit" name="jenis_kriteria" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <div class="input-group">
                                        <label for="bobot " class="w-50">BOBOT</label>
                                        <input type="number" class=" w-100  rounded border-primary fw-bold"
                                            aria-label="Dollar amount (with dot and two decimal places)" id="bobot_edit"
                                            name="bobot">
                                        {{-- <span class="W-25  rounded border-primary input-group-text">%</span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="keterangan" class="w-50">KETERANGAN</label>
                                    <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                        id="floatingSelect" aria-label="Floating label select example"
                                        id="keterangan_edit" name="keterangan">
                                        <option selected id="optionCore"> </option>
                                        <option value="benefit">BENEFIT</option>
                                        <option value="cost">COST</option>
                                    </select>
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
            let count = {{ $kriteria->count() }};
            // console.log(count);
            let id = document.getElementById('kode_kriteria');
            let x = "C" + (count + 1);
            console.log(x);
            id.value = x;
        }

        function edit(kode) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/kriteria/edit') }}" + "/" + kode,
                success: function(data) {
                    let kodeEdit = document.getElementById('kode_kriteria_edit');
                    kodeEdit.value = kode;
                    console.log(data);
                    let option = document.getElementById('optionCore');
                    $("#jenis_kriteria_edit").val(data.jenis_kriteria);
                    // document.getElementById('jenis_kriteria_edit').value = data[0].jenis_kriteria;
                    $("#bobot_edit").val((data.bobot));
                    option.innerHTML = data.keterangan;
                }
            })
        }

        function deleteRecord(kode) {
            console.log(kode);
            if (confirm('Apakah anda yakin akan menghapus ini?')) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/kriteria/' + kode, {
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
