@extends('main')
@section('container')
    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <div class="container-fluid border-bottom">
            <div class="row">
                <div class="col-12">
                    <h2 class=" d-flex justify-content-start">Data Sub Kriteria</h4>
                </div>
            </div>
        </div>
        @for ($i = 0; $i < $dataCount; $i++)
            <div class="container-fluid d-flex justify-content-center mt-3">
                {{-- <div class="col-10"> --}}
                <div class="card shadow-sm w-100 m-2">
                    <div class="card-header bg-primary" style="color:wheat">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa fa-folder"></i> <span style="font-size: 20px;">Data Kriteria
                                    {{ $jenisKriteria[$i] }}</span>

                            </div>
                            <div class="col-6  d-flex  justify-content-end"> <button class=" btn btn-success"
                                    data-bs-toggle="modal" data-bs-target="#tambah{{ $i + 1 }} "
                                    onclick="tambah({{ $i + 1 }})"><i class="fa fa-plus"></i> <span
                                        style="font-size: 12px; ">Tambah
                                        Data</span></button></div>
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table m-2 ">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col" class="text-center">Range</th>
                                    <th scope="col" class="text-center">Kategori</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col"> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach (${'sub' . ($i + 1)} as $key)
                                    <tr>
                                        <td scope="col"><?= $no ?></td>
                                        <td scope="col" class="text-center">{{ $key->range }}</td>
                                        <td scope="col" class="text-center">{{ $key->kategori }}</td>
                                        <td scope="col">{{ $key->nilai }}</td>
                                        <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit"
                                                onclick="edit('{{ $key->id }}')">Edit</button>
                                            <button class="btn btn-danger"
                                                onclick="deleteRecord({{ $key->id }})">Hapus</button>
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
        @endfor
    </div>

    {{-- Modal Tambah kriteria --}}
    @for ($i = 0; $i < $dataCount; $i++)
        <div class="modal fade" id="tambah{{ $i + 1 }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md  ">
                <form action="/subKriteria/tambah/{{ $i + 1 }}" method="POST"
                    onSubmit="document.getElementById('submit').disabled=true;">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data {{ $jenisKriteria[$i] }}</h5>
                            <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                                aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <label for="range" class="w-100">Range</label>
                                        <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                            id="range" name="range" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <label for="kategori" class="w-100">Kategori</label>
                                        <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                            id="kategori" name="kategori" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <label for="nilai " class="w-100">NILAI</label>
                                        <input type="number" class=" w-100    rounded border-primary fw-bold"
                                            id="nilai" name="nilai" required>
                                    </div>

                                    <div class="form-floating" hidden>
                                        <input type="text" class=" w-100 rounded border-primary fw-bold"
                                            id="cat_kriteria{{ $i + 1 }}" name="cat_kriteria{{ $i + 1 }}"
                                            required>
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
    @endfor

    {{-- Modal edit kriteria --}}

    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  ">
            <form action="/subKriteria/update/" method="POST"
                onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Edit Data
                        </h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="keterangan" class="w-100">NAMA SUB KRITERIA</label>
                                    <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                        id="keterangan_edit" name="keterangan" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="nilai " class="w-100">NILAI</label>
                                    <input type="number" class=" w-100    rounded border-primary fw-bold"
                                        id="nilai_edit" name="nilai" required>
                                </div>

                                <div class="form-floating" hidden>
                                    <input type="number" class=" w-100 rounded border-primary fw-bold" id="id"
                                        name="id" required>
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
        function tambah(id) {
            for (let i = 1; i <= {{ $dataCount }}; i++) {
                if (id == i) {
                    let criteria = document.getElementById('cat_kriteria' + i);

                    criteria.value = 'C' + i;
                    // console.log(criteria.value);
                }
            }
        }

        function edit(id) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/subKriteria/edit') }}" + "/" + id,
                success: function(data) {
                    // let kodeEdit = document.getElementById('kode_alternatif_edit');
                    // kodeEdit.value = kode;
                    console.log(data);
                    $("#keterangan_edit").val((data.keterangan));
                    $("#nilai_edit").val((data.nilai));
                    $("#id").val((data.id));
                }
            })
        }

        function deleteRecord(id) {
            console.log(id);
            if (confirm('Apakah anda yakin akan menghapus ini?')) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/subKriteria/' + id, {
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
