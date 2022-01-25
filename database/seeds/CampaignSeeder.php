<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '1',
            'title' => 'Monalisa Art by John Doe',
            'slug' => 'monalisa-art-by-john-doe',
            'target_donation' => '25000000',
            'max_date' => '2022-06-30',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '2',
            'title' => 'Monalisa Art by Jane Doe',
            'slug' => 'monalisa-art-by-jane-doe',
            'target_donation' => '30000000',
            'max_date' => '2022-02-25',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '3',
            'title' => 'Monalisa Art by John Doe',
            'slug' => 'monalisa-art-by-john-doe',
            'target_donation' => '35000000',
            'max_date' => '2022-01-30',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '4',
            'title' => 'Monalisa Art by Jane Doe',
            'slug' => 'monalisa-art-by-jane-doe',
            'target_donation' => '40000000',
            'max_date' => '2022-05-30',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '5',
            'title' => 'Monalisa Art by John Doe',
            'slug' => 'monalisa-art-by-john-doe',
            'target_donation' => '45000000',
            'max_date' => '2022-04-28',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '6',
            'title' => 'Monalisa Art by Jane Doe',
            'slug' => 'monalisa-art-by-jane-doe',
            'target_donation' => '50000000',
            'max_date' => '2022-03-18',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '1',
            'title' => 'Monalisa Art by John Doe',
            'slug' => 'monalisa-art-by-john-doe',
            'target_donation' => '55000000',
            'max_date' => '2022-07-22',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '2',
            'title' => 'Monalisa Art by Jane Doe',
            'slug' => 'monalisa-art-by-jane-doe',
            'target_donation' => '60000000',
            'max_date' => '2022-08-30',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '3',
            'title' => 'Monalisa Art by John Doe',
            'slug' => 'monalisa-art-by-john-doe',
            'target_donation' => '65000000',
            'max_date' => '2022-09-21',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);

        DB::table('campaigns')->insert([
            'users_id' => '1',
            'category_id' => '4',
            'title' => 'Monalisa Art by John Doe',
            'slug' => 'monalisa-art-by-jane-doe',
            'target_donation' => '70000000',
            'max_date' => '2022-10-21',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
            'image' => '',
        ]);
    }
}
