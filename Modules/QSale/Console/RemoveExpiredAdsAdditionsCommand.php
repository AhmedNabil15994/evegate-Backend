<?php

namespace Modules\QSale\Console;

use Illuminate\Console\Command;
use Modules\QSale\Entities\AdsAddation;

class RemoveExpiredAdsAdditionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads-additions:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command for check if any additions expired to delete it for any expired additions';

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

        $count = AdsAddation::where('expire_date', '<', now())->delete();
        $this->info("Deleted $count Ads Additions Count");
    }
}
