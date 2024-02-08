<div class="header py-4">
    <div class="container">
      <div class="d-flex">
        <a class="header-brand" href="/">
          <img src="{{ asset('assets/images/logo/logo.png') }}" class="header-brand-img" alt="payroll application">Payroll Application
        </a>
        <div class="d-flex order-lg-2 ml-auto">
          @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert"></button>
              {{ session('error') }}
            </div>
          @endif
          @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert"></button>
              {{ session('success') }}
            </div>
          @endif
          <div class="nav-item d-none d-md-flex">
            <button data-toggle="tooltip" title="{{ $data->tooltip }}" class="btn btn-sm btn-{{ $data->color }}" disabled>Current Time: <div id="clock"></div></button>
          </div>
          <div class="nav-item d-none d-md-flex">
            {{-- <form action="{{ $data->link.$data->value }}" method="POST"> --}}
              {{-- @csrf --}}
              <button type="button" data-target=".bd-example-modal-lg" data-toggle="modal" onclick="openCam()" title="{{ $data->tooltip }}" class="btn btn-outline-{{ $data->color }}" {{ $data->buttonStatus }} >{{ $data->message }}</button>
            {{-- </form> --}}
          </div>
          <div class="dropdown d-none d-md-flex">
            <a class="nav-link icon" data-toggle="dropdown">
              <i class="fe fe-bell"></i>
              <span class="nav-unread"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <a href="#" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                <div>
                  <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                  <div class="small text-muted">10 minutes ago</div>
                </div>
              </a>
              <a href="#" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                <div>
                  <strong>Alice</strong> started new task: Tabler UI design.
                  <div class="small text-muted">1 hour ago</div>
                </div>
              </a>
              <a href="#" class="dropdown-item d-flex">
                <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                <div>
                  <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                  <div class="small text-muted">2 hours ago</div>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
            </div>
          </div>
          <div class="dropdown">
            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
              <span class="avatar" style="background-image: url({{ asset('/storage/'. auth()->user()->picture) }})"></span>
              <span class="ml-2 d-none d-lg-block">
                <span class="text-default">{{ auth()->user()->name }}</span>
                <small class="text-muted d-block mt-1"> {{ auth()->user()->role->role}} </small>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <a class="dropdown-item" href="/profile">
                <i class="dropdown-icon fe fe-user"></i> Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-settings"></i> Settings
              </a>
              <a class="dropdown-item" href="#">
                <span class="float-right"><span class="badge badge-primary">6</span></span>
                <i class="dropdown-icon fe fe-mail"></i> Inbox
              </a>
              <a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-send"></i> Message
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="dropdown-icon fe fe-help-circle"></i> Need help?
              </a>
              <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="dropdown-icon fe fe-log-out"></i> Sign out</button>
              </form>
                
            </div>
          </div>
        </div>
        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
          <span class="header-toggler-icon"></span>
        </a>
      </div>
    </div>
  </div>
  <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3 ml-auto">
          <form class="input-icon my-3 my-lg-0">
            <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
            <div class="input-icon-addon">
              <i class="fe fe-search"></i>
            </div>
          </form>
        </div>
        <div class="col-lg order-lg-first">
          <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item">
              <a href="/" class="nav-link {{ ($active === "home") ? 'active' :'' }}"><i class="fe fe-home"></i> Presence</a>
            </li>
            <li class="nav-item">
              <a href="/statistic" class="nav-link {{ ($active === "statistic") ? 'active' :'' }}"><i class="fe fe-home"></i> Statistic</a>
            </li>
            <li class="nav-item">
              <a href="/profile" class="nav-link {{ ($active === "profile") ? 'active' :'' }}"><i class="fe fe-home"></i> Profile</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" id="stopCapture" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        
        {{-- video preview --}}
        <div class="modal-body">
          <div class="d-flex justify-content-center">
            <video id="webcam" width="320" height="240" autoplay></video>
          </div>

          {{-- button capture --}}
          <div class="mt-2 d-flex justify-content-center">
            <button id="capture" class="btn btn-success ml-2">Capture</button>
          </div>

          {{-- image preview --}}
          <div class="d-flex justify-content-center mt-2">
            <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
            <img id="capturedImage" style="display: none;">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="$('#stopCapture').click()" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>