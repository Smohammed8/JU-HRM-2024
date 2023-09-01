@extends(backpack_view('blank'))


<style>



    body{
font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
font-size: 1rem;
font-weight: 400;
line-height: 1.5;

    }
</style>
@section('content')
    @cannot('dashboard.content')
        <h3 class="text-center"> Welcome to {{ env('APP_NAME') }}</h3>
    @endcan
    @can('dashboard.content')
    <br>    

    <p>
      
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2"> System Analytics for {{ $name }}   </button>
      </p>
      <div class="row">
        <div class="col">
          <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <table class="table table-sm">
                    <thead>
                        <tr> 
                          Number of Administrative Staff on Duty by Educational Level 
                        </tr>
                        <hr>
                    </thead>
                    <thead>
                      
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Education Level</th>
                        <th scope="col">Male</th>
                        <th scope="col">Feamle</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>


                        @foreach ($educations as $education) 
                               <tr>
    
                                <td> {{ $loop->index + 1 }} </td>
                                <td> {{ $education->name ?? '-' }} </td>
                                <td> {{ $education->male_count }}</td> 
                                <td> {{ $education->female_count }}  </td> 
                                <td> {{ $education->male_count + $education->female_count }}</td> 
                                
                        
                            
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="collapse multi-collapse" id="multiCollapseExample2">
            <div class="card card-body">
                <table class="table table-sm">
                    <thead>
                        <tr> 
                         Number of Administrative Staff on Leave by Educational Level(Retired,Resigned & Left due to death)
                        <hr>
                    </thead>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Education Level</th>
                        <th scope="col">Male</th>
                        <th scope="col">Feamle</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($educations as $education) 
                        <tr>

                    <td> {{ $loop->index + 1 }} </td>
                    <td> {{ $education->name ?? '-' }} </td>
                    <td> {{ $education->male_left_count }}</td> 
                    <td> {{ $education->female_left_count }}  </td> 
                    <td> {{ $education->male_left_count + $education->female_left_count }}</td> 
                   

               
           </tr>
       @endforeach
                
                    
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
        
      </div>

      <div class="row">
        <div class="col">
          <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <table class="table table-sm">
                    <thead>
                        <tr> 
                          Number of Administrative Staff on Leave by Target Educational Level 
                        </tr>
                        <hr>
                    </thead>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Advanced Diploma </th>
                        <th scope="col">Male</th>
                        <th scope="col">Feamle</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($educations as $education) 
                        <tr>

                    <td> {{ $loop->index + 1 }} </td>
                    <td> {{ $education->name ?? '-' }} </td>
                    <td> {{ $education->male_left_count }}</td> 
                    <td> {{ $education->female_left_count }}  </td> 
                    <td> {{ $education->male_left_count + $education->female_left_count }}</td> 
                   

               
           </tr>
       @endforeach
                 
                    
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="collapse multi-collapse" id="multiCollapseExample2">
            <div class="card card-body">
                <table class="table table-sm">
                    <thead>
                        <tr> 
                           Number of Administrative Staff by Type of Employment
                        </tr>
                        <hr>
                    </thead>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Employement type</th>
                        <th scope="col">Male</th>
                        <th scope="col">Feamle</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($employements as $employement) 
                        <tr>

                   <td> {{ $loop->index + 1 }} </td>
                   <td> {{ $employement->name ?? '-' }} </td>
                   <td> {{ $employement->type_male_count }}</td> 
                   <td> {{ $employement->type_female_count }}</td> 
                   <td> {{  $employement->type_male_count  + $employement->type_female_count  }}</td> 
                   
           
               
           </tr>
       @endforeach
                 
                    
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
              <div class="card card-body">
                  <table class="table table-sm">
                      <thead>
                          <tr> 
                           Number of Administrative staff certified with 
                          </tr>
                          <hr>
                      </thead>
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Training type</th>
                          <th scope="col">Male</th>
                          <th scope="col">Feamle</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach ($educations as $education) 
                               <tr>
    
                                <td> {{ $loop->index + 1 }} </td>
                                <td> {{ $education->name ?? '-' }} </td>
                                <td> {{ $education->male_count }}</td> 
                                <td> {{ $education->female_count }}  </td> 
                                <td> {{ $education->male_count + $education->female_count }}</td> 
                                
                        
                            
                        </tr>
                    @endforeach
                   
                      
                      </tbody>
                    </table>
              </div>
            </div>
          </div>


          <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
              <div class="card card-body">
                  <table class="table table-sm">
                      <thead>
                          <tr> 
                         Number of Administrative staff left last year (ሐምሌ 2014 - ሰኔ 2015) by department, Educational level and Academic Rank 
                          </tr>
                          <hr>
                      </thead>
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Current Educational Status</th>
                          <th scope="col">Male</th>
                          <th scope="col">Feamle</th>
                          <th scope="col">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($educations as $education) 
                        <tr>
                         <td> {{ $loop->index + 1 }} </td>
                         <td> {{ $education->name ?? '-' }} </td>
                         <td> {{ $education->male_count }}</td> 
                         <td> {{ $education->female_count }}  </td> 
                         <td> {{ $education->male_count + $education->female_count }}</td> 
                 </tr>
             @endforeach
                   
                      
                      </tbody>
                    </table>
              </div>
            </div>
          </div>
        </div>    
      </div>

     <div class="card card-primary card-outline"> 
        
      {{-- <div class="card"> --}}

        <div class="card-header">
            <h5 class="mb-2"> List of an employees under :<u><b> {{ $name }} </b></u> </h5>
        </div> <!-- /.card-body -->
        <div class="card-body">
            <div class="container-fluid animated fadeIn">


                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                           <span class="info-box-icon bg-info"> <a href="{{ route('employee.index', []) }}" title="">  <i class="fa fa-male"></i></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> <a href ="{{route('result') }}"> Male  </a> </span>
                                <span class="info-box-number"> {{ $males }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fa fa-female"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> <a href =""> Female </a></span>
                                <span class="info-box-number">{{ $females }} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">  <a href ="{{ backpack_url('position') }}"> Total Employees  </a></span>
                                <span class="info-box-number">{{   $total }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fa fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> <a href ="{{ backpack_url('position') }}">Avaliable Positions  </a></span>
                                <span class="info-box-number"> {{ '0' }} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

             
                @push('css')
                <style>
                    .select2,
                    .select2-container,
                    .select2-container--default,
                    .select2-container--below {
                        width: 100% !important;
                    }
                </style>
            @endpush
         
      
          <script>
             
              $( document ).ready(function() {
                  $('#position').select2({
                  });
      
              });
              $( document ).ready(function() {
                  $('#unit').select2({
                  });
      
              });
      
          </script>




    
        <hr>
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="font-size: 14px;"> 
            <thead>
                <tr>
                    <th> # </th>
                    <th> Employee FullName</th>
                    <th> Job Title  </th>
                    <th> Educational Level </th>
                    <th> Organization Unit </th>
                    <th> HR Branch </th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
              
              
                @foreach ($employees as $employee) 
                    <tr>

                            <td> {{ $loop->index + 1 }} </td>
                            <td> {{ $employee->name ?? '-' }} </td>
                            <td> {{ $employee->position->name  ?? '-'}}</td> 
                            <td> {{ $employee->educationLevel->name  ?? '-'}}</td> 
                            <td> {{ $employee->gender ?? '-'  ?? '-'}}</td> 
                            <td> {{ $employee->hrBranch->name  ?? '-'}}</td> 
                        <td>
                            <a href="{{ route('employee', ['employee_id'=>$employee->id]) }}" title="Profile" class="btn  btn-sm btn-outline-primary float-right mr-1">
                                <i class="fa fa-user-tie">  </i> 
                            </a>
                            <a href="{{ route('employee.edit', ['id'=>$employee->id]) }}" title="Edit" class="btn  btn-sm btn-outline-primary float-right mr-1">
                                <i class="fa fa-edit">  </i> 
                            </a>

                           
                        </td>
                        
                    </tr>
                @endforeach
                @if (count($employees) == 0)
                <tr>
                    <td colspan="7" class="text-center"> No employee found! </td>
                </tr>
            @endif
              
            </tbody>

        </table>
        <div class="m-auto float-right">
            {{ $employees->links() }}
         

        </div>
      </div>
<!-- /.container-fluid -->

  <!-- /.content -->



    </div>
    <hr>


         

         
        </div>

    @endcan

   

@endsection
