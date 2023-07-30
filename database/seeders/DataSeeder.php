<?php

namespace Database\Seeders;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\subKriteriaModel;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'jenis_kriteria' => 'Jumlah Absensi',
                'bobot' => 0.3,
                'keterangan' => 'BENEFIT',
            ],
            [
                'kode_kriteria' => 'C2',
                'jenis_kriteria' => 'Sertifikat',
                'bobot' => 0.1,
                'keterangan' => 'BENEFIT',
            ],
            [
                'kode_kriteria' => 'C3',
                'jenis_kriteria' => 'Masa Lama Kerja',
                'bobot' => 0.1,
                'keterangan' => 'BENEFIT',
            ],
            [
                'kode_kriteria' => 'C4',
                'jenis_kriteria' => 'Kualitas Mengajar',
                'bobot' => 0.3,
                'keterangan' => 'BENEFIT',
            ],
            [
                'kode_kriteria' => 'C5',
                'jenis_kriteria' => 'Pendidikan',
                'bobot' => 0.2,
                'keterangan' => 'BENEFIT',
            ]

        ];

        $alternatif = [
            [
                'kode_alternatif' => 'A1',
                'nama_vendor' => 'ALI, S.Pd',

            ],
            [
                'kode_alternatif' => 'A2',
                'nama_vendor' => 'FAUJI, S.Pd.I',

            ],
            [
                'kode_alternatif' => 'A3',
                'nama_vendor' => 'MAISAROH, S.Pd',

            ],
            [
                'kode_alternatif' => 'A4',
                'nama_vendor' => 'SARIPAH, M.S.Pd',

            ],
            [
                'kode_alternatif' => 'A5',
                'nama_vendor' => 'FITRIA SARI, S.Pd',

            ],
            [
                'kode_alternatif' => 'A6',
                'nama_vendor' => 'HERMAWAN, S.Pd',

            ],
            [
                'kode_alternatif' => 'A7',
                'nama_vendor' => 'ROMLAH, S.Pd',

            ],
            [
                'kode_alternatif' => 'A8',
                'nama_vendor' => 'HAROPIH, S.Pd',

            ],
            [
                'kode_alternatif' => 'A9',
                'nama_vendor' => 'AMRUN, S.Pd',

            ],
            [
                'kode_alternatif' => 'A10',
                'nama_vendor' => 'UUN PUNITA, S.Pd',

            ],
        ];

        $subKriteria = [
            [
                'id' => 1,
                'cat_kriteria' => 'C1',
                'nilai' => 1,
                'keterangan' => '>10'
            ],
            [
                'id' => 2,
                'cat_kriteria' => 'C1',
                'nilai' => 2,
                'keterangan' => '6-9'
            ],
            [
                'id' => 3,
                'cat_kriteria' => 'C1',
                'nilai' => 3,
                'keterangan' => '4-5'
            ],
            [
                'id' => 4,
                'cat_kriteria' => 'C1',
                'nilai' => 4,
                'keterangan' => '2-3'
            ],
            [
                'id' => 5,
                'cat_kriteria' => 'C1',
                'nilai' => 5,
                'keterangan' => '<1'
            ],
            [
                'id' => 6,
                'cat_kriteria' => 'C2',
                'nilai' => 3,
                'keterangan' => 'Sudah Ada'
            ],
            [
                'id' => 7,
                'cat_kriteria' => 'C2',
                'nilai' => 1,
                'keterangan' => 'Belum Ada'
            ],
            [
                'id' => 8,
                'cat_kriteria' => 'C3',
                'nilai' => 5,
                'keterangan' => '30 Tahun'
            ],
            [
                'id' => 9,
                'cat_kriteria' => 'C3',
                'nilai' => 4,
                'keterangan' => '25 - 29 Tahun'
            ],
            [
                'id' => 10,
                'cat_kriteria' => 'C3',
                'nilai' => 3,
                'keterangan' => '20 - 24 Tahun'
            ],
            [
                'id' => 11,
                'cat_kriteria' => 'C3',
                'nilai' => 2,
                'keterangan' => '15 - 19 Tahun'
            ],
            [
                'id' => 12,
                'cat_kriteria' => 'C3',
                'nilai' => 1,
                'keterangan' => '< 14 Tahun'
            ],
            [
                'id' => 13,
                'cat_kriteria' => 'C4',
                'nilai' => 1,
                'keterangan' => 'Cukup Bagus'
            ],
            [
                'id' => 14,
                'cat_kriteria' => 'C4',
                'nilai' => 2,
                'keterangan' => 'Bagus'
            ],
            [
                'id' => 15,
                'cat_kriteria' => 'C4',
                'nilai' => 3,
                'keterangan' => 'Sangat Bagus'
            ],
            [
                'id' => 16,
                'cat_kriteria' => 'C5',
                'nilai' => 5,
                'keterangan' => 'Magister dan Doktor'
            ],
            [
                'id' => 17,
                'cat_kriteria' => 'C5',
                'nilai' => 4,
                'keterangan' => 'Sarjana'
            ],
            [
                'id' => 18,
                'cat_kriteria' => 'C5',
                'nilai' => 3,
                'keterangan' => 'Diploma'
            ],
            [
                'id' => 19,
                'cat_kriteria' => 'C5',
                'nilai' => 2,
                'keterangan' => 'SMA'
            ],
        ];

        KriteriaModel::insert($kriteria);
        AlternatifModel::insert($alternatif);
        subKriteriaModel::insert($subKriteria);
    }
}
