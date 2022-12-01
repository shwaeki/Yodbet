<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Worker;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class WorkerTable extends DataTableComponent
{
    protected $model = Worker::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['workers.id as id']);
        $this->setColumnSelectStatus(false);


        $this->setTableRowUrl(function ($row) {
            return route('worker.show', $row->id);
        });
    }

    public function columns(): array
    {
        return [

            Column::make("שם", "name")->sortable(),
            Column::make("מספר טלפו", "phone1")->sortable(),
            Column::make("מחיר שעון", "hour_cost")->sortable(),
            Column::make("מספר תעודת זהות", "identification")->sortable(),
            BooleanColumn::make("המצב", "status")->sortable(),
            Column::make("נוסף על ידי", "user.name")->sortable(),

            Column::make('תאריך יצירה', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
            ButtonGroupColumn::make('אפשרויות')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('worker.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
/*                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('worker.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),*/
                ])->unclickable(),
        ];
    }
}
