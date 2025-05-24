<?php

namespace Modules\QSale\Entities;

use Modules\QSale\Entities\Ads;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\ClearsResponseCache;
use Modules\Core\Traits\HasCompositePrimaryKey;

class AdsSeen extends Model
{
    use HasCompositePrimaryKey;
    use  ClearsResponseCache;
    protected $table = 'ads_seen';
    protected $fillable = ["user_id", "ads_id"];
    protected $primaryKey = ["ads_id", "user_id"];


    public function ads()
    {
        return $this->belongsTo(Ads::class, "ads_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    
}
