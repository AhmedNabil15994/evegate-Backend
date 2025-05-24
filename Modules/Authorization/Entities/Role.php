<?php

namespace Modules\Authorization\Entities;

use Laratrust\Models\LaratrustRole;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Role extends LaratrustRole implements TranslatableContract
{
		use Translatable;

		protected $with 					    = ['translations'];
		protected $fillable 					= ['name', "for_worker"];
		public $translatedAttributes 	= ['display_name','description'];
		public $translationModel 			= RoleTranslation::class;

}
