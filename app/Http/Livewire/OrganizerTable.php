<?php

namespace App\Http\Livewire;

use App\Models\Organizer;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class OrganizerTable extends DataTableComponent
{
    protected $model = organizer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPerPage(50);
        $this->setAdditionalSelects(['organizers.id as id']);
        $this->setColumnSelectStatus(false);

        $this->setTableRowUrl(function ($row) {
            return route('organizer.show', $row->id);
        });
    }


    public function columns(): array
    {
        return [
            Column::make("שם ", "name")->searchable()->sortable(),
            Column::make("טלפון נייד", "phone")->searchable()->sortable(),
            Column::make("מחיר לשעה", "hour_cost")->sortable(),


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
                        ->location(fn($row) => route('organizer.edit', $row->id))
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

}
