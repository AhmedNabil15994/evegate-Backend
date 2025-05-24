<?php

namespace Modules\QSale\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Modules\Core\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepublishedPackage extends Model
{
    use HasTranslations,
    ScopesTrait    ,
    ClearsResponseCache,
    SoftDeletes    ;
    public $translatable = ['title', "description"];
    protected $guarded 				    	= ['id'];
    
}
