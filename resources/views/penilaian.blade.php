@extends('main')
@section('container')
    <!-- Page Content  -->
 

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-primary" style="color:wheat">
                    <i class="fa fa-users"></i></i> Data Penilaian
                </div>
                <div class="table-responsive">

                    <table class="table m-2 ">
                        <thead class="table-primary">
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
                                        <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit"
                                                onclick="edit('{{ $alternatifKode[$a] }}')">Edit</button></td>
                                    @else
                                        @for ($b = 1; $b <= $kriteriaCount; $b++)
                                            <td></td>
                                        @endfor
                                        <td> <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah"
                                                onclick="tambah('{{ $alternatifKode[$a] }}')">Input</button></td>
                                    @endif
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit kriteria --}}
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                                    id="kode_alternatif_edit" name="kode_alternatif_edit" required readonly>
                            </div>
                            @for ($k = 0; $k < $kriteriaCount; $k++)
                                <div class="col-12 mb-3">
                                    <div class="form-floating">
                                        <label for="{{ $kriteria[$k] }}" class="w-50">{{ $kriteria[$k] }}</label>
                                        <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                            aria-label="Floating label select example" id="{{ $kriteria[$k] }}"
                                            name="kriteriaEdit{{ $k + 1 }}">
                                            <option selected id="option{{ $k }}"></option>
                                            @foreach ($subKriteria->where('cat_kriteria', 'C' . ($k + 1)) as $key)
                                                <option value="{{ $key->keterangan }}">{{ $key->keterangan }}</option>
                                            @endforeach
                                        </select>
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
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                                    id="kode_alternatif" name="kode_alternatif" required readonly>
                            </div>
                            @for ($k = 0; $k < $kriteriaCount; $k++)
                                <div class="col-12 mb-3">
                                    <div class="form-floating">
                                        <label for="{{ $kriteria[$k] }}" class="w-50">{{ $kriteria[$k] }}</label>
                                        <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                            id="floatingSelect" aria-label="Floating label select example"
                                            id="{{ $kriteria[$k] }}" name="kriteria{{ $k + 1 }}">
                                            <option selected>-- Pilih --</option>
                                            @foreach ($subKriteria->where('cat_kriteria', 'C' . ($k + 1)) as $key)
                                                <option value="{{ $key->keterangan }}">
                                                    {{ $key->keterangan }}</option>
                                            @endforeach
                                        </select>
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
        function tambah(id) {
            let kode = document.getElementById('kode_alternatif');
            kode.value = id;
            // console.log(id);
        }

        function edit(alternatif) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/penilaian/edit') }}" + "/" + alternatif,
                success: function(data) {
                    let kodeEdit = document.getElementById('kode_alternatif_edit');
                    kodeEdit.value = alternatif;
                    // console.log(data);
                    for (let index = 0; index < {{ $kriteriaCount }}; index++) {
                        let option = document.getElementById('option' + index);
                        $("#option" + index).val(data[index]);
                        option.innerHTML = data[index];
                    }
                }
            })
        }
    </script>
@endsection
