<?php

namespace App\Http\Livewire;

use App\Exports\ExportClient;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Client;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Maatwebsite\Excel\Facades\Excel;

class ClientTable extends DataTableComponent
{
    protected $model = Client::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['clients.id as id']);
        $this->setColumnSelectStatus(false);

        $this->setTableRowUrl(function ($row) {
            return route('client.show', $row->id);
        });
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("الاسم", "name")->searchable()->sortable(),
            Column::make("رقم الهاتف", "phone")->searchable()->sortable(),
            Column::make("الرقم الضريبي", "taxID")->searchable()->sortable(),
            Column::make("اضيف بواسطة", "user.name")->sortable(),

            Column::make('تاريخ الانشاء', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
            ButtonGroupColumn::make('خيارات')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('client.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
/*                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('client.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),*/
                ])->unclickable(),
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new ExportClient($users), 'Clients.xlsx');
    }
}
