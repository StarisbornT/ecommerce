<?php

namespace App\DataTables;

use App\Models\ShippingRule;
use App\Models\GeneralSetting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ShippingRuleDataTable extends DataTable
{
    protected $currencyIcon = '';

    public function __construct() {
        $this->currencyIcon = GeneralSetting::first()->currency_icon;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query) {
            $editBtn = '<a href="'.route('admin.shipping-rule.edit', $query->id).'" class="btn btn-primary"><i class="bi bi-pen-fill"></i></a>';
            $deleteBtn = '<a href="'.route('admin.shipping-rule.destroy', $query->id).'" class="btn btn-danger delete-item"><i class="bi bi-trash-fill"></i></a>';
            return $editBtn.$deleteBtn;
        })
        ->addColumn('status', function($query) {
            if($query->status == 1) {

                $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                            <span class="custom-switch-indicator"></span>
                            </label>
                ';
            }else {
                $button = '<label class="custom-switch mt-2">
                <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                <span class="custom-switch-indicator"></span>
                </label>
    ';
            }
            return $button;
        })
        ->addColumn('type', function($query) {
            switch($query->type) {
                case 'min_cost':
                    return '<i class="badge badge-success">Minimum Cost</i>';
                    break;

            case 'flat_cost':
                return '<i class="badge badge-primary">Flat Cost</i>';
                break;

            default:
                return '<i class="badge badge-dark">None</i>';
                break;
            }
        })

        ->addColumn('min_cost', function($query) {
            switch($query->type) {
                case 'min_cost':
                    return $this->currencyIcon.$query->min_cost;
                    break;

            case 'flat_cost':
                return $this->currencyIcon.'0';
                break;

            }
        })
        ->addColumn('cost', function($query) {
           return $this->currencyIcon.$query->cost;
        })

        ->rawColumns(['status', 'action', 'type', 'min_cost'])
         ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('shippingrule-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('type'),
            Column::make('min_cost'),
            Column::make('cost'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ShippingRule_' . date('YmdHis');
    }
}