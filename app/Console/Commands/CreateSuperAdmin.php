<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\User\Entities\User;
use Modules\Authorization\Entities\Role;
use Modules\Authorization\Entities\Permission;

;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create 
                {email=Ahmed.safwat1235@gmail.com : 123456  mail} 
                {password=123456 : password for admin default admin} 
                {--p=false:if true will create permssion}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create the admin account with permssion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email    =   $this->argument('email');
        $password =   $this->argument('password');
        $createPermission = $this->option('p');
        $this->info("$email : $password , $createPermission");
        $role = $this->createPermssion();
        $admin = $this->createAdmin($email, $password);
        $admin->syncRoles([$role->id]);
        return 0;
    }

    public function createPermssion()
    {
        Permission::updateOrCreate([
            "display_name"  => "access" ,
            "name"=>"dashboard_access"
        ], [
            "ar" => [
                "description" => "الوصول الى لحة التحكم"
            ] ,
            "en" => [
                "description" => "Dashboard Access"
            ]
        ]);

        $role = Role::updateOrCreate([
            "name"=>"Super Admin"
        ], [
            "ar" => [
                "display_name"=> "مدير لوحة التحكم" ,
                "description" => "مدير لوحة التحكم"
            ] ,
            "en" => [
                "display_name" => "Super Admin",
                "description" => "Super Admin"
            ]
        ]);

        $permssions = [
            "users","admins",
             "pages", "questions",
             "countries","slider",
             "cities","states",
             "settings","roles","permissions","notifications",
             "attributes","categories","addations","ads","coupons","packages",
             "offers", "advertisement" ,"ad_types" , "companies" , "technicals"
            
            ];

        foreach ($permssions as $key => $perm) {
            $this->call("permission:create", [
                "route" => $perm
            ]);
        }
        $role->syncPermissions(Permission::get());
        return $role;
    }

    public function createAdmin($email, $password)
    {
        return  User::updateOrCreate(
            [
                "email"     =>$email,
               
            ],
            [
                "name"      => "admin" ,
                "user_name" => "super Admin",
                "phone_code"=> "965",
                "image"     => "/uploads/default.png",
                "type"      => "admin",
                "password"  => bcrypt($password)
            ]
        );
    }
}
