@extends(backpack_view('blank'))


@section('header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-1">
        <div class="col-sm-6">
            <h4> Grid View </h4>
        </div>
        <div class="col-sm-6">
            <a style="float:right;" class="btn btn-sm btn-outline-primary mr-1" href="{{ backpack_url('employee') }}"> <i class="fa fa-plus"> </i> Create new</a>
            <a style="float:right;"  class="btn btn-sm  btn-outline-primary mr-1" href="{{ backpack_url('employee') }}"> <i class="fa fa-list"> </i> List View</a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<hr>

 <section class="content">

 <!-- Default box -->
 <div class="card card-solid">
   <div class="card-body pb-0">
     <div class="row">
 
      @foreach($employees as $employee)
       <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
         <div class="card bg-light d-flex flex-fill">
           <div class="card-header text-muted border-bottom-0">
            <span class="d-none d-md-inline">  
                        
      
            <div class="ribbon-wrapper ribbon-lg">
             <div class="ribbon bg-info text-sm" style="font-size:14px !important;">
        Employee
             </div>
          </div>
</span>
           </div>
           <div class="card-body pt-0">
             <div class="row">
               <div class="col-7">

          
                 <h3 class="lead"><b>   <a  style="font-size:16px;" href="{{ route('employee', ['employee_id' => $employee->id]) }}">
             
                 {{ $employee->name }} </a> </b></h3>
                 <hr>
                 <p class="text-muted text-sm"><b>About: </b> <br> {{ $employee->position->jobTitle->name ?? '-' }} at {{ $employee->position->unit->name ?? '-' }}  </p>
             
                 <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small"><span class="fa-li"><i class="fa fa-caret-right"></i></span> 
                    Employment date: {{ $employee->employement_date->format('d/m/Y') }}  E.C</li>
                   <li class="small"><span class="fa-li"><i class="fa fa-caret-right"></i></span>
                     Educational Level: {{ $employee->educationLevel->name ?? '-' }}<br>
                     <li class="small"><span class="fa-li"><i class="fa fa-caret-right"></i></span>
                     Age: {{ $employee->age() }}  years old </li>

                   <li class="small"><span class="fa-li"><i class="fa fa-caret-right"></i></span>
                     Phone #: {{ $employee->phone }} </li>
                 </ul>
               </div>
               <div class="col-5 text-center">




                {{-- <img width="100px" src="{{ asset('storage/employee/'.$employee->photo ?: 'profile.png') }}" class="img-circle elevation-2"> --}}

                <img width="100px" src="{{ $employee->photo ? : 'employee.jpg' }}" alt="profile Pic" class="img elevation-2" style="border: 2px double #ccc;">


                 </div>
             </div>
           </div>
           
         </div>
       </div>

    @endforeach

  
     </div>
   </div>
   <div class="btn btn-sm float-right" style="margin-left:1200px;" id="custompaginator">
    {{ $employees->links() }}
</div>


 </div>
 <!-- /.card -->

</section>
<!-- /.content -->

  @endsection

