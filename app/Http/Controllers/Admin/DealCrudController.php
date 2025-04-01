<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DealRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Account;
use App\Models\Deal;
use App\Models\Iso;

/**
 * Class DealCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DealCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Deal::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/deal');
        CRUD::setEntityNameStrings('deal', 'deals');

        CRUD::addField(['name' => 'submission_date', 'type' => 'date_picker']);
        CRUD::addField([
            'name'     => 'account_id',
            'attribute' => 'business_name',
            'type'     => 'select2',
            'entity'   => 'account',
            'model'    => 'App\Models\Account',
            'label'    => 'Account'
        ]);
        CRUD::addField([
            'name'       => 'deal_name',
            'type'       => 'text',
            'attributes' => ['readonly' => 'readonly'],
            'label'      => 'Deal Name (auto-generated)',
            'default'    => ''
        ]);
        CRUD::addField([
            'name'     => 'iso_id',
            'attribute' => 'business_name',
            'type'     => 'select2',
            'entity'   => 'iso',
            'model'    => 'App\Models\Iso',
            'label'    => 'ISO'
        ]);
        CRUD::addField([
            'name'    => 'sales_stage',
            'type'    => 'select_from_array',
            'options' => [
                'New Deal'    => 'New Deal',
                'Missing Info'=> 'Missing Info',
                'Deal Won'    => 'Deal Won',
                'Deal Lost'   => 'Deal Lost'
            ]
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->setColumns([]);
        CRUD::addColumn([
            'name'      => 'submission_date',
            'type'      => 'date',
            'label'     => 'Submission Date',
            'orderable' => true,
        ]);
        CRUD::addColumn([
            'name'      => 'account_id',
            'type'      => 'select',
            'entity'    => 'account',
            'model'     => 'App\Models\Account',
            'attribute' => 'business_name',
            'label'     => 'Account Name',
            'orderable' => true,
        ]);
        CRUD::addColumn([
            'name'      => 'sales_stage',
            'type'      => 'select_from_array',
            'options'   => [
                'New Deal'    => 'New Deal', 
                'Missing Info'=> 'Missing Info', 
                'Deal Won'    => 'Deal Won', 
                'Deal Lost'   => 'Deal Lost'
            ],
            'orderable' => true,
        ]);
        
        // Filter: ISO
        CRUD::addFilter([
            'name'  => 'iso_id',
            'type'  => 'dropdown',
            'label' => 'ISO'
        ], function () {
            // get ISO options from Iso model; using 'business_name' as the display field.
            return \App\Models\Iso::all()->pluck('business_name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'iso_id', $value);
        });

        // Filter: Sales Stage
        CRUD::addFilter([
            'name'  => 'sales_stage',
            'type'  => 'dropdown',
            'label' => 'Sales Stage'
        ], [
            'New Deal'    => 'New Deal',
            'Missing Info'=> 'Missing Info',
            'Deal Won'    => 'Deal Won',
            'Deal Lost'   => 'Deal Lost'
        ], function ($value) {
            $this->crud->addClause('where', 'sales_stage', $value);
        });

        // Filter: Submission Date
        CRUD::addFilter([
            'type'  => 'date_range',
            'name'  => 'submission_date',
            'label' => 'Submission Date'
        ], false, function ($value) {
            $dates = json_decode($value);
            if ($dates->from && $dates->to) {
                $this->crud->addClause('whereDate', 'submission_date', '>=', $dates->from);
                $this->crud->addClause('whereDate', 'submission_date', '<=', $dates->to);
            }
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DealRequest::class);

        

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}