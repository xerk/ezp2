@extends('vendor.ezp.layout')
@section('title', __('Terms & Conditions'))
@section('content')
<section class="about_us_area section_padding_100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="about_us_content">
                    {!! setting('site.terms') !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
