<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\VendorProductVariant;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class VendorProductVariantDataTable extends DataTable
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
            $variantItems = '<a href="'.route('vendor.products-variant-item.index', ['productId' => request()->product, 'variantId' => $query->id]).'" class="btn btn-info" style="margin-left:10px; color:white"><i class="bi bi-pen-fill"></i>Variant Items</a>';
            $editBtn = '<a href="'.route('vendor.products-variant.edit', $query->id).'" class="btn btn-primary" ><i class="bi bi-pen-fill"></i>Edit</a>';
            $deleteBtn = '<a href="'.route('vendor.products-variant.destroy', $query->id).'" class="btn btn-danger delete-item" style="margin-left:10px">Delete</a>';

            return $editBtn.$deleteBtn.$variantItems;
        })
        ->addColumn('status', function($query) {
            if($query->status == 1) {

                $button = '<div class="form-check form-switch">
                            <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="form-check-input change-status">
                            </div>
                ';
            }else {
                $button = '
                <div class="form-check form-switch">
                <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="form-check-input change-status">
               </div>
    ';
            }
            return $button;
        })

            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where("products_id", request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproductvariant-table')
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
            Column::make('id')->width(80),
            Column::make('name'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(400)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductVariant_' . date('YmdHis');
    }
}