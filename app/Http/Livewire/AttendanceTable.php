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
        $this->setPerPage(50);
        $this->setAdditionalSelects(['attendance_details.id as id', 'attendances.date as main_date', 'attendances.crane_id as crane_id', 'attendances.project_id as project_id']);
        $this->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("العامل", "worker.name")->sortable(),
            Column::make("المشروع", "attendance.project.name")->sortable(),
            Column::make("مدير المشروع", "attendance.project.manager.name")->sortable(),
            Column::make("تاريخ الحضور", "date")->sortable(),
            Column::make("عدد ساعات العمل", "hour_work_count")->sortable(),
            Column::make("سعر الساعة للعامل", "hour_cost_project")->sortable(),
            Column::make("سعر الساعة للمشروع", "hour_cost_worker")->sortable(),
            Column::make("المشروع", "attendance.project.name")->sortable(),
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
                        ->location(fn($row) => route('attendance.create', ['month' => $row->main_date, 'crane' => $row->crane_id, 'project' => $row->project_id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn view btn-primary btn-sm m-1',
                            ];
                        }),

                ])->unclickable(),
        ];
    }
}
