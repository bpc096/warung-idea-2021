<?php

namespace Database\Seeders;

use App\Campaign;
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
  // Campaign::factory()->count(8)->create();
    $title=[
      'Monalisa Art',
      'Innovative Core Computer',
      'Newest RPG Mode Idea',
      'Fairy Tale Interactive Book',
      'Movie Selling Book Idea',
      'Healty Idea Stuff'
    ];
    for($x=1;$x<=6;$x++){
      for($c=1;$c<=6;$c++){
        $day = rand(1,28);
        $month = rand(1,12);
        $year = rand(23,50);
        $td = rand(10000000,100000000);
        DB::table('campaigns')->insert([
          'users_id' => strval($x),
          'category_id' => strval($c),
          'title' => $title[$c-1],
          'slug' => 'monalisa-art-by-john-doe',
          'target_donation' => strval($td),
          'max_date' => "20{$year}-{$month}-{$day}",
          'description' => 'Testing Project Description, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
          'short_description' => 'Testing Project Short Description',
          'project_plan' => 'Testing Plan Project Description, consectetur adipiscing elit. Donec vel ligula facilisis, mollis nisi non, laoreet ante. Donec luctus diam elit, eget tincidunt magna elementum sit amet. Cras vitae malesuada augue. Integer congue risus augue, lobortis viverra mi semper et. Sed egestas aliquet aliquet. Nunc sit amet sapien tincidunt, faucibus orci a, ultricies orci. Maecenas iaculis, sapien ut auctor hendrerit, nisl massa gravida lacus, sit amet viverra sapien nulla non magna. Praesent facilisis urna vitae elementum viverra. Etiam volutpat eros eget sem luctus gravida. Aenean ac hendrerit massa, ut rutrum massa. Aenean vestibulum erat vitae augue rhoncus, a feugiat felis laoreet. Etiam vel condimentum est, ac elementum odio. Phasellus interdum, erat sed aliquet placerat, nibh tortor finibus libero, fermentum tempor nibh ante a tortor. Nulla malesuada, purus vitae tincidunt volutpat, nisi justo gravida elit, ac dictum dui quam at purus. Donec vel sollicitudin lectus, eget faucibus nisl. Maecenas vehicula congue est, nec pellentesque lacus suscipit nec.',
          'image' => 'dummy-campaign-image.jpg',
          'collaborators' => json_encode([]),
          'is_approved' => '1'
      ]);
      }
    }
  }
}

