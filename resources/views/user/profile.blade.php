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
              
                
                <div class="row">
                
                    <form id="uploadPoto" action="update/profile-picture" method="POST" enctype="multipart/form-data">
                      @csrf
                      <label for="profilePicture">
                        <div class="profile-pic" style="background-image: url('{{ asset('/storage/'. $user->picture) }}')">
                            <span style="font-size: 12px">Change Image</span>
                        </div>
                    </label>
                    <input type="File" name="profilePicture" id="profilePicture" onchange="profilePictureJs()" >
                    <input type="hidden" name="oldImage" value="{{ $user->picture }}">
                    <button id="submitPoto" type="submit" style="display: none;"></button>
                  </form>

              <form action="/update/password" method="POST">
                    @csrf
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
          <form class="card" id="update_form">
            @csrf
            <div class="card-body">
              <h3 class="card-title">My Profile</h3>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="name" value="{{ $user->name }}" disabled>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ $user->username}}" disabled>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}" disabled>
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
                    <input type="text" class="form-control" placeholder="last login" value="{{ \Carbon\Carbon::parse($user->last_login)->diffForHumans() }}" disabled>
                  </div>
                </div>
              </div>
              @if (session()->has('success_profile'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert"></button>
                  {{ session('success_profile') }}
                </div>
              @endif
              @if (session()->has('error_profile'))
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert"></button>
                  {{ session('error_profile') }}
                </div>
              @endif
            </div>
            <div class="card-footer text-right">
              <button type="button" id="edit_button" onclick="buttonEditSave()" class="btn btn-primary">Edit Profile</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>

    function profilePictureJs(){
      var requestForm = document.getElementById('submitPoto');
      requestForm.click();;
    }

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


    function buttonEditSave() {
            var edit_button = document.getElementById("edit_button");
            var cancel_button = document.getElementById("cancel_button");
            var update_form = document.getElementById("update_form");

            if (edit_button.innerHTML === "Edit Profile") {
                edit_button.innerHTML = "Save";
                enableFormFields(update_form)
            } else {
                edit_button.innerHTML = "Save";
                update_form.action = "update/profile";
                update_form.method = "post";
                edit_button.type = "submit";
            }
        }

        function enableFormFields(form) {
          document.getElementById('name').disabled = false;
          document.getElementById('email').disabled = false;
          document.getElementById('username').disabled = false;
        }
  </script>

@endsection