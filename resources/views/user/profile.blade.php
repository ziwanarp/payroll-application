@extends('user.templates.main.main')

@section('body')

<div class="my-3 my-md-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Change Password</h3>
            </div>
            <div class="card-body">
              <form action="/update/password" method="POST">
                @csrf
                <div class="row">
                  <div class="col-auto">
                    <span class="avatar avatar-xl" style="background-image: url(demo/faces/female/9.jpg)"></span>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label class="form-label">{{ strtoupper($user->name) }}</label>
                      <input class="form-control" value="Role: {{ $user->role->role }}" disabled/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">New Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password baru" onkeyup='check()'/>
                </div>
                <div class="form-group">
                  <label class="form-label">Confirm New Password</label>
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukan konfirmasi password" onkeyup='check()'/>
                  <span class="mx-0 mt-2" id='message'></span>
                </div>
                @if (session()->has('success_password'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    {{ session('success_password') }}
                  </div>
                @endif
                @if (session()->has('error_password'))
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    {{ session('error_password') }}
                  </div>
                @endif
                <div class="form-footer">
                  <button class="btn btn-primary btn-block" type="submit" id="password_submit">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <form class="card">
            <div class="card-body">
              <h3 class="card-title">My Profile</h3>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" disabled="" placeholder="Company" value="{{ $user->name }}" disabled>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Username" value="{{ $user->username}}" disabled>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="Email" value="{{ $user->email }}" disabled>
                  </div>
                </div>
                <div class="col-sm-6 col-md-12">
                  <div class="form-group">
                    <label class="form-label">Salary</label>
                    <input type="text" class="form-control" placeholder="Company" value="Rp. {{ number_format($user->salary) }}" disabled>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-label">Last Login</label>
                    <input type="text" class="form-control" placeholder="Home Address" value="{{ \Carbon\Carbon::parse($user->last_login)->diffForHumans() }}" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    var check = function() {
      if (document.getElementById('password').value ==
        document.getElementById('new_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = '✓ Password Match';
        document.getElementById('password_submit').disabled = false;
      } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password Not Match';
        document.getElementById('password_submit').disabled = true;
      }
    }
  </script>

@endsection