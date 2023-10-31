@extends('user.templates.main.main')

@section('body')

<div class="row row-cards row-deck">
    <div class="col-12">
      <div class="card">
        <div class="table-responsive">
          <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
              <tr>
                <th class="text-center w-1"><i class="icon-people"></i></th>
                <th>Name</th>
                <th>In</th>
                <th class="text-center">Out</th>
                <th class="text-center">Date</th>
                <th class="text-center"><i class="icon-settings"></i></th>
              </tr>
            </thead>
            @forelse ($home as $item)
            <tbody>
                <tr>
                  <td class="text-center">
                    <div class="avatar d-block" style="background-image: url(demo/faces/female/26.jpg)">
                      <span class="avatar-status bg-green"></span>
                    </div>
                  </td>
                  <td>
                    <div>{{ auth()->user()->name }}</div>
                    <div class="small text-muted">
                      Registered: {{ auth()->user()->created_at }}
                    </div>
                  </td>
                  <td>
                    <div class="clearfix">
                      <div class="float-left">
                        <strong>
                            @if (strtotime($item->in) > strtotime($in->value))
                                <span data-toggle="tooltip" title="Absen Terlambat !" class="badge badge-danger">{{ $item->in }}</span>
                            @else
                                <span data-toggle="tooltip" title="Absen Tepat Waktu" class="badge badge-success">{{ $item->in }}</span>
                            @endif
                        </strong>
                      </div>
                    </div>
                  </td>
                  <td class="text-center">
                    @if (strtotime($item->out) < strtotime($out->value))
                        <span data-toggle="tooltip" title="Absen Pulang terlalu cepat !" class="badge badge-danger">{{ $item->out }}</span>
                    @else
                        <span data-toggle="tooltip" title="Absen Pulang tepat waktu !" class="badge badge-success">{{ $item->out }}</span>
                    @endif
                  </td>
                  
                  <td class="text-center">
                    <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42" data-thickness="3" data-color="blue">
                      <div class="chart-circle-value">{{ \Carbon\Carbon::parse($item->date)->format('l').', '.$item->date }}</div>
                    </div>
                  </td>
                  <td class="text-center">
                    <div class="item-action dropdown">
                      <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            @empty
                <h1 class="text-center">Data Empty !</h1>
            @endforelse
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection