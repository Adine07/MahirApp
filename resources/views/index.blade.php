@extends('includes.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="row">
  <div class="col-xl-3 mb-30">
    <div class="card-box p-5 widget-style1">
      <a href="{{ route('projects.index') }}">
        <div class="d-flex flex-wrap align-items-center">
          <i class="icon-copy dw dw-rocket" style="font-size: 64px"></i>
          <div class="widget-data">
            <div class="h4 mb-0">{{ $sum_projects }}</div>
            <div class="weight-600 font-14">Projects</div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-xl-3 mb-30">
    <div class="card-box p-5 widget-style1">
      <a href="{{ route('clients.index') }}">
        <div class="d-flex flex-wrap align-items-center">
          <i class="icon-copy dw dw-user-11" style="font-size: 64px"></i>
          <div class="widget-data">
            <div class="h4 mb-0">{{ $sum_clients }}</div>
            <div class="weight-600 font-14">Clients</div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-xl-3 mb-30">
    <div class="card-box p-5 widget-style1">
      <a href="{{ route('users.index') }}">
        <div class="d-flex flex-wrap align-items-center">
          <i class="icon-copy dw dw-user-12" style="font-size: 64px"></i>
          <div class="widget-data">
            <div class="h4 mb-0">{{ $sum_users }}</div>
            <div class="weight-600 font-14">Users</div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-xl-3 mb-30">
    <div class="card-box p-5 widget-style1">
      <a href="{{ route('cashs.index') }}">
        <div class="d-flex flex-wrap align-items-center">
          <i class="icon-copy dw dw-money-1" style="font-size: 64px"></i>
          <div class="widget-data">
            <div class="h4 mb-0">Rp{{ number_format($tot_cashs) }}</div>
            <div class="weight-600 font-14">Cashs</div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-md-7">
    <div class="card-box mb-30">
      <h2 class="h4 pd-20">5 Latest Projects</h2>
      <table class="table">
        <thead>
          <tr>
            <th style="padding-left: 20px">Project Name</th>
            <th style="padding-left: 20px">Client Name</th>
            <th style="padding-left: 20px">Status</th>
            <th style="padding-left: 20px">Price</th>
            <th style="padding-left: 20px">Deadline</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($projects as $item)
              <tr>
                <td style="padding-left: 20px"><a href="{{ route('projects.show', $item->id) }}">{{ $item->project_name }}</a></td>
                <td style="padding-left: 20px"><a href="{{ route('clients.show', $item->client_project->client->id) }}">{{ $item->client_project->client->client_name }}</a></td>
                <td style="padding-left: 20px"><span class="badge {{ $item->status === 'on-process' ? 'badge-warning' : '' }}{{ $item->status === 'on-progress' ? 'badge-primary' : '' }}{{ $item->status === 'done' ? 'badge-success' : '' }}{{ $item->status === 'cenceled' ? 'badge-danger' : '' }}">{{ $item->status }}</span></td>
                <td style="padding-left: 20px">Rp {{ number_format($item->price) }}</td>
                <td style="padding-left: 20px">{{ $item->finish }}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-12 col-md-5">
    <div class="bg-white pd-20 card-box mb-30">
      <div id="pie"></div>
    </div>
  </div>
  <div class="col-12">
    <div class="bg-white pd-20 card-box mb-30">
      <div class="d-flex justify-content-between">
        <h4 class="mb-30 h4">Cashs in {{ $monthlyYear }}</h4>
        <form action="{{ route('home') }}" method="GET" id="yearForm" class="d-inline">	
          <table>
            <tr>
              <td class="pr-1">
                Select Year
              </td>
              <td>
                <select name="monthlyYear" id="" class="round" onchange="return $('#yearForm').submit()" style="padding: 5px 10px">
                  @php
                    $yearNow = date('Y', strtotime(now()));
                    $yearMin = date('Y', strtotime(App\Models\Kas::orderBy('date')->pluck('date')->first()));
                    
                  @endphp
                  @for ($i = $yearNow; $i >= $yearMin; $i--)
                    <option value="{{ $i }}" {{ $monthlyYear ? $monthlyYear == $i ? 'selected' : null : null }}>{{ $i }}</option>
                  @endfor
                </select>
              </td>
            </tr>
          </table>
        </form>
      </div>
      <div id="cashs"></div>
    </div>
  </div>
</div>
@endsection
@section('script')
	<script src="/deskapp/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="/deskapp/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
  <script src="/deskapp/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
  <script>
    Highcharts.chart('pie', {
      title: {
        text: 'Project Status Chart'
      },
      series: [{
        type: 'pie',
        allowPointSelect: true,
        keys: ['name', 'y'],
        data: @json($chartpie),
        showInLegend: true
      }]
    });

    // chart cashs
    Highcharts.chart('cashs', {
      chart: {
        type: 'line'
      },
      title: {
        text: ''
      },
      xAxis: {
        categories: ['Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'],
        labels: {
          style: {
            color: '#1b00ff',
            fontSize: '12px',
          }
        }
      },
      yAxis: {
        labels: {
          formatter: function () {
            return this.value;
          },
          style: {
            color: '#1b00ff',
            fontSize: '14px'
          }
        },
        title: {
          text: ''
        },
      },
      credits: {
        enabled: false
      },
      tooltip: {
        crosshairs: true,
        shared: true
      },
      plotOptions: {
        spline: {
          marker: {
            radius: 10,
            lineColor: '#1b00ff',
            lineWidth: 2
          }
        }
      },
      legend: {
        align: 'center',
        x: 0,
        y: 0
      },
      series: [{
        name: 'Income',
        color: '#ff686b',
        marker: {
          symbol: 'circle'
        },
        data: [
          @php
            for($i = 1; $i <= 12; $i++ ) {
              echo App\Models\Kas::whereMonth('date', $i)->whereYear('date', $monthlyYear)->pluck('income')->sum() . ',';
            }
          @endphp
        ]
      },
      {
        name: 'Expend',
        color: '#00789c',
        marker: {
          symbol: 'circle'
        },
        data: [
          @php
            for($i = 1; $i <= 12; $i++ ) {
              echo App\Models\Kas::whereMonth('date', $i)->whereYear('date', $monthlyYear)->pluck('expense')->sum() . ',';
            }
          @endphp
        ]
      }]
    });

  </script>
@endsection