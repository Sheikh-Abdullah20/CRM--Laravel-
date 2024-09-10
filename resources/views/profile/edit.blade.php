@extends('layouts.app')

@section('title')
CRM - Profile
@endsection

@section('content')

<div class="d-flex justify-content-between">
    <h1>Profile</h1>
    <a href="{{ route('dashboard') }}" class="btn">Back</a>
</div>

<div class="row my-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h5 class="title">Edit Profile</h5>
            </div>
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-md-5 pr-md-1">
                    <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control"  placeholder="Company" value="{{ $user->company }}">
                    </div>
                  </div>
                  <div class="col-md-3 px-md-1">
                  </div>
                  <div class="col-md-4 pl-md-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" placeholder="Company" value="{{ $user->first_name }}">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" placeholder="Last Name" value="{{ $user->last_name }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" placeholder="Home Address" value="{{ $user->address }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" placeholder="City" value="{{ $user->city }}">
                    </div>
                  </div>
                  <div class="col-md-4 px-md-1">
                    <div class="form-group">
                      <label>Country</label>
                      <input type="text" class="form-control" placeholder="Country" value="{{ $user->country }}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>About Me</label>
                      <textarea rows="4" cols="80" class="form-control" placeholder="About You" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-fill btn-primary">Save Changes</button>
            </div>
          </div>
    </div>


    <div class="col-md-4">
        <div class="card card-user">
          <div class="card-body">
            <p class="card-text">
              <div class="author">
                <div class="block block-one"></div>
                <div class="block block-two"></div>
                <div class="block block-three"></div>
                <div class="block block-four"></div>
                <a>
                  <img class="avatar" src="../assets/img/emilyz.jpg" alt="...">
                  <h5 class="title">Mike Andrew</h5>
                </a>
                <p class="description">
                  Ceo/Co-Founder
                </p>
              </div>
            </p>
            <div class="card-description">
              {{ $user->about }}
            </div>
          </div>

        </div>
      </div>

</div>
@endsection