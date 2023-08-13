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
                    <h2 class=" d-flex justify-content-start">Data User</h4>
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
                    <i class="fa fa-paperclip"></i></i> Daftar Data User
                </div>
                <div class="table-responsive">

                    <table class="table m-3 ">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama User</th>
                                <th scope="col">Email User</th>
                                <th scope="col">Role</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($user as $k)
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>{{ $k->name }}</td>
                                    <td>{{ $k->email }}</td>
                                    <td>{{ $k->role }}</td>
                                    <td><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit"
                                            onclick="edit('{{ $k->id }}')">Edit</button>
                                        <button class="btn btn-danger"
                                            onclick="deleteRecord('{{ $k->id }}')">Hapus</button>
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

    {{-- Modal Tambah user --}}
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  ">
            <form action="/user/tambah" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
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
                                    <label for="nama_user " class="w-50">NAMA USER</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold" id="nama_user"
                                        name="nama_user" required>

                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="email_user " class="w-50">EMAIL USER</label>
                                    <input type="email" class=" w-100    rounded border-primary fw-bold" id="email_user"
                                        name="email_user" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="role_user" class="w-50">ROLE USER</label>
                                    <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                        id="floatingSelect" aria-label="Floating label select example" id="role_user"
                                        name="role_user">
                                        <option selected> </option>
                                        <option value="SPARE PART">SPARE PART</option>
                                        <option value="SERVICE MANAGER">SERVICE MANAGER</option>
                                        <option value="HEAD OFFICE">HEAD OFFICE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="password_user " class="w-50">PASSWORD</label>
                                    <input type="password" class=" w-100    rounded border-primary fw-bold"
                                        id="password_user" name="password_user" required>
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

    {{-- Modal Edit user --}}
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md  ">
            <form action="/user/edit" method="POST" onSubmit="document.getElementById('submit').disabled=true;">
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
                                    <label for="nama_user " class="w-50">NAMA USER</label>
                                    <input type="text" class=" w-100    rounded border-primary fw-bold"
                                        id="nama_user_edit" name="nama_user_edit" required>
                                    <input type="number" class=" w-100 rounded border-primary fw-bold" id="id_user"
                                        name="id_user" required hidden>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="email_user " class="w-50">EMAIL USER</label>
                                    <input type="email" class=" w-100    rounded border-primary fw-bold"
                                        id="email_user_edit" name="email_user_edit" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="role_user" class="w-50">ROLE USER</label>
                                    <select class="form-select w-100  rounded border-primary fw-bold w-75"
                                        aria-label="Floating label select example" id="role_user_edit"
                                        name="role_user_edit">
                                        <option selected id="optionCore"> </option>
                                        <option value="SPARE PART">SPARE PART</option>
                                        <option value="SERVICE MANAGER">SERVICE MANAGER</option>
                                        <option value="HEAD OFFICE">HEAD OFFICE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-3">
                                <div class="form-floating">
                                    <label for="password_user " class="w-50">PASSWORD</label>
                                    <input type="password" class=" w-100    rounded border-primary fw-bold"
                                        id="password_user_edit" name="password_user_edit" required>
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
        function edit(kode) {
            $.ajax({
                method: "GET",
                dataType: "json",
                url: "{{ url('/user/edit') }}" + "/" + kode,
                success: function(data) {
                    console.log(data);
                    let option = document.getElementById("optionCore");
                    $("#id_user").val(data.id);
                    $("#nama_user_edit").val(data.name);
                    $("#email_user_edit").val(data.email);
                    $("#password_user_edit").val(data.password);
                    // document.getElementById('jenis_user_edit').value = data[0].jenis_user;
                    // $("#bobot_edit").val((data.bobot));
                    option.innerHTML = data.role;
                    option.value = data.role;
                }
            })
        }

        function deleteRecord(kode) {
            console.log(kode);
            if (confirm('Apakah anda yakin akan menghapus ini?')) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/user/' + kode, {
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
