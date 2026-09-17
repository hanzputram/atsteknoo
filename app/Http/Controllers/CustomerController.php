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
                'logo'        => asset('images/customers/indofood.webp'),
                'subtitle'    => 'Schneider Automation & Inverter Line',
                'description' => 'Continuous supply of Schneider Altivar ATV630 inverters and industrial motor protection systems.',
            ],
            [
                'id'          => 2,
                'name'        => 'Pakuwon Group',
                'tag'         => 'Property',
                'logo'        => asset('images/customers/pakuwon.webp'),
                'subtitle'    => 'Mega Superblock & Distribution Switchgear',
                'description' => 'Primary low-voltage power distribution switchboards and MasterPact MTZ/NW Air Circuit Breakers.',
            ],
            [
                'id'          => 3,
                'name'        => 'Dua Kelinci',
                'tag'         => 'Confectionery',
                'logo'        => asset('images/customers/dua-kelinci.webp'),
                'subtitle'    => 'Motor Protection & TeSys Control',
                'description' => 'Industrial automation control components and premium TeSys magnetic contactor systems.',
            ],
            [
                'id'          => 4,
                'name'        => 'Bumi Menara Internusa',
                'tag'         => 'Cold Storage',
                'logo'        => asset('images/customers/bmi.webp'),
                'subtitle'    => 'Power Quality & Corrosion-Resistant Breakers',
                'description' => 'Heavy-duty industrial electrical components and Legrand Plexo IP66 weatherproof enclosure panels.',
            ],
            [
                'id'          => 5,
                'name'        => 'Charoen Pokphand',
                'tag'         => 'Agro-Industry',
                'logo'        => asset('images/customers/pokphand.webp'),
                'subtitle'    => 'Feedmill Control & Distribution Panels',
                'description' => 'High-capacity power contactors and integrated control panels for modern feedmill production lines.',
            ],
        ];

        return view('customers.index', compact('customers'));
    }
}
