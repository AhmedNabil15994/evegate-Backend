<?php

namespace Modules\QSale\Console;

use Illuminate\Console\Command;
use Modules\QSale\Entities\Ads;
use Modules\QSale\Enum\AdsStatus;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckExpiredAds extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'Ads:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Check if Ads is expired .';

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
        $count = Ads::where("is_paid", 1)
             ->where("status", AdsStatus::PUBLIUSH)
             ->expired()
             ->update(["status"=>AdsStatus::EXPIRED]);
             
        $this->info("Expird $count Ads");
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
