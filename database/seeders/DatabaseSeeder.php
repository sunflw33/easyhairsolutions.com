<?php
namespace Database\Seeders;
use App\Models\Appointment;
use App\Models\Professional;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
 public function run(): void
 {
  $permissions=['book appointments','manage own appointments','manage services','manage products','manage professionals','manage customers','view reports','manage bookings'];
  foreach($permissions as $p) Permission::findOrCreate($p,'web');
  $roles=[]; foreach(['customer','professional','owner'] as $name) $roles[$name]=Role::findOrCreate($name,'web');
  $roles['customer']->syncPermissions(['book appointments','manage own appointments']);
  $roles['professional']->syncPermissions(['manage own appointments']);
  $roles['owner']->syncPermissions($permissions);
  $owner=User::factory()->create(['name'=>'Olivia Hart','email'=>'owner@Easyhairsolutions.test','password'=>'password']); $owner->assignRole('owner');
  $proUsers=[];
  foreach([['Maya Brooks',['Silk Press','Healthy Hair Care']],['Jasmine Reed',['Locs','Natural Styling']],['Nia Carter',['Braids','Protective Styling']]] as [$name,$specialties]){
    $u=User::factory()->create(['name'=>$name,'email'=>strtolower(str_replace(' ','',$name)).'@Easyhairsolutions.test','password'=>'password']); $u->assignRole('professional'); $proUsers[]=$u; Professional::create(['user_id'=>$u->id,'bio'=>'Modern beauty professional focused on beautiful, healthy results.','specialties'=>$specialties]);
  }
  $customer=User::factory()->create(['name'=>'Jordan Lee','email'=>'customer@Easyhairsolutions.test','password'=>'password']); $customer->assignRole('customer');
  $services=[
   ['Silk Press','silk-press','Signature Styling','Smooth, glossy finish with cleanse, condition and heat styling.',90,115],
   ['Healthy Hair Treatment','healthy-hair-treatment','Hair & Scalp Wellness','Deep conditioning and restorative care tailored to your hair goals.',60,75],
   ['Protective Braids','protective-braids','Braids','Polished protective styling with a consultation-first approach.',180,165],
   ['Loc Maintenance','loc-maintenance','Locs','Clean, refined maintenance designed for healthy, comfortable locs.',120,95],
   ['Signature Weave Install','signature-weave-install','Weaves','Natural-looking install with finish work and styling.',180,185],
   ['Shape & Finish','shape-and-finish','Cuts','A tailored cut with movement, polish and a finished style.',60,65],
  ];

  foreach ($services as [$name, $slug, $category, $desc, $duration, $price]) {
      Service::create([
          'name' => $name,
          'slug' => $slug,
          'category' => $category,
          'description' => $desc,
          'duration_minutes' => $duration,
          'price' => $price,
      ]);
  }
    
  foreach ([
      ['Scalp Renewal Serum', 'scalp-renewal-serum', 'A lightweight daily scalp care essential.', 34, 24],
      ['Silk Finish Oil', 'silk-finish-oil', 'Finishing oil for shine and softness.', 28, 18],
      ['Hydration Mask', 'hydration-mask', 'Salon-grade moisture support for dry hair.', 36, 26],
      ['Edge + Detail Brush', 'edge-detail-brush', 'Minimal, durable styling essential.', 20, 14],
  ] as [$name, $slug, $desc, $stock, $price]) {
      Product::create([
          'name' => $name,
          'slug' => $slug,
          'description' => $desc,
          'stock' => $stock,
          'price' => $price,
      ]);
  }
    
  Appointment::create(['user_id'=>$customer->id,'professional_id'=>Professional::first()->id,'service_id'=>Service::first()->id,'starts_at'=>now()->addDays(2)->setTime(14,0),'ends_at'=>now()->addDays(2)->setTime(15,30),'status'=>'confirmed','total'=>Service::first()->price]);
 }
}
