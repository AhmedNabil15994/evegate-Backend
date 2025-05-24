<?php

namespace Modules\Question\Entities;

use Modules\Core\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Question\Entities\QuestionTranslation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Question extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes , ScopesTrait;

    protected $with 					    = ['translations'];
    protected $guarded 				    	= ['id'];
    public $translatedAttributes 	= [ 'question' , 'answer' ];
    public $translationModel 			= QuestionTranslation::class;
}
