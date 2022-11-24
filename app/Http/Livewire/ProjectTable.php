<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Project;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ProjectTable extends DataTableComponent
{
    protected $model = Project::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['projects.id as id','projects.client_id as client_id']);
        $this->setColumnSelectStatus(false);
        $this->setTableRowUrl(function ($row) {
            return route('project.show', $row->id);
        });
    }

    public function columns(): array
    {
        return [
            Column::make("اسم المشروع", "name")->sortable(),
            Column::make("العنوان", "address")->sortable(),
            Column::make("تاريخ البدا", "start_date")->sortable(),
            Column::make("تاريخ الانتهاء", "end_date")->sortable(),
            Column::make("سعر الساعة", "hour_cost")->sortable(),
            Column::make("مدير المشروع", "manager.name")->sortable(),
            Column::make("الزبون", "client.name")->sortable(),
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
                        ->location(fn($row) => route('client.project.edit', [$row->client_id,$row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('client.project.destroy', [$row->client_id,$row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),
                ])->unclickable(),
        ];
    }
}
