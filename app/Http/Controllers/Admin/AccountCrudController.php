<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AccountRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AccountCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AccountCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Account::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/account');
        CRUD::setEntityNameStrings('account', 'accounts');

        CRUD::addField(['name' => 'business_name', 'type' => 'text']);
        CRUD::addField([
            'name'     => 'sic_id',
            'type'     => 'select2',
            'entity'   => 'sic',
            'model'    => 'App\Models\Sic',
            'attribute'=> 'description',
            'label'    => 'Industry'
        ]);

        CRUD::addField([
            'name'   => 'owners',
            'type'   => 'repeatable',
            'fields' => [
                [
                    'name'  => 'owner_name',
                    'type'  => 'text',
                    'label' => 'Owner Name'
                ],
                [
                    'name'  => 'title',
                    'type'  => 'text',
                    'label' => 'Title'
                ],
                [
                    'name'  => 'email',
                    'type'  => 'email',
                    'label' => 'Email'
                ],
                [
                    'name'  => 'dob',
                    'type'  => 'date_picker',
                    'label' => 'Date of Birth'
                ]
            ],
            'new_item_label' => 'Add Owner'
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
            'name'    => 'business_name',
            'type'    => 'text',
            'label'   => 'Business Name',
        ]);
    
        CRUD::addColumn([
            'name'  => 'sic_id',
            'type'  => 'select',
            'label' => 'Industry',
            'entity'=> 'sic',
            'attribute' => 'description',
            'model' => 'App\Models\Sic',
        ]);
    
        CRUD::addColumn([
            'name'    => 'owners',
            'label'   => 'Owners',
            'type'    => 'closure',
            'function'=> function($entry) {
                $owners = is_array($entry->owners) ? $entry->owners : json_decode($entry->owners, true);
                if(empty($owners)) {
                    return 'N/A';
                }
                $output = '<ul style="margin:0; padding-left:20px;">';
                foreach ($owners as $owner) {
                    $output .= '<li>' . $owner['owner_name'] . ' (' . $owner['title'] . ' - ' . $owner['email'] . ')</li>';
                }
                $output .= '</ul>';
                return $output;
            },
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::set('show.setFromDb', false);

        CRUD::addColumn([
            'name'  => 'business_name',
            'type'  => 'text',
            'label' => 'Business Name',
        ]);

        CRUD::addColumn([
            'name'      => 'sic_id',
            'type'      => 'select',
            'entity'    => 'sic',
            'attribute' => 'description',
            'model'     => 'App\Models\Sic',
            'label'     => 'Industry',
        ]);

        CRUD::addColumn([
            'name'    => 'owners',
            'label'   => 'Owners',
            'type'    => 'closure',
            'function'=> function($entry) {
                $owners = is_array($entry->owners) ? $entry->owners : json_decode($entry->owners, true);
                if(empty($owners)) {
                    return 'N/A';
                }
                $output = '<ul style="margin:0; padding-left:20px;">';
                foreach ($owners as $owner) {
                    $output .= '<li>' . $owner['owner_name'] . ' (' . $owner['title'] . ' - ' . $owner['email'] . ')</li>';
                }
                $output .= '</ul>';
                return $output;
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
        CRUD::setValidation(AccountRequest::class);

        

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