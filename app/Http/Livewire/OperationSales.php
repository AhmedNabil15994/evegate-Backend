<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Wallet\Repositories\Dashboard\SalesRepository;

class OperationSales extends Component
{
    
    public $content;
    public $type ;
    public $take =10;
    public function render()
    {
        return view('livewire.operation-sales');
    }

    public function mount( $type)
    {
        $this->type = $type;
        $this->getTheContent();
  
    }

    public function getTheContent(){
        $repo         = app()->make(SalesRepository::class);
        $this->content = $repo->getLastOperations($this->type, $this->take);
       
    }

    public function setTake($value){
        $this->take = $value;
        $this->getTheContent();
    }
}
