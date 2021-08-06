<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'sitename' => 'جهانپارس',
            'description' => 'این یه توضیح درباره جهان پارس است',
            'keyword' => 'جهانپارس,جهان پارس,',
            'image' => '/images/photos/shares/logo/logo.png',
            'phone' => '09022602943',
            'phoneadmin' => '09305257455',
            'location' => "https://www.google.com/maps/place/36%C2%B042'24.7%22N+51%C2%B011'24.7%22E/@36.706865,51.1923797,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x0!8m2!3d36.706865!4d51.190191",
            'email' => 'support@jahanpars.ir',
            'address' => 'ایران ، جهانپارس',
            'instagram' => 'https://instagram.com/jahanpars.elc',
            'whatsup' => 'whatsapp://send?phone=989022602943&abid=989022602943',
            'telegram' => 'tg://resolve?domain=jahanparsabbasianelc2021',
        ]);
    }
}
