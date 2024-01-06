<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\ProductVariantItem;
use Yajra\DataTables\EloquentDataTable;
use App\Models\VendorProductVariantItem;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class VendorProductVariantItemDataTable extends DataTable
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
            $editBtn = '<a href="'.route('vendor.products-variant-item.edit', $query->id).'" class="btn btn-primary"><i class="bi bi-pen-fill"></i>Edit</a>';
            $deleteBtn = '<a href="'.route('vendor.products-variant-item.destroy', $query->id).'" class="btn btn-danger delete-item ml-1"><i class="bi bi-trash-fill"></i>Delete</a>';

            return $editBtn.$deleteBtn;
        })
            ->addColumn('variant_name', function($query) {
                return $query->productVariant->name;
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
            ->addColumn('is_default', function($query) {
                if($query->is_default == 1) {
                    return '<i class="badge bg-success">Default</i>';
                }else {
                    return '<i class="badge bg-danger">No</i>';
                }
            })
            ->rawColumns(['status', 'action', 'is_default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproductvariantitem-table')
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
            Column::make('variant_name'),
            Column::make('price'),
            Column::make('is_default'),
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
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}