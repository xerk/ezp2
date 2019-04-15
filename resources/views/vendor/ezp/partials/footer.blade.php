
<!-- ***** Footer Area Start ***** -->
<footer class="footer_area home-3 section_padding_100" dir="rtl">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 col-lg text-right">
                <div class="single_footer_area">
                    <div class="footer_heading mb-30">
                        <h6>{{__('About')}}</h6>
                    </div>
                    <div class="footer_content">
                        <p>{!! setting('site.description') !!}</p>
                        <p>{{__('Phone')}}: {{setting('site.phone_number_1')}}</p>
                        <p>{{__('Phone')}}: {{setting('site.phone_number_2')}}</p>
                        <p>{{__('Email Address')}}: {{setting('site.email')}}</p>
                    </div>
                    <div class="footer_social_area mt-15">
                        <a href="http://facebook.com/{{setting('site.facebook')}}" target="_blank" class="social_links facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/{{setting('site.twitter')}}" target="_blank" class="social_links twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="https://www.instagram.com/{{setting('site.instagram')}}" target="_blank" class="social_links instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/company/{{setting('site.linkedIn')}}" target="_blank" class="social_links linkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg text-right">
                <div class="single_footer_area mt-30">
                    <div class="footer_heading mb-15">
                        <h6>{{__('Download our Mobile Apps')}}</h6>
                    </div>
                    <div class="apps_download">
                        <a href="#"><img src="{{ asset('img/core-img/play-store.png') }}" alt="Play Store"></a>
                        {{-- <a href="#"><img src="{{ asset('img/core-img/app-store.png') }}" alt="Apple Store"></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
a.social_links {
    padding: 8px 14px;
    background-color: #e6e5e5;
    border-radius: 50%;
}
a.facebook:hover {
    color: #fff;
    background-color: #3b5998
}
a.twitter:hover {
    color: #fff;
    background-color: #38A1F3
}
a.linkedIn:hover {
    color: #fff;
    background-color: #0077b5
}
a.instagram:hover {
    color: #fff;
    background-color: #c32aa3
}
</style>
<!-- ***** Footer Area End ***** -->
<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
<!-- Popper js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Plugins js -->
<script src="{{ asset('js/plugins.js') }}"></script>
<!-- Active js -->
<script src="{{ asset('js/active.js') }}"></script>

