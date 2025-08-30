<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KaryaIlmiah;
use App\Models\Rumpun;
use App\Models\Prodi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        KaryaIlmiah::factory(20)->create();

        User::create([
            'npm' => '000',
            'name' => 'Admin',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);
        User::create([
            'npm' => '19402108',
            'name' => 'Fadhilla Alfajr',
            'password' => bcrypt('19402108'),
        ]);
        User::create([
            'npm' => '19402041',
            'name' => 'Hadiat Abdul Bashit',
            'password' => bcrypt('19402041'),
        ]);
        User::create([
            'npm' => '19402081',
            'name' => 'Hasan Abdul Latip',
            'password' => bcrypt('19402081'),
        ]);
        User::create([
            'npm' => '19402054',
            'name' => 'Joel Maykha Dias Karyo',
            'password' => bcrypt('19402054'),
        ]);
        User::create([
            'npm' => '19402000',
            'name' => 'Nathania Michelle Meilianto',
            'password' => bcrypt('19402000'),
        ]);
        User::create([
            'npm' => '19402082',
            'name' => 'Nurrahmah Juniar Djazuli',
            'password' => bcrypt('19402082'),
        ]);

        Rumpun::create([
            'nama' => 'IT dan Komputer',
        ]);
        Rumpun::create([
            'nama' => 'Kesehatan',
        ]);
        Rumpun::create([
            'nama' => 'Ekonomi dan Bisnis',
        ]);

        Prodi::create([
            'nama' => 'Administrasi Keuangan (AKE) – D3',
            'rumpun_id' => '3',
        ]);

        Prodi::create([
            'nama' => 'Komputerisasi Akuntansi (KAT) – D4',
            'rumpun_id' => '3',
        ]);

        Prodi::create([
            'nama' => 'Bisnis Digital (BDI) – D4',
            'rumpun_id' => '3',
        ]);

        Prodi::create([
            'nama' => 'Manajemen Informatika (MIF) – D3',
            'rumpun_id' => '1',
        ]);

        Prodi::create([
            'nama' => 'Teknik Komputer (TIK) – D3',
            'rumpun_id' => '1',
        ]);

        Prodi::create([
            'nama' => 'Manajemen Informatika (MIF D.IV) – D4',
            'rumpun_id' => '1',
        ]);

        Prodi::create([
            'nama' => 'Produksi Media (PME) – D4',
            'rumpun_id' => '1',
        ]);

        Prodi::create([
            'nama' => 'Analis Kesehatan (AKS) – D3',
            'rumpun_id' => '2',
        ]);

        Prodi::create([
            'nama' => 'Farmasi (FAR) – D3',
            'rumpun_id' => '2',
        ]);

        Prodi::create([
            'nama' => 'Fisioterapi (FIS) – D3',
            'rumpun_id' => '2',
        ]);

        Prodi::create([
            'nama' => 'Manajemen Pelayanan Rumah Sakit (MPRS) – D3',
            'rumpun_id' => '2',
        ]);

        Prodi::create([
            'nama' => 'Rekam Medis dan Informasi Kesehatan (RMIK) – D3',
            'rumpun_id' => '2',
        ]);

        Prodi::create([
            'nama' => 'Manajemen Informasi Kesehatan (MIK) – D4',
            'rumpun_id' => '2',
        ]);
    }
}
