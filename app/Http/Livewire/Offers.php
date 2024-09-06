<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use Livewire\Component;


class Offers extends Component
{
    public $mainOffer;
    public $Offers;

    public function mount()
    {
        $this->mainOffer = Offer::where("active","=", 1)->where('status','=','main')->first();
        $this->Offers = Offer::where("active","=", 1)->where('status','!=','main')->inRandomOrder()->limit(4)->get();
    }
    public function render()
    {
        return view('livewire.offers');
    }
}
