@extends('manager.base')
@section('content')
          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="far fa-clipboard"></i>
                  </div>
                  <h1 class="mr-5">{{$atten}}</h1>
                </div>
                <div class="card-footer text-white">
                  <span class="float-left">Today's Attendance</span>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                  <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <h1 class="mr-5">{{$table}}</h1>
                  </div>
                  <div class="card-footer text-white">
                    <span class="float-left">Booked Tables</span>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-sm-4 mb-4">
                  <div class="card text-white bg-primary o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon">
                          <i class="fas fa-table"></i>
                      </div>
                      <h1 class="mr-5">{{$table1}}</h1>
                    </div>
                    <div class="card-footer text-white">
                      <span class="float-left">Available Tables</span>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-sm-7 mb-5">
                    <div class="card text-white bg-danger o-hidden h-100">
                      <div class="card-body">
                        <div class="card-body-icon">
                          <i class="fas fa-boxes"></i>
                        </div>
                        <h1 class="mr-5">{{$pro}}</h1>
                      </div>
                      <div class="card-footer text-white">
                        <span class="float-left">Total Products</span>
                      </div>
                    </div>
                </div>
                <div class="col-xl-5 col-sm-7 mb-5">
                    <div class="card text-white bg-dark o-hidden h-100">
                      <div class="card-body">
                        <div class="card-body-icon">
                          <i class="fas fa-user-circle"></i>
                        </div>
                        <h1 class="mr-5">{{$data}}</h1>
                      </div>
                      <div class="card-footer text-white">
                        <span class="float-left">Total Employees</span>
                      </div>
                    </div>
                </div>
          </div>
  
          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Total Sell</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
@endsection