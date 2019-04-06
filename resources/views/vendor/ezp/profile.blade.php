@extends('vendor.ezp.layout')
@section('title', __('Profile'))
@section('content')
<!-- <<<<<<<<<<<<<<<<<<<< My Profile Area Start >>>>>>>>>>>>>>>>>>>>>>>> -->
<div class="my_profile_area section_padding_100">
    <div class="container">
        @if (session()->has('success_message'))
        <div class="spacer"></div>
        <div class="alert alert-success text-right" dir="rtl">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if (session()->has('warning_message'))
        <div class="spacer"></div>
        <div class="alert alert-warning text-right" dir="rtl">
            {{ session()->get('warning_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="spacer"></div>
        <div class="alert alert-danger text-right" dir="rtl">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">

            <div class="col-12 col-md-3">
                <div class="profile-thumb" style="background-image: url({{ Voyager::image($user->avatar)}});"></div>
                {{-- <form class="profile-thumb-upload mt-15">
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="upload-new-thumb">
                    </div>
                </form> --}}
            </div>

            <div class="col-12 col-md-6">
                <div class="profile_form">
                    <form action="{{ route('users.update') }}" method="POST"  class="text-left">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name')}}</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                                placeholder="{{__('Name')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{__('Email Address')}}</label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                                placeholder="{{__('Email Address')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="p_number">{{__('Phone')}}</label>
                            <input type="text" class="form-control" id="p_number" placeholder="{{__('Phone')}}" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        @if (!$user->provider_id)
                            <div class="form-group">
                                <label for="create_password">{{__('Create Password')}}</label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                <small id="passwordHelpBlock" class="form-text text-muted">{{__('If you dont want to change a password, please leave blank.')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">{{__('Confirm Password')}}</label>
                                <input id="confirm_password" type="password" class="form-control" name="password_confirmation"
                                    placeholder="{{__('Confirm Password')}}">
                            </div>
                        @endif
                        <button type="submit" class="btn btn-success w-100">{{__('Update Information')}}</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="sidebar_widget_menu">
                    <nav id="sidebar_wid_menu">
                        <ul>
                            <li><a href="{{route('users.edit')}}"><i class="ti-user"></i> {{__('My Profile')}}</a></li>
                            <li><a href="{{ route('orders.index') }}"><i class="ti-menu"></i> {{__('Orders List')}}</a></li>
                            {{-- <li><a href="#"><i class="ti-headphone-alt"></i> Support</a></li> --}}
                            <li><a href="#"><i class="ti-lock"></i> {{__('Logout')}}</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< My Profile Area End >>>>>>>>>>>>>>>>>>>>>>>> -->
@endsection
