<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class EmployeeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query) {
            $showBtn = '<a href="'.route('admin.employee.show', $query->id).'" class="btn btn-primary"><i class="far fa-eye"></i></a>';
            $editBtn = '<a href="'.route('admin.employee.edit', $query->id).'" class="btn btn-primary ml-1"><i class="bi bi-pen-fill"></i></a>';
            $deleteBtn = '<a href="'.route('admin.employee.destroy', $query->id).'" class="btn btn-danger delete-item ml-1"><i class="bi bi-trash-fill"></i></a>';

            return $showBtn.$editBtn.$deleteBtn;
        })
        ->addColumn('employee_role', function($query) {
            switch ($query->employee_role) {
                case 'manager':
                    return "<span class='badge bg-warning text-white'>Manager</span>";
                    break;
                case 'developer':
                    return "<span class='badge bg-info text-white'>Developer</span>";
                    break;
                case 'design':
                    return "<span class='badge bg-primary text-white'>Design</span>";
                    break;
                case 'scrum_master':
                    return "<span class='badge bg-secondary text-white'>Scrum Master</span>";
                    break;

                default:
                    # code...
                    break;
            }

        })
        ->addColumn('status', function($query) {
            if ($query->status == "active") {
                return "<span class='badge bg-success text-white'>Employed</span>";
            }else {
                return "<span class='badge bg-danger text-white'>Fired</span>";

            }
        })
            ->rawColumns(['action', 'status', 'employee_role'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('employee-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('username'),
            Column::make('email'),
            Column::make('employee_role'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Employee_' . date('YmdHis');
    }
}