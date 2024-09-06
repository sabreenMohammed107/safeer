<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use App\Models\Explore_city;

class ExploreSection extends Component
{
    public $ExploreCities;
    public $Company;

    public function mount()
    {
        $this->ExploreCities = Explore_city::where("active","=", 1)->get();
        $this->Company = Company::first();
    }

    public function render()
    {
        return view('livewire.explore-section');
    }
}
