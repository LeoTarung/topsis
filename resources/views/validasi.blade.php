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
                    <h2 class=" d-flex justify-content-start">Data Validasi</h4>
                </div>
                <div class="col-6 d-flex  justify-content-end h-50">
                    {{-- <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#tambah" onclick="tambah()"><i
                            class="fa fa-plus"></i> Tambah Data</h4> --}}
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center mt-3">
            <div class="card shadow-sm w-100">
                <div class="card-header bg-secondary" style="color:wheat">
                    {{-- <i class="fa fa-paperclip"></i></i> Daftar Data Kriteria --}}
                </div>
                <div class="table-responsive">

                    <table class="table m-3 table-bordered ">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">No Surat</th>
                                <th scope="col" class="text-center">Tanggal</th>
                                <th scope="col" class="text-center">Validasi</th>
                                <th scope="col" class="text-center">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                                // dd($dbRequest->first());
                            @endphp
                            @foreach ($dbRequest as $key)
                                <tr>
                                    <td scope="col" class="text-center">{{ $no }}</td>
                                    <td scope="col" class="text-center">{{ $key->no_request }}</td>
                                    <td class="text-center">
                                        {{ optional(Carbon\Carbon::parse($key->created_at))->format('d-m-Y') }}</td>
                                    @if ($key->validasi == null)
                                        <td class="text-center"><button class="btn btn-info"
                                                onclick="accept('{{ $key->no_request }}')">Accept</button>
                                            <button class="btn btn-danger"
                                                onclick="notes('{{ $key->no_request }}')">Decline</button>
                                        </td>
                                    @else
                                        <td class="table-success"><i class="nav-icon fas fa-check"></i> Tanggal Validasi:
                                            {{ optional(Carbon\Carbon::parse($key->validasi))->format('d-m-Y') }}
                                        </td>
                                    @endif

                                    <td class="text-center">{{ $key->notes }}</td>
                                    @php
                                        $no = $no + 1;
                                        // dd($key->no_request);
                                    @endphp
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $dbRequest->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Decline --}}
    <div class="modal fade" id="ModalDecline" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-6" id="ModalDeclineLabel"></h1>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <div id="page" class="p-2">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function accept(kode) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan memvalidasi sekarang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Validasi'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Berhasil!',
                        'Surat Pengajuan sudah berhasil divalidasi',
                        'success'
                    )

                    // Uplod Status to Database
                    $.ajax({
                        url: "/validate/pengajuan" + "/" + kode,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            console.log(
                                response); // handle the response from the server
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // handle any errors that occur
                        }
                    });
                }
            })
        }

        function modalDecline(kode) {
            $.get(
                "/partial/modal/decline" + "/" + kode, {},
                function(data) {
                    $("#ModalDeclineLabel").html("Notes"); //Untuk kasih judul di modal
                    $("#ModalDecline").modal("show"); //kalo ID pake "#" kalo class pake "."
                    $('#ModalDecline .modal-body').load("/partial/modal/decline" + "/" + kode);
                }
            );
        }

        // Sweet Alert Decline
        function notes(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menolak untuk validasi sekarang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Decline'
            }).then((result) => {
                if (result.isConfirmed) {
                    modalDecline(id)
                }
            })
        }
    </script>
@endsection
