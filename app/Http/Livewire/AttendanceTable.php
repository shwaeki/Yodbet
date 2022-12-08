<?php

namespace App\Http\Livewire;


use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Attendance;


class AttendanceTable extends DataTableComponent
{
    protected $model = Attendance::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setPerPage(50);
        $this->setAdditionalSelects(['attendances.date as main_date', 'attendances.crane_id as crane_id', 'attendances.project_id as project_id']);
        $this->setColumnSelectStatus(false);
        $this->setTableRowUrl(function ($row) {
            return  route('attendance.create', ['month' => $row->main_date, 'crane' => $row->crane_id, 'project' => $row->project_id]);
        });
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")->sortable(),
            Column::make("פרוייקט", "project.name")->sortable(),
            Column::make("מנהל פרוייקט", "project.manager.name")->sortable(),
            Column::make("מנוף", "crane.name")->sortable(),
            Column::make("תאריל", "date")->sortable(),
            Column::make('סל הכול שעות')
                ->label(function ($row) {
                    return $row->total_hours;
                })->sortable(),
            Column::make('תאריך יצירה', "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
        ];
    }
}
