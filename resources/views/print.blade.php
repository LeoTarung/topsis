<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>print</title>
    {{-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    {{-- <div class="wrapper d-flex align-items-stretch"> --}}
    {{-- <div id="content" class="p-4 p-md-5 pt-5"> --}}
    <div class="container-fluid ">
        <div class="row">
            <div class="col-6">
                <h2 class=" d-flex justify-content-start">Hasil Akhir Perhitungan</h4>
            </div>

        </div>
        {{-- <div class="table-responsive"> --}}
        <div class="container-xl"style="margin-right: 20px">

            <table class="table" style="margin-right: 5px">
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
                            <td>{{ $key['nilai_qi'] }}</td>
                        </tr>
                        <?php $no++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- </div> --}}
    </div>
    {{-- </div> --}}
    {{-- </div> --}}
</body>

</html>
