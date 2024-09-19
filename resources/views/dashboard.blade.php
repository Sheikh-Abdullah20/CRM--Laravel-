@extends('layouts.app')
@section('title')
CRM - Home
@endsection
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card card-chart">
        <div class="card-header ">
          <div class="row">
            <div class="col-sm-6 text-left">
              <h5 class="card-category">Total Deals</h5>
              <h2 class="card-title">Performance</h2>
            </div>
           
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="chartBig1"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Total Meetings</h5>
          <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i>{{implode(',',  $chartMeeting['count']) }}</h3>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="chartLinePurple"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Total Tasks</h5>
          <h3 class="card-title"><i class="tim-icons icon-bulb-63 text-warning"></i>{{implode(',', $chartTask['count']) }}</h3>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="CountryChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card card-chart">
        <div class="card-header">
          <h5 class="card-category">Total Leads</h5>
          <h3 class="card-title"><i class="tim-icons icon-atom text-success"></i> {{ implode(',', $chartLead['count']) }}</h3>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="chartLineGreen"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</div>

@endsection
@section('scripts')

<script>
  chartDeal = @json($chartDeal); 
  chartMeeting = @json($chartMeeting); 
  chartTask = @json($chartTask); 
  chartLead = @json($chartLead); 
</script>

@endsection