<?php
namespace Modules\Core\Traits;

/**
 * 
 */
trait CascadeDelete
{
    
 

    /**
     * Fetch methods name than must return a morph relation.
     *
     * @return string[]
     */
    public function getCascadeDeleteMorph()
    {
        return (array) ($this->cascadeDeleteMorph ?? []);
    }

    public function deleteMorphoReation(){
        foreach ($this->getCascadeDeleteMorph() as  $relation) {
            # code...
            $this->$relation->delete();
        }
    }

}
