<?php

namespace Modules\Authorization\Entities;

use Astrotomic\Translatable\Translatable;
use Laratrust\Models\LaratrustPermission;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Permission extends LaratrustPermission implements TranslatableContract
{
  	use Translatable;

    protected $with 					    = ['translations'];
  	protected $fillable 					= ['display_name','name'];
  	public $translatedAttributes 	= ['description'];
    public $translationModel 			= PermissionTranslation::class;

}
