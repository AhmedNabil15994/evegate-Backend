<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Authorization\Entities\Permission;

;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create {route :  route name like users}';

    protected $mapKey = [
        "show" => [
            "lang" => [
                "ar" => [
                    "description" => "عرض"
                ] ,
                "en" => [
                    "description" => "show"
                ] ,
               
            ]
        ],
        "add" => [
            "lang" => [
                "ar" => [
                    "description" => "أضافه"
                ] ,
                "en" => [
                    "description" => "add"
                ]
                 
            ]
        ],
        "edit" => [
            "lang" => [
                "ar" => [
                    "description" => "تعديل"
                ] ,
                "en" => [
                    "description" => "edit"
                ]
                
            ]
        ],
        "delete" => [
            "lang" => [
                "ar" => [
                    "description" => "حذف"
                ] ,
                "en" => [
                    "description" => "delete"
                ]
                 
            ]
        ],
    ];

    protected $transformKey = [
        "show" => [
            "lang" => [
                "ar" => [
                    "description" => "عرض"
                ] ,
                "en" => [
                    "description" => "show"
                ] ,
               
            ]
        ],
        "search" => [
            "lang" => [
                "ar" => [
                    "description" => "بحث"
                ] ,
                "en" => [
                    "description" => "Search"
                ] ,
               
            ]
        ],
        
        "add" => [
            "lang" => [
                "ar" => [
                    "description" => "أضافه"
                ] ,
                "en" => [
                    "description" => "add"
                ]
                 
            ]
        ],
        "edit" => [
            "lang" => [
                "ar" => [
                    "description" => "تعديل"
                ] ,
                "en" => [
                    "description" => "edit"
                ]
                
            ]
        ],
        "delete" => [
            "lang" => [
                "ar" => [
                    "description" => "حذف"
                ] ,
                "en" => [
                    "description" => "delete"
                ]
                 
            ]
        ],
    ];

    protected $accessKey = [
        "dashboard" => [
            "lang" => [
                "ar" => [
                    "description" => "الوصول الى لوحة التحكم"
                ] ,
                "en" => [
                    "description" => "dashboard access"
                ] ,
               
            ]
        ],
       "worker" => [
        "lang" => [
            "ar" => [
                "description" => "  الوصول الى لوحة تحكم المصارف "
            ] ,
            "en" => [
                "description" => "Exchange Dashboard Access"
            ] ,
           
        ]
       ]
    ];

    protected $notificationKey = [
        "show" => [
            "lang" => [
                "ar" => [
                    "description" => "عرض"
                ] ,
                "en" => [
                    "description" => "show"
                ] ,
               
            ]
        ],
       "send" => [
        "lang" => [
            "ar" => [
                "description" => "ارسال"
            ] ,
            "en" => [
                "description" => "Send"
            ] ,
           
        ]
       ]
    ];

    protected $settingsKey = [
        "edit" => [
            "lang" => [
                "ar" => [
                    "description" => "تعديل"
                ] ,
                "en" => [
                    "description" => "edit"
                ] ,
               
            ]
        ],
     
    ];


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create permission for the routes ';

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
        $route = $this->argument('route');
        $route = trim($route);

        $routeSingular = $route;
       
        // Permission::where("display_name", $route)->delete();
        $maps = $this->mapKey;

        if ($route == "access") {
            $maps = $this->accessKey;
        }

        if($route == "transforms") $maps = $this->transformKey;

        if ($route == "notifications") {
            $maps = $this->notificationKey;
        }

        if ($route == "settings") {
            $maps = $this->settingsKey;
        }
       

        foreach ($maps as $key => $value) {
            # code...
          
            Permission::updateOrCreate(
                ["name"        => $key."_".$routeSingular ],
                array_merge(
                    [
                    
                    "display_name"        => $route ,
                    "name"                => $key."_".$routeSingular


                ],
                    $value["lang"]
                )
            );
        }
        
        $this->info("done");
    }
}
