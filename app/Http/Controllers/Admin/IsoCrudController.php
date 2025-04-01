<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IsoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class IsoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class IsoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Iso::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/iso');
        CRUD::setEntityNameStrings('iso', 'isos');

        CRUD::addField(['name' => 'business_name', 'type' => 'text']);
        CRUD::addField(['name' => 'contact_name', 'type' => 'text']);
        CRUD::addField([
            'name'       => 'contact_number',
            'type'       => 'text',
            'label'      => 'Contact Number',
            'attributes' => [
                'placeholder'   => '(123) 456-7890',
                'data-inputmask'=> "'mask': '(999) 999-9999'"
            ]
        ]);
        CRUD::addField([
            'name'     => 'emails',
            'type'     => 'repeatable',
            'fields'   => [
                [
                    'name'  => 'email',
                    'type'  => 'email',
                    'label' => 'Email'
                ],
            ],
            'new_item_label' => 'Add Email'
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
        CRUD::addColumn([
            'name'  => 'business_name',
            'type'  => 'text',
            'label' => 'Business Name'
        ]);
        CRUD::addColumn([
            'name'  => 'contact_name',
            'type'  => 'text',
            'label' => 'Contact Name'
        ]);
        CRUD::addColumn([
            'name'       => 'contact_number',
            'type'       => 'text',
            'label'      => 'Contact Number',
        ]);
        CRUD::addColumn([
            'name'  => 'emails',
            'label' => 'Emails',
            'type'  => 'closure',
            'function' => function($entry) {
                $emailsArray = json_decode($entry->emails, true);
                if (is_array($emailsArray)) {
                    return implode(', ', array_column($emailsArray, 'email'));
                }
                return '';
            },
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
        CRUD::setValidation(IsoRequest::class);

        

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