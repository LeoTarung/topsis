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
        <div class="container-fluid mt-3 border-bottom">
            <div class="row ms-3 ">
                <div class="col-6 text-center " onclick="menu(1)">
                    <h5>Daftar Data Alternatif</h5>
                </div>
                <div class="col-6 border-left text-center " onclick="menu(2)">
                    <h5>Penilaian</h5>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100" id="dataAlternatif">
                <div class="card-header bg-secondary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Daftar Data Alternatif
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Alternatif</th>
                                <th scope="col">Nama</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data as $a)
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td>{{ $a->kode_alternatif }}</td>
                                    <td>{{ $a->nama }}</td>
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
        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm  w-100" id="penilaianAlternatif">
                <div class="card-header bg-secondary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Penilaian Alternatif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table m-2 ">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">Nama</th>
                                    @for ($k = 0; $k < $kriteriaCount; $k++)
                                        <th scope="col">{{ $kriteria[$k] }}</th>
                                    @endfor
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($a = 0; $a < $alternatifCount; $a++)
                                    <tr>
                                        <td>{{ $alternatif[$a] }}</td>


                                        @if ($penilaian->where('kode_alternatif', $alternatifKode[$a])->first() != null)
                                            @foreach ($penilaian->where('kode_alternatif', $alternatifKode[$a]) as $p)
                                                <td>{{ $p->nilai }}</td>
                                                {{-- @endfor --}}
                                            @endforeach
                                            <td><button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editPenilaian"
                                                    onclick="editPenilaian('{{ $alternatifKode[$a] }}')">Edit</button></td>
                                        @else
                                            @for ($b = 1; $b <= $kriteriaCount; $b++)
                                                <td></td>
                                            @endfor
                                            <td> <button class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#tambahPenilaian"
                                                    onclick="tambahPenilaian('{{ $alternatifKode[$a] }}')">Input</button>
                                            </td>
                                        @endif
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
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
                                    <label for="nama " class="w-100">NAMA</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="nama"
                                        name="nama" required>
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
                                    <label for="nama " class="w-100">NAMA</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="nama_edit"
                                        name="nama" required>
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

    {{-- Modal Edit Penilaian --}}
    <div class="modal fade" id="editPenilaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  ">
            <form action="/penilaian/Edit" id="formEdit" method="POST"
                onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="kode_alternatif" class="w-50">KODE ALTERNATIF</label>
                                <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                    id="kode_alternatif_edit_penilaian" name="kode_alternatif_edit_penilaian" required
                                    readonly>
                            </div>
                            @for ($k = 0; $k < $kriteriaCount; $k++)
                                <div class="col-12 mb-3">
                                    <div class="form-floating">
                                        <label for="{{ $kriteria[$k] }}" class="w-50">{{ $kriteria[$k] }}</label>
                                        {{-- <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                            aria-label="Floating label select example" id="{{ $kriteria[$k] }}"
                                            name="kriteriaEdit{{ $k + 1 }}">
                                            <option selected id="option{{ $k }}"></option> --}}
                                        {{-- @foreach ($subKriteria->where('cat_kriteria', 'C' . ($k + 1)) as $key)
                                                <option value="{{ $key->range }}">{{ $key->range }}</option>
                                            @endforeach --}}
                                        {{-- </select> --}}
                                        <input type="number" class="w-100 w-100   rounded border-primary fw-bold"
                                            id="kriteriaEdit{{ $k }}" name="kriteriaEdit{{ $k + 1 }}"
                                            required>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" id="btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            {{-- <button type="submit" class="btn btn-primary" onclick="redirect()">Lanjutkan</button> --}}
                            <button type="submit" id="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal tambah kriteria --}}
    <div class="modal fade" id="tambahPenilaian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  ">
            <form action="/penilaian/tambah" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data</h5>
                        <button type="button" class="btn-danger rounded btn-close" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="kode_alternatif" class="w-50">KODE ALTERNATIF</label>
                                <input type="text" class="w-100 w-100   rounded border-primary fw-bold"
                                    id="kode_alternatif_penilaian" name="kode_alternatif_penilaian" required readonly>
                            </div>
                            @for ($k = 0; $k < $kriteriaCount; $k++)
                                <div class="col-12 mb-3">
                                    <div class="form-floating">
                                        <label for="{{ $kriteria[$k] }}" class="w-50">{{ $kriteria[$k] }}</label>
                                        {{-- <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                            id="floatingSelect" aria-label="Floating label select example"
                                            id="{{ $kriteria[$k] }}" name="kriteria{{ $k + 1 }}">
                                            <option selected>-- Pilih --</option> --}}
                                        {{-- @foreach ($subKriteria->where('cat_kriteria', 'C' . ($k + 1)) as $key)
                                                <option value="{{ $key->range }}">{{ $key->range }}</option>
                                            @endforeach --}}
                                        {{-- </select> --}}
                                        <input type="number" class="w-100 w-100   rounded border-primary fw-bold"
                                            id="{{ $kriteria[$k] }}" name="kriteria{{ $k + 1 }}" required>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" id="btn-cancel">Reset</button>
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
            let count = {{ $alternatifCount }};
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
                    $("#nama_edit").val((data.nama));
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

        let carddataAlternatif = document.getElementById('dataAlternatif');
        let cardpenilaianAlternatif = document.getElementById('penilaianAlternatif');

        carddataAlternatif.hidden = false;
        cardpenilaianAlternatif.hidden = true;
        console.log(carddataAlternatif)
        console.log(cardpenilaianAlternatif)

        function menu(id) {
            if (id == 1) {
                console.log('1');
                carddataAlternatif.hidden = false;
                cardpenilaianAlternatif.hidden = true;
            } else if (id == 2) {
                console.log('2');
                carddataAlternatif.hidden = true;
                cardpenilaianAlternatif.hidden = false;
            }
        }

        //Penilaian
        function tambahPenilaian(id) {
            let kode = document.getElementById('kode_alternatif_penilaian');
            kode.value = id;
            // console.log(id);
        }

        function editPenilaian(alternatif) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/penilaian/edit') }}" + "/" + alternatif,
                success: function(data) {
                    let kodeEdit = document.getElementById('kode_alternatif_edit_penilaian');
                    kodeEdit.value = alternatif;
                    // console.log(data);
                    for (let index = 0; index < {{ $kriteriaCount }}; index++) {
                        document.getElementById('kriteriaEdit' + index).value = data[index];

                        // $('kriteriaEdit' + index).val(data[index]);
                        // console.log($('kriteriaEdit' + index).val);
                        // option.innerHTML = data[index];
                    }
                }
            })
        }
    </script>
@endsection
