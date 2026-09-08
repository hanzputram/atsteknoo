<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Menampilkan halaman dengan komponen Lifted Carousel Daftar Customer/Klien Terkenal.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customers = [
            [
                'id'          => 1,
                'name'        => 'Indofood Sukses Makmur',
                'tag'         => 'FMCG',
                'logo'        => asset('images/customers/indofood.png'),
                'subtitle'    => 'Lini Otomasi & Inverter Schneider',
                'description' => 'Penyediaan berkelanjutan Inverter Schneider Altivar ATV630 dan proteksi motor listrik.',
            ],
            [
                'id'          => 2,
                'name'        => 'Pakuwon Group',
                'tag'         => 'Property',
                'logo'        => asset('images/customers/pakuwon.png'),
                'subtitle'    => 'Mega Superblock & Switchgear Distribusi',
                'description' => 'Suplai komponen distribusi daya utama tegangan rendah dan MasterPact MTZ/NW ACB.',
            ],
            [
                'id'          => 3,
                'name'        => 'Dua Kelinci',
                'tag'         => 'Confectionery',
                'logo'        => asset('images/customers/dua-kelinci.png'),
                'subtitle'    => 'Proteksi Motor & Kontrol TeSys',
                'description' => 'Implementasi komponen kendali otomatisasi industri dan magnetic contactors TeSys.',
            ],
            [
                'id'          => 4,
                'name'        => 'Bumi Menara Internusa',
                'tag'         => 'Cold Storage',
                'logo'        => asset('images/customers/bmi.png'),
                'subtitle'    => 'Power Quality & Breaker Tahan Korosi',
                'description' => 'Penyediaan perangkat kelistrikan heavy-duty dan panel box IP66 Legrand Plexo.',
            ],
            [
                'id'          => 5,
                'name'        => 'Charoen Pokphand',
                'tag'         => 'Agro-Industry',
                'logo'        => asset('images/customers/pokphand.png'),
                'subtitle'    => 'Panel Kontrol & Distribusi Pabrik Pakan',
                'description' => 'Pengadaan kontaktor daya besar dan panel kontrol terintegrasi pabrik pakan modern.',
            ],
        ];

        return view('customers.index', compact('customers'));
    }
}
