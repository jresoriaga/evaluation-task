<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SicRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SicCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Sic::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sic');
        CRUD::setEntityNameStrings('sic', 'sics');

        CRUD::addField(['name' => 'code', 'type' => 'number']);
        CRUD::addField(['name' => 'description', 'type' => 'text']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name'              => 'code',
            'type'              => 'closure',
            'label'             => 'Code',
            'function' => function($entry) {
            return $entry->code;
        },
        ]);
        
        CRUD::addColumn([
            'name'  => 'description',
            'type'  => 'text',
            'label' => 'Description'
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::set('show.setFromDb', false);

        CRUD::addColumn([
            'name'    => 'code',
            'type'    => 'closure',
            'label'   => 'Code',
            'function' => function($entry) {
                return number_format($entry->code, 0, '', '');
            },
        ]);
    
        CRUD::addColumn([
            'name'  => 'description',
            'type'  => 'text',
            'label' => 'Description'
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SicRequest::class);

        

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