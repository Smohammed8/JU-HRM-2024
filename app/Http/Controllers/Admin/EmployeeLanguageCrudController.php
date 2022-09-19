<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeLanguageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeLanguageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeLanguageCrudController extends CrudController
{
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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
        CRUD::setModel(\App\Models\EmployeeLanguage::class);
        $employeeId = \Route::current()->parameter('employee');

        CRUD::setRoute(config('backpack.base.route_prefix') . '/'.$employeeId. '/employee-language');
        CRUD::setEntityNameStrings('employee language', 'employee languages');
    }

    // /**
    //  * Define what happens when the List operation is loaded.
    //  *
    //  * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
    //  * @return void
    //  */
    // protected function setupListOperation()
    // {
    //     CRUD::column('employee_id');
    //     CRUD::column('language_id');
    //     CRUD::column('speaking');
    //     CRUD::column('reading');
    //     CRUD::column('writing');
    //     CRUD::column('comment');

    //     /**
    //      * Columns can be defined using the fluent syntax or array syntax:
    //      * - CRUD::column('price')->type('number');
    //      * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
    //      */
    // }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $employeeId = \Route::current()->parameter('employee');
        $this->data['breadcrumbs']=[
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Employees' => route('employee.index'),
            'Preview' => route('employee.show',['id'=>$employeeId]),
            'Employee Address' => false,
        ];
        CRUD::setValidation(EmployeeLanguageRequest::class);

        CRUD::field('employee_id')->type('hidden')->value($employeeId);

        CRUD::field('language_id');
        CRUD::field('speaking')->type('enum');
        CRUD::field('reading')->type('enum');
        CRUD::field('writing')->type('enum');
        CRUD::field('comment');

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
