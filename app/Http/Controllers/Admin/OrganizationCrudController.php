<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrganizationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrganizationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrganizationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Organization::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/organization');
        CRUD::setEntityNameStrings('organization', 'organizations');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

       //  $this->crud->denyAccess('delete');
         $this->crud->addButtonFromModelFunction('line', 'open_google', 'viewStructure', 'end');


        // $this->crud->addButtonFromView('line', 'moderate', 'moderate', 'beginning');

        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('mission');
        CRUD::column('vision');
        CRUD::column('motto');
        CRUD::column('logo');
        CRUD::column('web_address');
        CRUD::column('fax');
        CRUD::column('telephone');
        CRUD::column('pobox');
        CRUD::column('seal');
        CRUD::column('president_signature');
        CRUD::column('account_number');
        CRUD::column('header');
        CRUD::column('footer');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrganizationRequest::class);

        CRUD::field('name')->size(4);
        CRUD::field('email')->size(4);
        CRUD::field('mission')->size(4);
        CRUD::field('vision')->size(4);
        CRUD::field('motto')->size(4);
        CRUD::field('logo')->size(4);
        CRUD::field('web_address')->size(4);
        CRUD::field('fax')->size(4);
        CRUD::field('telephone')->size(4);
        CRUD::field('pobox')->size(4);
        CRUD::field('seal')->size(4);
        CRUD::field('president_signature')->size(4);
        CRUD::field('account_number')->size(4);
        CRUD::field('header')->size(4);
        CRUD::field('footer')->size(4);

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
