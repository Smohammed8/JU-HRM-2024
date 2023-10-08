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
     <div class="card card-primary card-outline"> 
        
      {{-- <div class="card"> --}}
   
        <div class="card-header">
            <h5 class="mb-2"> Employee Leaves : {{ \Carbon\Carbon::now()->format('Y') -8  }} E.C</h5>

       
        

         
        </div> <!-- /.card-body -->

        <div class="card-body">
            <div class="container-fluid animated fadeIn">


                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                           <span class="info-box-icon bg-info"> <a href="#" title="">  <i class="fa fa-male"></i></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> <a href ="#"> Male </a> </span>
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
                                <span class="info-box-text"> <a href =""> Female  </a></span>
                                <span class="info-box-number">{{ $females }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> <a href =""> Total Leaves  </a></span>
                                <span class="info-box-number">{{ $females +  $males  }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                
                </div>
                <!-- /.row -->

             
           



    
        <hr>
    <table class="table table-hover" cellpadding="0" cellspacing="0" style="font-size: 14px;"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th> Employee</th>
                    <th> Gender  </th>
                    <th> Working unit </th>
                    <th> Job title</th>
                    <th> Employee type </th>
                    <th> Leave type  </th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
              
              
                @foreach ($employees as $employee) 
                    <tr>

                        <td> {{ $loop->index + 1 }} </td>

                      
                            <td> {{ $employee->name ?? '-' }} </td>
                            <td>{{  $employee->gender ?? '-' }}   </td>
                         
                            <td> {{ $employee->position->unit->name ?? '-' }} </td>
                            <td> {{ $employee->position->jobTitle->name ?? '-' }} - {{ $employee->positionCode?->code ?? '-'  }} </td>
                            <td> {{ $employee->employeeCategory->name ?? '-' }} </td>
                            <td style="color:red;"> 
                                
                               
                                {{ $employee->employmentStatus->name ?? '-' }} 
                            
                            </td>
                        

                
                    
                        <td>

                         
                         
                            <a href="{{ route('employee', ['employee_id'=>$employee->id]) }}" title="Make analysis" class="btn btn-sm btn-primary float-right">
                                <i class="fa fa-user">  </i>  Profile
                            </a> 

                      
                               
                          
                                  {{-- 
                            <form method="GET" action="{{ route('details',[]) }}">

                                    @csrf

                                <input type="hidden" value="{{ $placement_result->newPosition->jobTitle->id ?? null }}" name="newposition">

                                <button title="Make analysis"  name="filter" class="btn btn-sm btn-primary float-right">
                               <span class="fa fa-list"></span>
                              </button>

                            </form> --}}
                        
                            {{-- {{ route('payrollSheet.payee', ['payroll_sheet_id'=> $payroll_sheet->id]) }} --}}

                          
                        </td>
                        
                    </tr>


                    
                @endforeach
                @if (count($employees) == 0)
                <tr>
                    <td colspan="7" class="text-center"> No employee are retired! </td>
                </tr>
            @endif
              
            </tbody>

        </table>
        <div class="m-auto col-6 mt-3 float-right">
            {{ $employees->withQueryString()->links() }} 
            {{-- {{ $employees->links() }} --}}
        </div>
      </div>
<!-- /.container-fluid -->

  <!-- /.content -->



    </div>
    <hr>


         

         
        </div>

    @endcan

   

@endsection
