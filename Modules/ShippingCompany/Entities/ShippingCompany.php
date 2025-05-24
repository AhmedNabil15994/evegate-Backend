<?php

namespace Modules\ShippingCompany\Entities;

use Spatie\MediaLibrary\HasMedia;
use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\CasscadeAttach;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCompany extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations,
        CasscadeAttach,
        SoftDeletes,
        ScopesTrait;

    public $translatable       = ['title', "address"];
    protected $guarded         = ['id'];
    protected $casscadeAttachs = ["image"];
}
