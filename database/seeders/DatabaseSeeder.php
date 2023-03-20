<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Satuan;
use App\Models\BarangPedagang;
use App\Models\Barang;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Data user --------------------------------------------------------------------------------
        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'image' => '',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jalan Telekomunikasi No.1 Bandung, Jawa Barat',
            'telp' => '082216805580',
            'link_toko' => 'https://shopee.co.id/tokyofoamofficial?categoryId=100636&entryPoint=ShopByPDP&itemId=19324889541&upstream=dd',
            'is_active' => 1,
            'is_admin' => 1,
        ]);

        User::create([
            'nama' => 'Toko Berkah',
            'username' => 'tokoberkah',
            'image' => '',
            'email' => 'tokoberkah@gmail.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jalan Berkah No.G7 Rt.01 Rw.02 Kec.Bandung Kab.Bandung',
            'telp' => '082216805580',
            'link_toko' => 'https://shopee.co.id/topi_pabrik?categoryId=100009&entryPoint=ShopByPDP&itemId=5796161138&upstream=dd',
            'is_active' => 1,
            'is_admin' => 0,
        ]);

        User::create([
            'nama' => 'Toko Saudara',
            'username' => 'tokosaudara',
            'image' => '',
            'email' => 'tokosaudara@gmail.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jalan Saudara No.G2 Rt.01 Rw.02 Kec.Bandung Kab.Bandung',
            'telp' => '082216805580',
            'link_toko' => 'https://shopee.co.id/galeri_sendalsepatu?categoryId=100532&entryPoint=ShopByPDP&itemId=13970146091&upstream=dd',
            'is_active' => 1,
            'is_admin' => 0,
        ]);

        // Data kategori ---------------------------------------------------------------------------
        Kategori::create([
            'nama_kategori' => 'Buah-buahan',
            'slug' => 'buah-buahan'
        ]);

        Kategori::create([
            'nama_kategori' => 'Sayuran',
            'slug' => 'sayuran'
        ]);

        // Data satuan ---------------------------------------------------------------------------
        Satuan::create([
            'nama_satuan' => 'Kilogram',
            'slug' => 'buah-buahan'
        ]);

        Satuan::create([
            'nama_satuan' => 'Buah',
            'slug' => 'sayuran'
        ]);

        // Data barang ---------------------------------------------------------------------------
        Barang::create([
            'nama_barang' => 'Semangka',
            'slug' => 'semangka',
            'harga_pasok' => 15000,
            'persentase' => 'Naik 5%',
            'status_musim' => 0,
            'peminat' => 0,
            'id_kategori' => '1',
            'id_satuan' => '2',
            'id_user' => '1'
        ]);

        Barang::create([
            'nama_barang' => 'Sayur Bayam',
            'slug' => 'sayur-bayam',
            'harga_pasok' => 12000,
            'persentase' => 'Turun 2%',
            'status_musim' => 1,
            'peminat' => 1,
            'id_kategori' => '2',
            'id_satuan' => '1',
            'id_user' => '1'
        ]);

        Barang::create([
            'nama_barang' => 'Anggur',
            'slug' => 'anggur',
            'harga_pasok' => 13000,
            'persentase' => 'Naik 3%',
            'status_musim' => 1,
            'peminat' => 0,
            'id_kategori' => '1',
            'id_satuan' => '1',
            'id_user' => '1'
        ]);

        // Data barang pedagang ----------------------------------------------------
        BarangPedagang::create([
            'nama_barang' => 'Anggur',
            'slug' => 'anggur',
            'image' => '',
            'desk_barang' => 'Anggur adalah buah-buahan yang sangat lezat',
            'harga_barang' => 15000,
            'id_barang' => '3',
            'id_kategori' => '1',
            'id_satuan' => '1',
            'id_user' => '1'
        ]);

        BarangPedagang::create([
            'nama_barang' => 'Semangka',
            'slug' => 'semangka',
            'image' => '',
            'desk_barang' => 'Semangka adalah buah yang berwarna merah',
            'harga_barang' => 17000,
            'id_barang' => '1',
            'id_kategori' => '1',
            'id_satuan' => '2',
            'id_user' => '2'
        ]);

        BarangPedagang::create([
            'nama_barang' => 'Sayur Bayam',
            'slug' => 'sayur-bayam',
            'image' => '',
            'desk_barang' => 'Sayur bayam adalah salah satu sayuran yang sangat bergizi',
            'harga_barang' => 16000,
            'id_barang' => '2',
            'id_kategori' => '2',
            'id_satuan' => '1',
            'id_user' => '1'
        ]);

        Profil::factory(1)->create();
    }
}
