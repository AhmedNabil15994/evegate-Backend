<?php

namespace Modules\Apps\Entities;

use Modules\Core\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use UsesUuid;
    protected $guarded 				    	= ['id'];
}
