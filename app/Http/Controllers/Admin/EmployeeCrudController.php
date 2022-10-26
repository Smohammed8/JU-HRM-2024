<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Http\Requests\EmployeeAddressRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\Demotion;
use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\EmployeeCertificate;
use App\Models\EmployeeContact;
use App\Models\EmployeeEvaluation;
use App\Models\EvaluationCategory;
use App\Models\EvaluationLevel;
use App\Models\TypeOfLeave;
use App\Models\EmployeeFamily;
use App\Models\EmployeeLanguage;
use App\Models\EmploymentStatus;
use App\Models\EmploymentType;
use App\Models\Evaluation;
use App\Models\EvaluationPeriod;
use App\Models\EvalutionCreteria;
use App\Models\Quarter;
use App\Models\ExternalExperience;
use App\Models\FormStyle;
use App\Models\InternalExperience;
use App\Models\JobTitle;
use App\Models\Leave;
use App\Models\License;
use App\Models\LicenseType;
use App\Models\MaritalStatus;
use App\Models\Misconduct;
use App\Models\Promotion;
use App\Models\SalaryIncreament;
use App\Models\TrainingAndStudy;
use App\Models\TypeOfMisconduct;
use App\Models\Unit;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Prologue\Alerts\Facades\Alert;
use \Onkbear\NestedCrud\app\Http\Controllers\Operations\NestedListOperation;
use \Onkbear\NestedCrud\app\Http\Controllers\Operations\NestedCreateOperation;
use \Onkbear\NestedCrud\app\Http\Controllers\Operations\NestedUpdateOperation;
use \Onkbear\NestedCrud\app\Http\Controllers\Operations\NestedDeleteOperation;
/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
{
    use \Backpack\ReviseOperation\ReviseOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    } //IMPORTANT HERE
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()


    {
        CRUD::setModel(\App\Models\Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings('employee', 'employees');
        $this->crud->setShowView('employee.show');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

    //  if (!Auth::user()->isAdmin) {
    //     $this->crud->denyAccess('delete');
    //        // CRUD::column('user')->label('Customer');
    //     }
 //$this->crud->addShowColumn(); // add one column, at the end of the stack
// $this->crud->addShowColumns(); // add multiple columns, at the end of the stack
// $this->crud->removeShowColumn('column_name'); // remove a column from the stack
// $this->crud->removeShowColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
// $this->crud->setShowColumnDetails('column_name', ['attribute' => 'value']);
// $this->crud->setShowColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);



        // CRUD::column('first_name');
        // CRUD::column('father_name');
        // CRUD::column('grand_father_name');
        CRUD::column('name')->type('closure')->function(function ($entry) {
            return $entry->first_name . ' ' . $entry->father_name . ' ' . $entry->grand_father_name;
        });
        // CRUD::column('first_name')->label('Name');

        // CRUD::column('gender');
        // CRUD::column('date_of_birth');
        // CRUD::column('photo');
        // CRUD::column('birth_city');
        // CRUD::column('passport');
        // CRUD::column('driving_licence');
        // CRUD::column('blood_group');
        // CRUD::column('eye_color');
        // CRUD::column('phone_number');
        // CRUD::column('alternate_email');
        // CRUD::column('rfid');
        CRUD::column('employment_identity')->label('Employee ID Number');
        // CRUD::column('marital_status_id');
        // CRUD::column('ethnicity_id');
        // CRUD::column('religion_id');
        // CRUD::column('unit_id');
        CRUD::column('employement_date')->type('date');
        // CRUD::column('salary_step');
        CRUD::column('job_title_id')->type('select')->entity('jobTitle')->model(JobTitle::class)->attribute('name')->size(4);
        // CRUD::column('employment_type_id');
        // CRUD::column('pention_number');
        // CRUD::column('employment_status_id');
        // CRUD::column('static_salary');
        // CRUD::column('uas_user_id');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */

        // $this->crud->denyAccess('delete');

        $this->crud->addFilter(
            [
                'type'  => 'date_range',
                'name'  => 'employement_date ',
                'label' => 'By hire date '
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', ' employement_date ', '>=', $dates->from);
                $this->crud->addClause('where', ' employement_date ', '<=', $dates->to . ' 23:59:59');
            }
        );


        $this->crud->addFilter([
            'name'  => 'unit_id',
            'type'  => 'select2_multiple',
            'label' => 'Filter by office'

        ], function () {
            return \App\Models\Unit::all()->pluck('name', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'unit_id', json_decode($values));
        });


        $this->crud->addFilter([
            'name'  => 'employment_type_id',
            'type'  => 'select2_multiple',
            'label' => 'Filter by type'

        ], function () {
            return \App\Models\EmploymentType::all()->pluck('name', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'employment_type_id', json_decode($values));
        });

        $this->crud->addFilter([
            'name'  => 'job_title_id',
            'type'  => 'select2_multiple',
            'label' => 'By job title'

        ], function () {
            return \App\Models\JobTitle::all()->pluck('name', 'id')->toArray();
        }, function ($values) {
            $this->crud->addClause('whereIn', 'job_title_id', json_decode($values));
        });
        $this->crud->addFilter(
            [
                'name'       => 'static_salary ',
                'type'       => 'range',
                'label'      => 'By Gross salary',
                'label_from' => 'min value',
                'label_to'   => 'max value',
                'size' => 5
            ],
            false,
            function ($value) { // if the filter is active
                $range = json_decode($value);
                if ($range->from) {
                    $this->crud->addClause('where', 'static_salary ', '>=', (float) $range->from);
                }
                if ($range->to) {
                    $this->crud->addClause('where', 'static_salary ', '<=', (float) $range->to);
                }
            }
        );


        // $this->crud->addFilter([
        //     'name'  => 'problem_id',
        //     'type'  => 'select2_multiple',
        //     'label' => 'Filter by client request'

        // ], function() {
        //     return \App\Models\Problem::all()->pluck('name', 'id')->toArray();
        // }, function($values) {
        //     $this->crud->addClause('whereIn', 'problem_id', json_decode($values));
        // });
    }




    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeRequest::class);
        $this->crud->setCreateContentClass('col-md-12');
        CRUD::field('photo')->size(4)->type('image')->aspect_ratio(1)->crop(true)->upload(true);
        CRUD::field('first_name')->size(4);
        CRUD::field('father_name')->size(4);
        CRUD::field('grand_father_name')->size(4);
        CRUD::field('gender')->type('enum')->size(4);
        CRUD::field('date_of_birth')->size(4);
        CRUD::field('birth_city')->size(4);
        // CRUD::field('passport')->size(4);
        CRUD::field('driving_licence')->size(4)->type('upload')->upload(true);
        CRUD::field('blood_group')->type('enum')->size(4);
        CRUD::field('eye_color')->type('enum')->size(4);
        CRUD::field('phone_number')->size(4);
        CRUD::field('alternate_email')->type('email')->size(4);
        // CRUD::field('rfid')->size(4);
        CRUD::field('employment_identity')->label('Employee ID Number')->size(4);
        CRUD::field('marital_status_id')->type('select2')->entity('maritalStatus')->model(MaritalStatus::class)->attribute('name')->size(4);
        CRUD::field('ethnicity_id')->size(4);
        CRUD::field('religion_id')->size(4);
        CRUD::field('unit_id')->size(4);
        CRUD::field('employement_date')->size(4);
        CRUD::field('salary_step')->type('enum')->size(4);
        CRUD::field('job_title_id')->type('select')->entity('jobTitle')->model(JobTitle::class)->attribute('name')->size(4);
        CRUD::field('employment_type_id')->type('select')->entity('employmentType')->model(EmploymentType::class)->attribute('name')->size(4);
        // CRUD::field('pention_number')->size(4);
        CRUD::field('employment_status_id')->type('select')->entity('employmentStatus')->model(EmploymentStatus::class)->attribute('name')->size(4);
        CRUD::field('static_salary')->type('number')->size(4);
        // CRUD::field('uas_user_id')->size(4);


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

        // dd($this->crud->getCurrentEntry());
        $tabName = 'Personal Information';
        // $this->setupCreateOperation();
        $this->crud->setUpdateContentClass('col-md-12');
        CRUD::setValidation(EmployeeRequest::class);
        CRUD::field('photo')->size(4)->tab($tabName)->type('image')->aspect_ratio(1)->crop(true)->upload(true);
        $this->crud->setCreateContentClass('col-md-12');
        CRUD::field('first_name')->tab($tabName)->size(3);
        CRUD::field('father_name')->tab($tabName)->size(3);
        CRUD::field('grand_father_name')->tab($tabName)->size(3);
        CRUD::field('gender')->type('enum')->tab($tabName)->size(3);
        CRUD::field('date_of_birth')->tab($tabName)->size(3);
        CRUD::field('birth_city')->tab($tabName)->size(3);
        CRUD::field('employment_identity')->tab($tabName)->label('Employee ID Number')->size(3);
        CRUD::field('marital_status_id')->tab($tabName)->type('select')->entity('maritalStatus')->model(MaritalStatus::class)->attribute('name')->tab($tabName)->size(3);
        CRUD::field('phone_number')->tab($tabName)->size(3);
        CRUD::field('ethnicity_id')->tab($tabName)->size(3);
        CRUD::field('eye_color')->tab($tabName)->type('enum')->size(3);
        CRUD::field('religion_id')->tab($tabName)->size(3);
        CRUD::field('blood_group')->tab($tabName)->type('enum')->size(3);
        CRUD::field('alternate_email')->tab($tabName)->type('email')->size(3);
        CRUD::field('driving_licence')->tab($tabName)->size(12)->type('upload')->prefix('storage/')->upload(true);

        $tabName = 'Employee Job';
        CRUD::field('job_title_id')->tab($tabName)->type('select')->entity('jobTitle')->model(JobTitle::class)->attribute('name')->size(3);
        CRUD::field('unit_id')->tab($tabName)->size(3);
        CRUD::field('employement_date')->tab($tabName)->size(3);
        CRUD::field('employment_type_id')->tab($tabName)->type('select')->entity('employmentType')->model(EmploymentType::class)->attribute('name')->size(3);
        CRUD::field('static_salary')->tab($tabName)->size(3);
        CRUD::field('salary_step')->tab($tabName)->type('enum')->size(3);
        CRUD::field('pention_number')->tab($tabName)->size(3);
        CRUD::field('employment_status_id')->tab($tabName)->type('select')->entity('employmentStatus')->model(EmploymentStatus::class)->attribute('name')->tab($tabName)->size(3);
        $tabName = 'Employee Address';


        // CRUD::field('employeeAddresses')
        // ->type('repeatable')
        // ->label('Employee Address')
        // ->fields([
        //     [
        //         'name'    => 'id',
        //         'type'    => 'hidden',
        //     ],
        //     [
        //         'name'    => 'address_type',
        //         'type'    => 'select_from_array',
        //         'options'     => ['Home' => 'Home', 'Work' => 'Work','Other'=>'Other'],
        //     ],
        //     [
        //         'name'    => 'name',
        //         'type'    => 'text',
        //     ],
        // ])->tab($tabName);
        // $tabName = 'Employee Licenses';
        // CRUD::field('employeeAddresses')
        // ->type('repeatable')
        // ->label('Employee Licenses')
        // ->fields([
        //     [
        //         'name'    => 'id',
        //         'type'    => 'hidden',
        //     ],
        //     [
        //         'name'    => 'license_type_id',
        //         'type'    => 'select_from_array',
        //         'options'=> LicenseType::get()->pluck('name','id')->toArray()
        //     ],
        //     [
        //         'name'    => 'upload_file_id',
        //         'type'    => 'upload',
        //     ],
        // ])->tab($tabName);
        // dd($this->crud->getCurrentEntry());
        // $this->crud->addColumn([ 'name' => 'externalExperiences.company_name','tab'=>$tabName]);
        // CRUD::field('passport')->tab($tabName)->size(3);
        // CRUD::field('rfid')->tab($tabName)->size(3);
        // CRUD::field('uas_user_id')->tab($tabName)->size(3);
    }




    public function update()
    {
        $items = collect(json_decode(request('employeeAddresses'), true));
        // $employeeAddressRequest = new EmployeeAddressRequest();
        // $employeeAddressRules = $employeeAddressRequest->rules();
        $response = $this->traitUpdate();

        $employee_id = $this->crud->entry->id;
        $created_ids = [];

        $items->each(function ($item, $key) use ($employee_id, &$created_ids) {
            $item['employee_id'] = $employee_id;
            if ($item['id']) {
                $comment = EmployeeAddress::find($item['id']);
                $comment->update($item);
            } else {
                $created_ids[] = EmployeeAddress::create($item)->id;
            }
        });

        // delete removed Comments
        $related_items_in_request = collect(array_merge($items->where('id', '!=', '')->pluck('id')->toArray(), $created_ids));
        $related_items_in_db = $this->crud->entry->addresses;

        $related_items_in_db?->each(function ($item, $key) use ($related_items_in_request) {
            if (!$related_items_in_request->contains($item['id'])) {
                $item->delete();
            }
        });

        return $response;
    }

    protected function setupShowOperation()
    {
        $licenses = License::where('employee_id', $this->crud->getCurrentEntryId())->paginate(10);
        $this->data['employeeLicenses'] = $licenses;
        $employeeAddresses = EmployeeAddress::where('employee_id', $this->crud->getCurrentEntryId())->paginate(10);
        $this->data['employeeAddresses'] = $employeeAddresses;
        $employeeCertificates = EmployeeCertificate::orderBy('id', 'desc')->Paginate(10);
        $this->data['employeeCertificates'] = $employeeCertificates;
        $employeeContacts = EmployeeContact::orderBy('id', 'desc')->Paginate(10);
        $this->data['employeeContacts'] = $employeeContacts;
        $employeeLanguages = EmployeeLanguage::orderBy('id', 'desc')->Paginate(10);
        $this->data['employeeLanguages'] = $employeeLanguages;
        $employeeFamilies = EmployeeFamily::orderBy('id', 'desc')->Paginate(10);
        $this->data['employeeFamilies'] = $employeeFamilies;
        $internalExperiences = InternalExperience::orderBy('id', 'desc')->Paginate(10);
        $this->data['internalExperiences'] = $internalExperiences;
        $externalExperiences = ExternalExperience::orderBy('id', 'desc')->Paginate(10);
        $this->data['externalExperiences'] = $externalExperiences;
        $trainingAndStudies = TrainingAndStudy::orderBy('id', 'desc')->Paginate(10);
        $this->data['trainingAndStudies'] = $trainingAndStudies;



        $evalutionCreterias=  EvalutionCreteria::orderBy('id', 'desc')->Paginate(10);
        $this->data['evalutionCreterias'] = $evalutionCreterias;


        $evaluation_levels=  EvaluationLevel::orderBy('id', 'desc')->Paginate(10);
        $this->data['evaluation_levels'] = $evaluation_levels;


        $leaves =  Leave::orderBy('id', 'desc')->Paginate(1);
        $this->data['leaves'] = $leaves;

        $type_of_leaves =    TypeOfLeave::orderBy('id', 'desc')->Paginate(10);
        $this->data['type_of_leaves'] = $type_of_leaves;
        $this->data['employee.leave'] = $type_of_leaves;

        $misconducts =    Misconduct::orderBy('id', 'desc')->Paginate(10);
        $this->data['misconducts'] = $misconducts;

        $demotions =    Demotion::orderBy('id', 'desc')->Paginate(10);
        $this->data['demotions'] = $demotions;

        $promotions =    Promotion::orderBy('id', 'desc')->Paginate(10);
        $this->data['promotions'] = $promotions;

        $demotions =    Demotion::orderBy('id', 'desc')->Paginate(10);
        $this->data['demotions'] = $demotions;

        $type_of_misconducts =    TypeOfMisconduct::orderBy('id', 'desc')->Paginate(10);
        $this->data['type_of_misconducts'] = $type_of_misconducts;

        $jobe_titles =    JobTitle::orderBy('id', 'desc')->Paginate(10);
        $this->data['jobe_titles'] = $jobe_titles;

        $units =    Unit::orderBy('id', 'desc')->Paginate(10);
        $this->data['units'] = $units;
        $quarters =    Quarter::orderBy('id', 'desc')->Paginate(4);
        $this->data['quarters'] = $quarters;


        $employeeEvaluations= EmployeeEvaluation::orderBy('id', 'desc')->Paginate(10);
        $this->data['employeeEvaluations'] = $employeeEvaluations;

        $evaluations = Evaluation::orderBy('id', 'desc')->Paginate(4);
        $this->data['evaluations'] = $evaluations;

        $si = SalaryIncreament::select('percentage')->get()->first()->percentage ?? 0;
        $this->data['si'] = $si;

        $style = FormStyle::select('name')->get()->first()->name ?? null;
        $this->data['style'] = $style;

        $ep = EvaluationPeriod::select('name')->get()->first()->name ?? null;
        $this->data['ep'] = $ep;

        $ep = EvaluationPeriod::select('name')->get()->first()->name ?? null;
        $this->data['ep'] = $ep;


        // $evs = Evaluation::where('employee_id',$this->crud->getCurrentEntryId())->limit(3)->get();
        // $evaluations = Evaluation::orderBy('id', 'desc')->limit(3)->get();
        // $this->data['evs'] = $evs;





        // Note: if you HAVEN'T set show.setFromDb to false, the removeColumn() calls won't work
        // because setFromDb() is called AFTER setupShowOperation(); we know this is not intuitive at all
        // and we plan to change behaviour in the next version; see this Github issue for more details
        // https://github.com/Laravel-Backpack/CRUD/issues/3108
    }
}
