<!-- code added on 4-12-2024 -->
 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NG6VFD77');</script>
<!-- End Google Tag Manager -->


<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1327929011922596');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1327929011922596&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->



<!-- code commented on 04-12-2024 -->
<!-- Meta Pixel Code -->
<!-- <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '772927708313682');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=772927708313682&ev=PageView&noscript=1"/>
</noscript> -->
<!-- End Meta Pixel Code -->
       

<!-- Google Tag Manager -->
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KB6KS2FC');</script> -->
<!-- End Google Tag Manager -->
    
<!-- Google tag (gtag.js) -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-2BDG0W6FYL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2BDG0W6FYL');
</script> -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google-site-verification" content="JSzzejJb5u6Cwd546yUxvBUX5YaFoO7S2dly7SlSkuw" />
@stack('meta-tags')
@include('partials.styles')
{!! SEOMeta::generate() !!}
@if(SEOMeta::getCanonical() == '')<link rel="canonical" href="{{url()->full()}}"/>
@endif
<link rel="apple-touch-icon" sizes="180x180" href="{{url('assets/images/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url('assets/images/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/images/favicon-16x16.png')}}">
<style>
    #step-three .s-submit {
        float: none;
        margin: 0 auto !important;
    }

    #step-one .s-custom-next, #step-two .s-custom-signup, #step-three .s-custom-submit {
        background: #e78c60;
        border-radius: 30px;
        font-weight: bold;
        font-size: 15px;
        color: #000;
        float: right;
        padding: 10px 15px;
        border: none;
        min-width: 100px;
        outline: none;
        display: block;
        margin-bottom: 20px;
        text-align: center;
        cursor: pointer;
    }
    #step-three .s-after-submit {
        background: grey;
        border-radius: 30px;
        font-weight: bold;
        font-size: 15px;
        color: #000;
        float: right;
        padding: 10px 15px;
        border: none;
        min-width: 100px;
        outline: none;
        display: block;
        margin-bottom: 20px;
        text-align: center;
        cursor: pointer;
    }
      .navbar {
           position: relative;
       }

    .feedback-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .feedback-item {
        width: 90px;
        height: 90px;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
    }
    .feedback-radio {
        display: none;
    }
    .feedback-radio ~ span {
        font-size: 3rem;
        filter: grayscale(100);
        cursor: pointer;
        transition: 0.3s;
    }

    .feedback-radio:checked ~ span {
        filter: grayscale(0);
        font-size: 4rem;
    }

    #step-two .s-next, #step-attempt-year .s-attempt-year-next, #step-two .s-signup, #step-three .s-submit {
        background: #E78C60;
        border-radius: 30px;
        font-weight: bold;
        font-size: 15px;
        color: #000;
        float: right;
        padding: 10px 15px;
        border: none;
        min-width: 100px;
        outline: none;
        display: block;
        margin-bottom: 20px;
        text-align: center;
        cursor: pointer;
    }
    .capture-screen-button{
        position: fixed;
        left: 0px;
        padding: 10px;
        background: #007bff;
        bottom: 2.5vh;
        z-index: 99;
        border-top-right-radius: 7px;
        border-bottom-right-radius: 7px;
    }
    .capture-screen-button button{
        border: 0;
        background: #007bff;
        color: #fff;
    }
    /*.d-none{*/
    /*    display: none !important;*/
    /*}*/
</style>
