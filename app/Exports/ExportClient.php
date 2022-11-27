<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportClient implements FromCollection
{
    public $clients;

    public function __construct($clients) {
        $this->clients = $clients;
    }

    public function collection()
    {
        return Client::whereIn('id', $this->clients)->get();
    }
}
