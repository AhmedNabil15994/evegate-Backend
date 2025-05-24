<?php
namespace Modules\User\Concerns;

use Carbon\Carbon;
use Modules\Learn\Entities\Lesson;

trait AvailabityTrait
{
    
    public function checkDateNotInOff($date)
    {
        if($this->have_off = 0) return true;
        $date = static::parseDateCarbon($date);
        if (
            is_array($this->offs) 
            && isset($this->offs["start"]) 
            && isset($this->offs["end"]) 
            && $this->offs["start"] 
            && $this->offs["end"]) {
            // return !$date->between( Carbon::parse($this->offs["start"]), Carbon::parse($this->offs["end"]));
            return !($date->gte($this->offs["start"]) &&  $date->lt($this->offs["end"]));
                
        }
        return true;
    }

    public  static function checkIfDateReserivationQuery($date, $teacher_id, $exculude_id=null){
      $date = static::parseDateCarbon($date);
      $date->second(0);
      return   Lesson::where("teacher_id", $teacher_id)
                        ->paied()
                        ->where(function($query) use(&$date, &$exculude_id){
                            $query->where("start_at","<=",$date->toDateTimeString())
                                    ->where("end_at",">",$date->toDateTimeString())
                                    ->when($exculude_id, function($query) use($exculude_id){
                                        $query->where("id", "!=", $exculude_id);
                                    });
                        })
                        ->exists();

    }  
    
    public  static function checkIfDateReserivation($date, $resevations=[]){
        $date = static::parseDateCarbon($date);
        $date->second(0);
      
        $resevations = $resevations->where("date", $date->format("Y-m-d"));
        foreach ($resevations as $resevation) {
        //   dd($resevation->toArray(),$date->format("d-m-Y h:i") ,$resevation["start_at"]->format("d-m-Y h:i") ,$resevation["end_at"]->format("d-m-Y h:i"),$date->between($resevation["start_at"], $resevation["end_at"]));
           if($date->gte($resevation["start_at"]) &&  $date->lt($resevation["end_at"])){
               return false;
           }
        }
       
        return true;
  
    }       

    public function checkIfDataAvaibale($date, $resevations=[]){

        $date = static::parseDateCarbon($date);
        $validation[] = $date->isFuture();
        $validation[] = $this->checkDateNotInOff($date);
        if($resevations)  $validation[] = static::checkIfDateReserivation($date, $resevations);
        return array_product($validation);
    }

    public static function parseDateCarbon($date){
        if (!($date instanceof Carbon)) {
            $date = Carbon::parse($date);
        }
        return $date;
    }

    public function checkWorkingInDate($date){
        $date = static::parseDateCarbon($date);
        if(!$this->working) return false;
        $day = strtolower($date->format("l"));
       
        if(
            $this->checkDateNotInOff($date) &&
            isset($this->working[$day]) && 
            isset($this->working[$day]["times"]) &&  
            is_array($this->working[$day]["times"]) &&  
            in_array($date->format("H:i"), $this->working[$day]["times"])
          ){
            return true;
        }
        return false;
    }
}
