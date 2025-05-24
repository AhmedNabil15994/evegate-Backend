<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\UsesUuid;
use Modules\Attribute\Entities\Option;
use Illuminate\Database\Eloquent\Model;
use Modules\Attribute\Entities\Attribute;
use Modules\Core\Traits\ClearsResponseCache;

class AdsAttribute extends Model
{
    use UsesUuid;
    use  ClearsResponseCache;
    protected $guarded = ["id"];
    protected $with    = ["attribute", "option"];

    public function ads(){
        return $this->belongsTo(Ads::class, "ads_id");
    }

    public function attribute(){
        return $this->belongsTo(Attribute::class, "attribute_id");
    }

    public function option(){
        return $this->belongsTo(Option::class, "option_id");
    }


}
