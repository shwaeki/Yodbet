<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Models\Worker;

use Livewire\Component;

class MainSearch extends Component
{

    protected $listeners = ['changeStatus'];
    public $searchStatus = true;
    public $query;
    public $data;

    public function mount()
    {
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->searchStatus = false;
        $this->query = '';
        $this->data['workers'] = [];
        $this->data['clients'] = [];
        $this->data['projects'] = [];
    }

    function changeStatus($status)
    {
        $this->searchStatus = $status;
    }

    public function updatedQuery()
    {
        if (strlen($this->query) >= 3) {
            $workers = Worker::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('identification', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('phone1', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();

            $clients = Client::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('phone', 'LIKE', '%' . $this->query . '%');
                $q->orWhere('taxID', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();

            $projects = Project::where(function ($q) {
                $q->where('name', 'LIKE', '%' . $this->query . '%');
            })->get()->toArray();

            $this->data['workers'] = $workers;
            $this->data['clients'] = $clients;
            $this->data['projects'] = $projects;
        }
    }

    public function render()
    {
        return view('livewire.main-search');
    }


}
