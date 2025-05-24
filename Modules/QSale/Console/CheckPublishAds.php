<?php

namespace Modules\QSale\Console;

use Illuminate\Console\Command;
use Modules\QSale\Entities\Ads;
use Modules\QSale\Enum\AdsStatus;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckPublishAds extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Ads:check-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check if start_at in ads in comming for ads wait and paied';

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
     * @return mixed
     */
    public function handle()
    {
        //
       $count = Ads::where("is_paid", 1)
             ->where("status", AdsStatus::WAIT)
             ->whereNotNull("start_at") 
             ->whereNotNull("end_at") 
             ->started()
             ->update(["status"=>AdsStatus::PUBLIUSH]);

        $this->info("Publish $count Ads");

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
         
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
           
        ];
    }
}
