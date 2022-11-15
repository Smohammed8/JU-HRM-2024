@extends(backpack_view('blank'))

@php
$defaultBreadcrumbs = [
trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
$crud->entity_name_plural => url($crud->route),
trans('backpack::crud.preview') => false,
];

// if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
$breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

<link href="{{ asset('assets/dist/bootstrap4-modal-fullscreen.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dist/bootstrap4-modal-fullscreen.min.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/calendar/css/redmond.calendars.picker.css')}}" />


@section('header')
<section class="container-fluid d-print-none">

    @if($ep !=null)
    @if($ep =='On')
    <button type="button" data-toggle="modal" data-target="#efficiency" target="_top"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la  la-balance-scale"></i> Efficiency
    </button>
    @else
    -
    @endif

    @else
    <button type="button" data-toggle="modal" data-target="#" target="_top"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la  la-balance-scale"></i><del> Efficiency
        </del> </button>
    @endif
    <button type="button" data-toggle="modal" data-target="#employee_leave" target="_top"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la la-user-minus"></i> Leave</button>
    <button type="button" data-toggle="modal" data-target="#back" target="_top"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la la-user-plus"></i> Attendance </button>
    <button type="button" data-toggle="modal" data-target="#decipline" target="_top"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la la-exclamation-circle"></i>
        Discipline</button>
    <button type="button" data-toggle="modal" data-target="#promotion" target="_self"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la la-arrow-up"></i> Promotion</button>
    <button type="button" data-toggle="modal" data-target="#demotion" target="_self"
        class="btn  btn-sm btn-outline-primary float-right mr-1"><i class="la la-arrow-down"></i> Demotion</button>
    {{-- <a href="javascript: window.print();" class="btn  btn-sm btn-outline-primary float-right"><i
            class="la la-print"></i></a> --}}

    <h2>
        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
        <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name
            !!}.</small>
        @if ($crud->hasAccess('list'))
        <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i class="la la-angle-double-left"></i> {{
                trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
        @endif
    </h2>
</section>
@endsection

@section('content')




<div class="row">
    <div class="card col-md-12 mb-2" style="border-radius:1%; border-top-color: blue !important; border-top-width:2px;">
        <!-- //////////////////////////////////////////// -->



        <!-- //////////////////////////////////////////////-->

        <div class="card-body">
            <div class="row">
                <div class="col-md-2" style="border-right:1px solid black;">

                    <img src="{{ $crud->entry?->photo}}" alt="profile Pic" height="160" width="150">
                    {{-- @if(isset( ))

                    @else
                    <img width="150" src="{{ $crud->entry?->photo }}" alt="">

                    @endif --}}

                </div>
                <div class="col-md-9">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Employee Name : </b> </label>
                                <label for="">{{ $crud->entry?->name }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Employee Gender : </b></label>
                                <label for="">{{ $crud->entry?->gender }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Phone Number : </b></label>
                                <label for="">{{ $crud->entry?->phone_number }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Ethnicity : </b></label>
                                <label for="">{{ $crud->entry?->ethnicity?->name }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Religion : </b></label>
                                <label for="">{{ $crud->entry?->religion?->name }}</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <label for=""><b>Last Efficinecy : </b></label>
                                <label for="">{{ '-'}}</label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <label for=""><b> Misconduct records : </b></label>
                                <label for=""> {{ '0' }} </label>
                            </div>

                        </div>


                        <div class="col-md-6" style="border-left:1px solid black;">
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Blood group : </b> </label>
                                <label for="">{{ $crud->entry?->blood_group }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Alternate email : </b></label>
                                <label for="">{{ $crud->entry?->alternate_email }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Age : </b></label>
                                <label for="">{{ 20 }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Marital status : </b></label>
                                <label for="">{{ $crud->entry?->maritalStatus?->name }}</label>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for=""><b>Employee ID Number : </b></label>
                                <label for="">{{ $crud->entry?->employment_identity }}</label>
                            </div>


                            <div class="d-flex justify-content-between">
                                <label for=""><b> Gross Salary : </b></label>
                                <label for=""> ETB {{ number_format($crud->entry?->static_salary,2) }}</label>
                            </div>


                            <div class="d-flex justify-content-between">
                                <label for=""><b> Employee status : </b></label>
                                <label for=""> {{ 'On annual leave' }}- {{ '07 days left' }} </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

</div>



<div class="tab-container mb-2 row">
    <div class="nav-tabs-custom p-0 d-flex  col-md-12" id="form_tabs">
        <div class="col-md-3  p-0 m-0">
            <ul class="nav nav-tabs nav-stacked flex-column " role="tablist">
                {{-- <li role="presentation" class="nav-item">
                    <a href="#tab_employee_job" aria-controls="tab_employee_education" role="tab" tab_name="employee_education"
                        data-toggle="tab" class="nav-link active"> <i class="la la la-suitcase" style="font-size: 20px">
                        </i> &nbsp; {{ 'Employee Education' }}</a>
                </li> --}}

                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_education" aria-controls="" role="tab" tab_name="tab_employee_education" data-toggle="tab" class="nav-link active">
                        <i class="la la la-mortar-board" style="font-size: 20px;"> </i>&nbsp; {{ 'Education' }}</a>
                </li>

                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_skill" aria-controls="tab_employee_skill" role="tab" tab_name="tab_employee_skill" data-toggle="tab"
                        class="nav-link "> <i class="la la-empire" style="font-size: 20px;"> </i>&nbsp; {{ 'Skill'
                        }}</a>
                </li>


                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_address" aria-controls="tab_employee_address" role="tab"
                        tab_name="employee_address" data-toggle="tab" class="nav-link "> <i class="la la-envelope-o"
                            style="font-size: 20px"> </i>&nbsp; {{ ' Address' }}</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_licence" aria-controls="tab_employee_licence" role="tab"
                        tab_name="employee_licence" data-toggle="tab" class="nav-link "> <i class="la la-gavel"
                            style="font-size: 20px"> </i> {{ 'Licenses' }}</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_certificate" aria-controls="tab_employee_certificate" role="tab"
                        tab_name="employee_certificate" data-toggle="tab" class="nav-link "> <i class="la la-book"
                            style="font-size: 20px"> </i>{{ 'Certification' }}</a>
                </li>

                <li role="presentation" class="nav-item">
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_language" aria-controls="tab_employee_language" role="tab"
                        tab_name="employee_language" data-toggle="tab" class="nav-link "> <i class="la la-globe"
                            style="font-size: 20px"> </i> {{ 'Language' }}</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_family" aria-controls="tab_employee_family" role="tab"
                        tab_name="employee_family" data-toggle="tab" class="nav-link "> <i class="la la-users"
                            style="font-size: 20px"> </i> {{ 'Families' }}</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_internal_experience" aria-controls="tab_employee_internal_experience"
                        role="tab" tab_name="employee_internal_experience" data-toggle="tab" class="nav-link "> <i
                            class="la la-map" style="font-size: 20px"> </i> {{ 'Internal Experience' }}</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_employee_external_experience" aria-controls="tab_employee_external_experience"
                        role="tab" tab_name="employee_external_experience" data-toggle="tab" class="nav-link "> <i
                            class="la la-flag" style="font-size: 20px"> </i> {{ 'External Experience' }}</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tab_training_and_experience" aria-controls="tab_training_and_experience" role="tab"
                        tab_name="training_and_experience" data-toggle="tab" class="nav-link "> <i
                            class="la la la-check-circle " style="font-size: 20px"> </i> {{ 'Training and Studies'
                        }}</a>
                </li>

                <li role="presentation" class="nav-item">
                    <a href="#" aria-controls="" role="tab" tab_name="" data-toggle="tab" class="nav-link "> <i class="la
                        la la-university" style="font-size: 20px"> </i> {{ 'Memebership' }}</a>
                </li>
            </ul>
        </div>



        <div class="tab-content box m-0 col-md-9 p-0 v-pills-tabContent">
{{--
            <div role="tabpanel" class="tab-pane active" id="tab_employee_job">
                <h3>Employee Job</h3>
                <form action="">
                    <div class="row">
                        <div class="form-group col-md-6" element="div">
                            <label for="">Employement Date</label>
                            <input type="date" name="employement_date" class="form-control">
                        </div>
                        <div class="form-group col-md-6" element="div">

                        </div>
                        <div class="form-group col-md-6" element="div">

                        </div>
                        <div class="form-group col-md-6" element="div">

                        </div>
                    </div>
                </form>
            </div> --}}

            <div role="tabpanel" class="tab-pane active" id="tab_employee_education">
                <h3>Employee Education</h3>
                <div class="no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/skill.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Skill'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Skill Type</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeSkills as $employeeSkill)
                            <tr>
                                <td>{{ $employeeSkill?->skillType?->name }}</td>
                                <td>{{ $employeeSkill->name }}</td>
                                <td>{{ $employeeSkill->level }}</td>
                                <td>
                                    <a href="{{ route('{employee}/skill.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeSkill->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/skill.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeSkill->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeSkills)==0)
                            <tr>
                                <td colspan="3" class="text-center">No Employee Address</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeSkills->links() }}
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_employee_skill">
                <h3>Employee Skill</h3>
                <div class="no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/skill.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Skill'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Skill Type</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeSkills as $employeeSkill)
                            <tr>
                                <td>{{ $employeeSkill?->skillType?->name }}</td>
                                <td>{{ $employeeSkill->name }}</td>
                                <td>{{ $employeeSkill->level }}</td>
                                <td>
                                    <a href="{{ route('{employee}/skill.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeSkill->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/skill.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeSkill->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeSkills)==0)
                            <tr>
                                <td colspan="3" class="text-center">No Employee Address</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeSkills->links() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_employee_address">
                <h5>Employee Address</h5>
                <div class="no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/employee-address.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Address'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeAddresses as $employeeAddress)
                            <tr>
                                <td>{{ $employeeAddress->name }}</td>
                                <td>{{ $employeeAddress->address_type }}</td>
                                <td>
                                    <a href="{{ route('{employee}/employee-address.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeAddress->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/employee-address.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeAddress->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeAddresses)==0)
                            <tr>
                                <td colspan="3" class="text-center">No Employee Address</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeAddresses->links() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_employee_licence">
                <h5>Employee Licence</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/license.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Licence'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Licence Type</th>
                                <th>Downloadable File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeLicenses as $employeeLicence)
                            <tr>
                                <td>{{ $employeeLicence->licenseType->name }}</td>
                                <td><a href="{{ $employeeLicence->license_file }}" target="_blank">Download Document</a>
                                </td>
                                <td>
                                    <a href="{{ route('{employee}/license.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeLicence->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/license.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeLicence->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeLicenses)==0)
                            <tr>
                                <td colspan="3" class="text-center">No Employee Licence</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeLicenses->links() }}
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_employee_certificate">
                <h5>Employee Certificate</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/employee-certificate.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Certificate'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Skill Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeCertificates as $employeeCertificate)
                            <tr>
                                <td>{{ $employeeCertificate->name }}</td>
                                <td>{{ $employeeCertificate->skillType->name }}</td>
                                <td>
                                    <a href="{{ route('{employee}/employee-certificate.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeCertificate->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/employee-certificate.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeCertificate->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeCertificates)==0)
                            <tr>
                                <td colspan="4" class="text-center">No Employee Licence</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeCertificates->links() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_employee_contact">
                <h5>Employee Contact</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/employee-contact.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Contact'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Contact Name</th>
                                <th>Contact Type</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeContacts as $employeeContact)
                            <tr>
                                <td>{{ $employeeContact->contact_name }}</td>
                                <td>{{ $employeeContact->contact_type }}</td>
                                <td>{{ $employeeContact->contact }}</td>
                                <td>
                                    <a href="{{ route('{employee}/employee-contact.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeContact->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/employee-contact.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeContact->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeContacts)==0)
                            <tr>
                                <td colspan="3" class="text-center">No Employee Contact</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeContacts->links() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_employee_language">
                <h5>Employee Languages</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/employee-language.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Langauge'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Langauge</th>
                                <th>Speaking</th>
                                <th>Reading</th>
                                <th>Writing</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeLanguages as $employeeLanguage)
                            <tr>
                                <td>{{ $employeeLanguage->language->name }}</td>
                                <td>{{ $employeeLanguage->speaking }}</td>
                                <td>{{ $employeeLanguage->reading }}</td>
                                <td>{{ $employeeLanguage->writing }}</td>
                                <td>
                                    <a href="{{ route('{employee}/employee-language.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeLanguage->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/employee-language.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeLanguage->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeLanguages)==0)
                            <tr>
                                <td colspan="5" class="text-center">No Employee Language</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeLanguages->links() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_employee_family">
                <h5>Employee Families</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/employee-family.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee
                                Family'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Family Name</th>
                                <th>Family Relation</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeFamilies as $employeeFamily)
                            <tr>
                                <td>{{ $employeeFamily->name }}</td>
                                <td>{{ $employeeFamily->familyRelationship->name }}</td>
                                <td>{{ $employeeFamily->gender }}</td>
                                <td>{{ $employeeFamily->dob??'Not Specified' }}</td>
                                <td>
                                    <a href="{{ route('{employee}/employee-family.edit', ['employee'=>$crud->entry?->id,'id'=>$employeeFamily->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/employee-family.destroy', ['employee'=>$crud->entry?->id,'id'=>$employeeFamily->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($employeeFamilies)==0)
                            <tr>
                                <td colspan="5" class="text-center">No Employee Family</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $employeeFamilies->links() }}
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_employee_internal_experience">
                <h5>Employee Internal Experience</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/internal-experience.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee Internal
                                Experience'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Job Title</th>
                                <th>Position</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internalExperiences as $internalExperience)
                            <tr>
                                <td>{{ $internalExperience->unit->name }}</td>
                                <td>{{ $internalExperience->jobTitle->name }}</td>
                                <td>{{ $internalExperience->position }}</td>
                                <td>{{ $internalExperience->start_date->format('Y/m/d') }}</td>
                                <td>{{ $internalExperience->end_date->format('Y/m/d') }}</td>
                                <td>
                                    <a href="{{ route('{employee}/internal-experience.edit', ['employee'=>$crud->entry?->id,'id'=>$internalExperience->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/internal-experience.destroy', ['employee'=>$crud->entry?->id,'id'=>$internalExperience->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($internalExperiences)==0)
                            <tr>
                                <td colspan="6" class="text-center">No Internal Experience</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $internalExperiences->links() }}
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_employee_external_experience">
                <h5>Employee External Experience</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/external-experience.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Employee External
                                Experience'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Unit</th>
                                <th>Job Title</th>
                                <th>Position</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($externalExperiences as $externalExperience)
                            <tr>
                                <td>{{ $externalExperience->unit->name }}</td>
                                <td>{{ $externalExperience->job_title }}</td>
                                <td>{{ $externalExperience->position }}</td>
                                <td>{{ $externalExperience->start_date->format('Y/m/d') }}</td>
                                <td>{{ $externalExperience->end_date->format('Y/m/d') }}</td>
                                <td>
                                    <a href="{{ route('{employee}/external-experience.edit', ['employee'=>$crud->entry?->id,'id'=>$externalExperience->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/external-experience.destroy', ['employee'=>$crud->entry?->id,'id'=>$externalExperience->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($externalExperiences)==0)
                            <tr>
                                <td colspan="7" class="text-center">No External Experience</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $externalExperiences->links() }}
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tab_training_and_experience">
                <h5>Training and Studies</h5>
                <div class=" no-padding no-border">
                    <div class="">
                        <a href="{{ route('{employee}/training-and-study.create',['employee'=>$crud->entry?->id]) }}"
                            class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i
                                    class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ 'Training and
                                Studies'}}</span></a>
                    </div>
                    <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Education Level</th>
                                <th>Country</th>
                                <th>Inistitution</th>
                                <th>City</th>
                                <th>Leave date</th>
                                <th>Study End</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainingAndStudies as $trainingAndStudy)
                            <tr>
                                <td>{{ $trainingAndStudy->name }}</td>
                                <td>{{ $trainingAndStudy->educationalLevel->name }}</td>
                                <td>{{ $trainingAndStudy->nationality->label }}</td>
                                <td>{{ $trainingAndStudy->inistitution }}</td>
                                <td>{{ $trainingAndStudy->city }}</td>
                                <td>{{ $trainingAndStudy->date_of_leave->format('Y M, d') }}</td>
                                <td>{{ $trainingAndStudy->end_of_study->format('Y M, d') }}</td>
                                <td>
                                    <a href="{{ route('{employee}/training-and-study.edit', ['employee'=>$crud->entry?->id,'id'=>$trainingAndStudy->id]) }}"
                                        class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="deleteEntry(this)"
                                        data-route="{{ route('{employee}/training-and-study.destroy', ['employee'=>$crud->entry?->id,'id'=>$trainingAndStudy->id]) }}"
                                        class="btn btn-sm btn-link" data-button-type="delete"><i
                                            class="la la-trash"></i> {{ trans('backpack::crud.delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($trainingAndStudies)==0)
                            <tr>
                                <td colspan="7" class="text-center">No External Experience</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div>
                        {{ $trainingAndStudies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- //////////////////////// Eficieny Modal  ///////////////////////////// -->
<div class="modal fade modal-fullscreen" id="efficiency" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"> Employee: {{ $crud->entry?->name }} </h6>
                <div class="row">
                    <a class="btn  btn-sm btn-outline-primary float-right mr-1" data-toggle="collapse"
                        href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span aria-hidden="true"> <i class="la la-plus"></i> Add new </span>
                    </a>

                    <button type="button" class="btn  btn-sm btn-outline-primary pull-right mr-1" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true"> <i class="la la-times"></i> Close </span>
                    </button>

                    <a href="javascript: window.print();" class="btn  btn-sm btn-outline-primary float-right mr-1"><i
                            class="la la-print"></i> Print</a>


                </div>

            </div>

            <style>
                table,
                tr,
                td {
                    line-height: 5px;

                }
            </style>
            <!-------- //////////////////////////// -->
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <!--- ////////////////////// Evalution form ----------->
                    <form action="{{ route('employeeEvaluation.create', []) }}" method="GET">
                        @csrf


                        <table class="table table-hover" cellpadding="0" cellspacing="0">
                            <thead>

                                <tr style="background-color: lightblue">
                                    <th>#</th>
                                    <th> Employee Evalution Criteria</th>
                                    <th> Evaluation Levels </th>

                                </tr>
                            </thead>

                            <tbody>

                                <input type="hidden" name="employee" value="{{$crud->entry?->id }}">

                                @foreach ($evalutionCreterias as $evalutionCreteria)

                                {{-- <input type="hidden" name="evalution[]" value="{{  $evalutionCreteria->id }}"> --}}


                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td>
                                        <input name="criteria[]" type="hidden" value="{{ $evalutionCreteria->id }}" />

                                        {{ $evalutionCreteria->name }} [ {{ $evalutionCreteria->percent}}]
                                    </td>

                                    <td>

                                        <input name="level{{ $evalutionCreteria->id }}[]" type="radio" value="4"
                                            required /> Excellent(4) &nbsp;
                                        <input name="level{{ $evalutionCreteria->id }}[]" type="radio" value="3"
                                            required /> Very good(3) &nbsp;
                                        <input name="level{{ $evalutionCreteria->id }}[]" type="radio" value="2"
                                            required /> Good(2) &nbsp;
                                        <input name="level{{ $evalutionCreteria->id }}[]" type="radio" value="1"
                                            required /> Poor(1) &nbsp;
                                    </td>

                                </tr>
                                @endforeach
                                @if(count($employeeEvaluations)==0)
                                <tr>
                                    <td colspan="7" class="text-center">No evaluations </td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                        <button type="submit" name="save" class="btn  btn-sm btn-primary float-right mr-1"> <i
                                class="la la-plus"> </i>Save </button>
                    </form>


                </div>
            </div>

            <!-- ///////////////////////////////////////////////--->
            <div class="modal-body">
                <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs mt-2"
                    cellspacing="0">
                    <thead>
                        <tr>

                            <th> Evalution Criteria</th>
                            <th> Evalution level </th>
                            <th>Recorded by</th>
                            <th>Obtained Mark</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employeeEvaluations as $employeeEvaluation)
                        <tr>

                            <td>{{ $employeeEvaluation->evalutionCreteria->name }}( {{
                                $employeeEvaluation->evalutionCreteria->percent }})</td>
                            <td>{{ $employeeEvaluation->evaluationLevel->name }}({{
                                $employeeEvaluation->evaluationLevel->weight }})</td>
                            <td>{{ 'Hailu Chamir' }}</td>
                            <td>{{ $employeeEvaluation->evaluationLevel->weight *
                                $employeeEvaluation->evalutionCreteria->percent }} </td>
                            <td>{{ $employeeEvaluation->created_at }}</td>



                            <td>
                                <a href="" class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                                <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-link"
                                    data-button-type="delete"><i class="la la-trash"></i> {{
                                    trans('backpack::crud.delete') }}</a>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($employeeEvaluations)==0)
                        <tr>
                            <td colspan="7" class="text-center">No employee evaluation found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>
<!---- //////////////////////////////////////////////////////////// -->
@section('after_styles')
<link rel="stylesheet"
    href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet"
    href="{{ asset('packages/backpack/crud/css/show.css').'?v='.config('backpack.base.cachebusting_string') }}">
@endsection

@section('after_scripts')
<script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}">
</script>
<script src="{{ asset('packages/backpack/crud/js/show.js').'?v='.config('backpack.base.cachebusting_string') }}">
</script>

<script src="{{ asset('assets/select2/dist/js/select2.min.js') }}"></script>
<script>
    $(function () { // Initialize Select2 Elements
      $('.select2').select2()
        });
</script>
<script>
    if (typeof deleteEntry != 'function') {
          $("[data-button-type=delete]").unbind('click');

          function deleteEntry(button) {
            // ask for confirmation before deleting an item
            // e.preventDefault();
            var route = $(button).attr('data-route');

            swal({
              title: "{!! trans('backpack::base.warning') !!}",
              text: "{!! trans('backpack::crud.delete_confirm') !!}",
              icon: "warning",
              buttons: ["{!! trans('backpack::crud.cancel') !!}", "{!! trans('backpack::crud.delete') !!}"],
              dangerMode: true,
            }).then((value) => {
                if (value) {
                    $.ajax({
                      url: route,
                      type: 'DELETE',
                      success: function(result) {
                            $(button).parent().parent().remove();
                          if (result == 1) {
                              // Redraw the table
                              if (typeof crud != 'undefined' && typeof crud.table != 'undefined') {
                                  // Move to previous page in case of deleting the only item in table
                                  if(crud.table.rows().count() === 1) {
                                    crud.table.page("previous");
                                  }
                                  $(button).parent().parent().remove();
                                  crud.table.draw(false);
                              }

                                // Show a success notification bubble
                              new Noty({
                                type: "success",
                                text: "{!! '<strong>'.trans('backpack::crud.delete_confirmation_title').'</strong><br>'.trans('backpack::crud.delete_confirmation_message') !!}"
                              }).show();

                              // Hide the modal, if any
                              $('.modal').modal('hide');
                          } else {
                              // if the result is an array, it means
                              // we have notification bubbles to show
                                if (result instanceof Object) {
                                    // trigger one or more bubble notifications
                                    Object.entries(result).forEach(function(entry, index) {
                                      var type = entry[0];
                                      entry[1].forEach(function(message, i) {
                                        new Noty({
                                        type: type,
                                        text: message
                                      }).show();
                                      });
                                    });
                                } else {// Show an error alert
                                  swal({
                                      title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                    text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                      icon: "error",
                                      timer: 4000,
                                      buttons: false,
                                  });
                                }
                          }
                      },
                      error: function(result) {
                          // Show an alert with the result
                          swal({
                              title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                            text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                              icon: "error",
                              timer: 4000,
                              buttons: false,
                          });
                      }
                  });
                }
            });

          }
        }

        // make it so that the function above is run after each DataTable draw event
        // crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
<script>
    function createPopupWin(pageURL, pageTitle,
                popupWinWidth, popupWinHeight) {
        var left = (screen.width - popupWinWidth) / 2;
        var top = (screen.height - popupWinHeight) / 4;

        var myWindow = window.open(pageURL, pageTitle,
                'resizable=yes, width=' + popupWinWidth
                + ', height=' + popupWinHeight + ', top='
                + top + ', left=' + left);
    }
</script>

<script src=" {{ asset('assets/calendar/js/jquery.plugin.js')}}"></script>
<script src=" {{ asset('assets/calendar/js/jquery.calendars.js')}}"></script>
<script src=" {{ asset('assets/calendar/js/jquery.calendars.plus.js')}}"></script>
<script src=" {{ asset('assets/calendar/js/jquery.calendars.picker.js')}}"></script>
<script src=" {{ asset('assets/calendar/js/jquery.calendars.ethiopian.js')}}"></script>
<script src=" {{ asset('assets/calendar/js/jquery.calendars.ethiopian-am.js')}}"></script>
<script src=" {{ asset('assets/calendar/js/jquery.calendars.picker-am.js')}}"></script>


<script>
    var calendar = $.calendars.instance('ethiopian', 'am');
   $('#start').calendarsPicker({calendar: calendar});
  // $('#end').calendarsPicker({calendar: calendar});
</script>
@endsection
