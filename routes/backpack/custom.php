<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('chair-man-type', 'ChairManTypeCrudController');
    Route::crud('educational-level', 'EducationalLevelCrudController');
    Route::crud('employee', 'EmployeeCrudController');
    Route::crud('employee-address', 'EmployeeAddressCrudController');
    Route::crud('employee-category', 'EmployeeCategoryCrudController');
    Route::crud('employee-certificate', 'EmployeeCertificateCrudController');
    Route::crud('employee-contact', 'EmployeeContactCrudController');
    Route::crud('employee-family', 'EmployeeFamilyCrudController');
    Route::crud('employee-language', 'EmployeeLanguageCrudController');
    Route::crud('employee-title', 'EmployeeTitleCrudController');
    Route::crud('employment-status', 'EmploymentStatusCrudController');
    Route::crud('employment-type', 'EmploymentTypeCrudController');
    Route::crud('ethnicity', 'EthnicityCrudController');
    Route::crud('external-experience', 'ExternalExperienceCrudController');
    Route::crud('family-relationship', 'FamilyRelationshipCrudController');
    Route::crud('field-of-study', 'FieldOfStudyCrudController');
    Route::crud('internal-experience', 'InternalExperienceCrudController');
    Route::crud('job-title', 'JobTitleCrudController');
    Route::crud('job-title-category', 'JobTitleCategoryCrudController');
    Route::crud('language', 'LanguageCrudController');
    Route::crud('license', 'LicenseCrudController');
    Route::crud('license-type', 'LicenseTypeCrudController');
    Route::crud('marital-status', 'MaritalStatusCrudController');
    Route::crud('nationality', 'NationalityCrudController');
    Route::crud('organization', 'OrganizationCrudController');
    Route::crud('pension', 'PensionCrudController');
    Route::crud('region', 'RegionCrudController');
    Route::crud('religion', 'ReligionCrudController');
    Route::crud('skill', 'SkillCrudController');
    Route::crud('skill-type', 'SkillTypeCrudController');
    Route::crud('training-and-study', 'TrainingAndStudyCrudController');
    Route::crud('unit', 'UnitCrudController');
    Route::crud('upload-file', 'UploadFileCrudController');
}); // this should be the absolute last line of this file