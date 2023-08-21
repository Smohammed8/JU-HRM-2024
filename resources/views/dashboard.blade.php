@extends(backpack_view('blank'))


@section('content')
    @cannot('dashboard.content')
        <h3 class="text-center">Welcome to {{ env('APP_NAME') }}</h3>
    @endcan
    @can('dashboard.content')

            <!-- /.row -->

<style>

.bg-blue{

    background-color: #0067b8 !important;

}
</style>
<br><br>

     <!-- <div class="card card-primary card-outline"> -->
        
      <div class="card">
        <div class="card-header">
            <h5 class="mb-2"> <i class="fa fa-list"></i> System Analytics </h5>

         
            <a href="{{ route('employee-form') }}" class="btn  btn-sm btn-outline-primary float-right mr-1"> <i class="fa fa-download"></i> Export</a>
            {{-- <a href="{{ route('import-employee') }}" class="btn btn-sm btn-primary float-right mr-1"> Import</a> --}}

            <button type="button" class="btn  btn-sm btn-outline-primary float-right mr-1" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-upload"></i>  Import
            </button>
            <a href="{{ route('user-manual') }}" class="btn  btn-sm btn-outline-primary float-right mr-1"> <i class="fa fa-book"></i> Download User Manual</a>


        </div> <!-- /.card-body -->
        <div class="card-body">
            <div class="container-fluid animated fadeIn">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                           <span class="info-box-icon bg-info"> <a href="{{ route('employee.index', []) }}" title="Click to view details">  <i class="fa fa-users"></i></a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Employees</span>
                                <span class="info-box-number">{{ number_format($employees, 0, '.', ',') }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"> <a href="{{ route('employee.checkRetirment', []) }}" title="Click to view details"> <i class="fa fa-user-minus"></i> </a> </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Retirements </span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"> <a href="{{ route('employee.index', []) }}" title="Click to view details"> <i class="fa fa-user-plus"></i> </a></span>

                            <div class="info-box-content">
                                <span class="info-box-text"> Active Leaves</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"> <a href="{{ route('employee.index', []) }}" title="Click to view details"> <i class="fa fa-user-minus"></i> </a> </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Resignations</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- =========================================================== -->

               <hr>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box"> <!--    <div class="info-box shadow"> -->
                            <span class="info-box-icon bg-info"> <a href="{{ route('unit.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a> </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Organizational units</span>
                                <span class="info-box-number">{{ $units }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"> <a href="{{ route('employee.probation', []) }}" title="Click to view details"> <i class="fa fa-user-tie"></i> </a> </span>

                            <div class="info-box-content">
                                <span class="info-box-text">In probation Period  </span>
                                <span class="info-box-number">{{  $probation  }} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                 
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-list"></i> </a> </span>

                            <div class="info-box-content">                                <span class="info-box-text">Vacant positions </span>
                                <span class="info-box-number"> {{ $positions }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-star"></i> </a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">New promotions</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
        </div><!-- /.card-body -->
      </div>


    </div>
    <hr>


            <style>
                .card-header {
                    font-weight: bold;
                }
            </style>


            <div class="row" name="widget_707545443" section="after_content">
 
                <div class="col-sm-6">
                 
                    <div class="card">
                        <div class="card-header"> <i class="la la-list"> </i> Employees Statistics</div>
                        <div class="card-body">
                            @foreach ($employeeTypes as $employeeType)
                                {{ $employeeType->name . ' : ' . $employeeType->employees()->count() }}&nbsp;
                            @endforeach
                        </div>
                    </div>
               
                </div>


                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header"> <i class="la la-list"> </i> Gender Based Statistics</div>
                        <div class="card-body"> Male Staff : {{ $males }} &nbsp; Female Staff: {{ $females }}
                        </div>
                    </div>
                </div>
            </div>

            <hr>
<div class="row">

    <div class="col-md-3">
               
        <div class="card card-defualt">  <!-- card card-info -->
            <span class="border border-primary">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-flag"></i>  Main HR Office</h4>

              <div class="card-tools">

              </div>
            </div>  
            <div class="col-md-12 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Employees</span>
                        <span class="info-box-number">1,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </span>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

            <div class="col-md-3">
               
                <div class="card card-defualt">  <!-- card card-info -->
                    <span class="border border-danger">
                    <div class="card-header">
                      <h4 class="card-title"><i class="fa fa-flag"></i>  Jimma Medical Center</h4>

                      <div class="card-tools">

                      </div>
                    </div>  
                    <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Employees</span>
                                <span class="info-box-number">1,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </span>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-3">
               
                    <div class="card card-defualt">  <!-- card card-info -->
                        <span class="border border-primary">
                        <div class="card-header">
                          <h4 class="card-title"><i class="fa fa-flag"></i> Health Institue</h4>
    
                          <div class="card-tools">
    
                          </div>
                        </div>  
                        <div class="col-md-12 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>
    
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Employees</span>
                                    <span class="info-box-number">1,000</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </span>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>

                    <div class="col-md-3">
               
                        <div class="card card-defualt">  <!-- card card-info -->
                            <span class="border border-primary">
                            <div class="card-header">
                              <h4 class="card-title"><i class="fa fa-flag"></i> JiT HR Office</h4>
        
                              <div class="card-tools">
        
                              </div>
                            </div>  
                            <div class="col-md-12 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Employees</span>
                                        <span class="info-box-number">1,000</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </span>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>

            </div>
<!---------------------------------------------------->
<hr>
<div class="row">

    <div class="col-md-3">
               
        <div class="card card-defualt">  <!-- card card-info -->
            <span class="border border-primary">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-flag"></i> College of CAVM HR Office</h4>

              <div class="card-tools">

              </div>
            </div>  
            <div class="col-md-12 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Employees</span>
                        <span class="info-box-number">1,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </span>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

            <div class="col-md-3">
               
                <div class="card card-defualt">  <!-- card card-info -->
                    <span class="border border-primary">
                    <div class="card-header">
                      <h4 class="card-title"><i class="fa fa-flag"></i> College of NS HR Office</h4>

                      <div class="card-tools">

                      </div>
                    </div>  
                    <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Employees</span>
                                <span class="info-box-number">1,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </span>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-3">
               
                    <div class="card card-defualt">  <!-- card card-info -->
                        <span class="border border-primary">
                        <div class="card-header">
                          <h4 class="card-title"><i class="fa fa-flag"></i> College of SS HR Office</h4>
    
                          <div class="card-tools">
    
                          </div>
                        </div>  
                        <div class="col-md-12 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>
    
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Employees</span>
                                    <span class="info-box-number">1,000</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </span>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                    <div class="col-md-3">
               
                        <div class="card card-defualt">  <!-- card card-info -->
                            <span class="border border-primary">
                            <div class="card-header">
                              <h4 class="card-title"><i class="fa fa-flag"></i> College of BECO HR Office</h4>
        
                              <div class="card-tools">
        
                              </div>
                            </div>  
                            <div class="col-md-12 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Employees</span>
                                        <span class="info-box-number">1,000</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </span>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>

            </div>
<!-- -------------------------------------------------------- -->

<hr>
<div class="row">

    <div class="col-md-3">
               
        <div class="card card-defualt">  <!-- card card-info -->
            <span class="border border-primary">
            <div class="card-header">
              <h4 class="card-title"><i class="fa fa-flag"></i> Law & Gov'c HR Office</h4>

              <div class="card-tools">

              </div>
            </div>  
            <div class="col-md-12 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Employees</span>
                        <span class="info-box-number">1,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </span>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

            <div class="col-md-3">
               
                <div class="card card-defualt">  <!-- card card-info -->
                    <span class="border border-primary">
                    <div class="card-header">
                      <h4 class="card-title"><i class="fa fa-flag"></i> Education & Behaiveral HR Office</h4>

                      <div class="card-tools">

                      </div>
                    </div>  
                    <div class="col-md-12 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Employees</span>
                                <span class="info-box-number">1,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </span>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-3">
               
                    <div class="card card-defualt">  <!-- card card-info -->
                        <span class="border border-primary">
                        <div class="card-header">
                          <h4 class="card-title"><i class="fa fa-flag"></i> Sport Science HR Office</h4>
    
                          <div class="card-tools">
    
                          </div>
                        </div>  
                        <div class="col-md-12 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-default"> <a href="{{ route('position.index', []) }}" title="Click to view details">  <i class="fa fa-sitemap"></i> </a></span>
    
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Employees</span>
                                    <span class="info-box-number">1,000</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </span>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>

           
          
            </div>








            <!-- /////////////////////////////////////////////////////////// -->
            </div>
        </div>

    @endcan



  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Batch importing Employee data </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('import-employee') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="email1"> CSV File</label>
                <input type="file" class="form-control" id="file" name="file" aria-describedby="file" placeholder="Upload file">
                <small id="file" class="form-text text-muted">Your information is safe with us.</small>
              </div>
            
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary">Import</button>
        </div>

    </form>
      </div>
    </div>
  </div>



    <?php

    $dataPoints = array(
        array("label"=>"Administrative staff", "y"=>99),
        array("label"=>"Academics 	 staff", "y"=>0.3),
        array("label"=>"Health staff", "y"=>0.3),
        array("label"=>"Research", "y"=>0.4),


    )

    ?>
 <script src="{{ asset('assets/js/canvasjs.min.js') }}"></script>


        <script>

        window.onload = function() {
        var chart = new CanvasJS.Chart("piechart", {
        animationEnabled: true,
        exportEnabled: true,
        // title: {
        //     text: "Jimma University"
        // },
        // subtitles: [{
        //     text: " Employee Classification"
        // }],
        data: [{
            type: "pie",
            //yValueFormatString: "#,##0.00\"%\"",
            yValueFormatString: "#,##0\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
        });
        chart.render();

        }


        </script>

@endsection
