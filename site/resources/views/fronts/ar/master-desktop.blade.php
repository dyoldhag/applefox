<div class="content-desktop-ar">

        <div class="logo text-center"><a href="{{ url('/foxit') }}"><img src="{{ asset('/images/ar/logo-black.svg') }}" alt="Applefox"></a></div>
        <div class="main-content-desktop-ar">

            <div class="main-content-desktop-img">
                 <img src="{{ asset('/images/ar/QRcode.png') }}" alt="QRcode">
            </div>
            <div class="main-content-desktop-text">
                    <h2>Fox it!</h2>
                    <h3>Scan the code with your mobile device to follow the fox. A golden reward may just be yours. </h3>

            </div>
        </div>
        <div class="main-desktop-image-fox"><img src="{{ asset('/images/ar/fox-dk.png') }}" alt="fox-dk"> </div>

        <div class="footer">
            <img class="tagline-white" src="{{ asset('/images/ar/tagline-white.png') }}" alt="Quench Your Curiosity">
            <div class="text-center">ENJOY APPLE FOX™ RESPONSIBLY 
                <div class="footer-policy"><a href="{{ url('privacy-policy') }}">PRIVACY POLICY</a> <span class="footer-policy-border">|</span> <a href="{{ url('/'.$setting->terms_link) }}">{{ $setting->terms_name }}</a></div>
            </div>
        </div>
</div>