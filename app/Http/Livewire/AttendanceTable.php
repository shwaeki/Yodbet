<?php

namespace App\Http\Livewire;

use App\Models\AttendanceDetails;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Attendance;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class AttendanceTable extends DataTableComponent
{
    protected $model = AttendanceDetails::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setAdditionalSelects(['attendance_details.id as id']);
        $this->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("العامل", "worker.name")->sortable(),
            Column::make("المشروع", "attendance.project.name")->sortable(),
            Column::make("مدير المشروع", "attendance.project.manager.name")->sortable(),
            Column::make("تاريخ الحضور", "date")->sortable(),
            Column::make("سعر الساعة للعامل", "hour_cost_project")->sortable(),
            Column::make("سعر الساعة للمشروع", "hour_cost_worker")->sortable(),
            Column::make("الزبون", "attendance.project.client.name")->sortable(),
            Column::make('تاريخ الانشاء', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
/*            ButtonGroupColumn::make('خيارات')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('attendance.edit', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn edit btn-primary btn-sm m-1',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('attendance.destroy', $row->id))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn delete btn-primary btn-sm m-1',
                            ];
                        }),
                ])->unclickable(),*/
        ];
    }
}
