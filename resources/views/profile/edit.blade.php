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
              <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>Company</label>
                      <input type="text" class="form-control" name="company"  placeholder="Company" value="{{ $user->company }}">
                      @error('company')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-8 ">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
                      @error('email')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ $user->first_name }}">
                    </div>
                  </div>
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}">
                      @error('last_name')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" name="address" placeholder="Home Address" value="{{ $user->address }}">
                      @error('address')
                      <span class="text-danger">
                        {{ $message }}
                      </span>
                    @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pr-md-1">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" class="form-control" name="city" placeholder="City" value="{{ $user->city }}">
                      @error('city')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4 px-md-1">
                    <div class="form-group">
                      <label>Country</label>
                      <input type="text" class="form-control" name="country" placeholder="Country" value="{{ $user->country }}">
                      @error('country')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>About Me</label>
                      <textarea rows="4" cols="80" name="about" class="form-control" placeholder="About You">{{ $user->profile->about  ?? ''}}</textarea>
                    </div>
                  </div>
                </div>
                
                {{-- Hidden File Input --}}
                <input type="file" onchange="document.getElementById('preview').src= window.URL.createObjectURL(this.files[0])" hidden class="form-control" name="image" id="file">
                {{-- Hidden File Input --}}


            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-fill btn-primary">Save Changes</button>
            </div>
          </form>
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
                  @if(!empty($user->profile->profile))
                  <img class="avatar" id="preview" src="{{ "storage/user_profile/" . $user->profile->profile }}" alt="...">
                  @else
                  <img class="avatar" id="preview" src="https://via.placeholder.com/350x150" alt="...">
                  @endif
                  @if(!empty($user->profile->profile))
                  <button class="btn btn-fill btn-primary mb-3" id="upload">Change Profile</button>
                  @else
                  <button class="btn mb-3" id="upload">Upload Profile</button>
                  @endif
                  <h5 class="title">{{ $user->first_name .'  '. $user->last_name }}</h5>
                </a>
                <p class="description">
                  {{ $user->company }}
                </p>
              </div>
            </p>
            <div class="card-description">
              @if(!empty($user->profile->about))
              {{ $user->profile->about }}
              @else
             
              @endif
            </div>
          </div>

        </div>
      </div>

</div>
@endsection

@section('scripts')

<script>
  document.getElementById('upload').addEventListener('click',function(){
    document.getElementById('file').click();
  });
</script>

@endsection