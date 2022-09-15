<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_event')->insert([
            'event' => 'Konser blank pink',
            'about_event' => 'Girlband BLACKPINK akan comeback pada bulan ini. Grup besutan YG Entertainment itu pun telah bagikan daftar lagu untuk album kedua mereka yang bertajuk "Born Pink".',
            'banner' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Blackpink_PUBG_210321.jpg/1200px-Blackpink_PUBG_210321.jpg',
            'tgl_event' => '2022-09-15',
            'status' => '2022-09-16',
        ]);

        DB::table('tbl_event')->insert([
            'event' => 'EXO Showtime',
            'about_event' => 'EXO Showtime menjadi penanda dari variety show yang pertama kali dibintangi oleh EXO. Dari 12 episode dalam EXO Showtime, kamu akan diajak mengenal lebih dekat personality dari masing-masing ',
            'banner' => 'https://cdns.klimg.com/kapanlagi.com/p/exo_showtime.jpg',
            'tgl_event' => '2022-09-16',
            'status' => '2022-09-16',
        ]);
    }
}
