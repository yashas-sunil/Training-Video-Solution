<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&display=swap" rel="stylesheet">
    <title></title>
    <style type="text/css">
        body {
            margin: 0 auto;
            padding: 0;
            width: 1000px;
            height: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
            overflow-y: auto;
            font-family: sans-serif;
            background-color: #f9f9f9;
        }

        .emailer {
            min-width: 800px;
            max-width: 800px;
            height: auto;
            margin: 0 auto;
            text-align: center;
            background-color: #FFF;
        }
        .logo img{
            width: 200px;
            height: auto;
            margin: 20px auto;
        }
        .invite {
            margin: 0 auto !important;
            height: auto;
            width: 100%;  
        }

        .invite h3 {
            margin: 0;
            color: #fff;
            font-size: 25px;
            text-transform: uppercase;
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            font-size: 20px;
            line-height: 30px;
            letter-spacing: 0.37em;
            text-transform: uppercase;
            color: #FFFFFF;
        }

        .invite h6 {
            color: #fff;
            font-size: 18px;
            margin: 20px auto;
            width: 65%;
            font-family: sans-serif;
            font-style: normal;
            font-weight: 800;
            font-size: 24px;
            line-height: 122.18%;
            text-align: center;
            letter-spacing: 0.015em;
            color: #FFFFFF
        }

        .invite button {
            background-color: #150F3B;
            width: 100px;
            height: 40px;
            border-radius: 5px;
            border-color: #150F3B;
            color: #fff;
            font-size: 17px;
        }

        .invite button a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            line-height: 20px;
            text-align: center;

        }

        .jk-info {
            width: 700px;
            margin: 0 auto;
        }

        .jk-info p {
            font-size: 20px;
            width: 90%;
            margin: 40px auto;
            font-style: normal;
            font-weight: 500;
            line-height: 145.68%;
            text-align: justify;
            color: #333333;
            word-spacing: 8px;
        }

        .jk-online img,
        .annviersary img,.invite img {
            width: 100%;
            margin: 0 auto;
            height: 100%;
            display: block;
        }

        .jk-online h3 {
            margin: 0 auto;
            color: #5A5F64;
            font-size: 22px;
            font-weight: 400;
        }

        .jk-online h2 {
            font-size: 24px;
            color: #5A5F64;
            font-weight: 600;
        }

        .jk-inner {
            background-color: #F7F6EE;
        }

        .jk-inner .inner {
            display: inline-block;
            margin: auto;
            border-right: 2px solid #FBDCBC;
            width: 140px;
        }

        .jk-inner #jk-in {
            border-right: none;
        }

        .jk-inner .inner p {
            display: inline;
            margin: 0 auto;
            vertical-align: super;
            font-weight: 600;
        }

        .jk-inner .inner span {
            width: 60%;
            word-break: break-word;
            display: inline-block;
            margin: 0 auto;
            text-transform: uppercase;
            font-size: 12px;
        }

        .unique {
            margin: 40px auto;
        }

        .unique h3 {
            font-family: 'Oswald';
            font-style: normal;
            font-weight: 600;
            font-size: 25px;
            line-height: 30px;
            text-align: center;
            letter-spacing: 0.015em;
            text-transform: uppercase;
            color: #000000;
            margin-bottom: 30px;
        }

        .unique ul {
            padding-left: 80px;
        }

        .unique ul li {
            text-align: left;
            font-weight: 400;
            padding: 5px;
            font-size: 20px;
            line-height: 182.18%;
            color: #333333;
        }

        .callus {
            background: rgb(253, 242, 171);
            background: linear-gradient(124deg, rgba(253, 242, 171, 1) 0%, rgba(245, 111, 47, 1) 100%);
            width: 100%;
            display: inline-block;
            height: auto;
            margin: 0 auto;
            text-align: center;
        }

        .callus .image {
            padding-top: 26px;
            width: 40%;
            float: left;
        }

        .callus .image img {
            width: 80px;
            height: auto;
        }

        .callus h1 {
            width: 60%;
            float: right;
            color: #FFFFFF;
            font-size: 30px;
            margin: 30px auto 0px;
            font-family: system-ui;
        }

        .callus h1 a {
            text-decoration: none;
            font-style: normal;
            font-weight: 700;
            line-height: 182.18%;
            color: #FFFFFF;
        }

        .copyright {
            margin: 20px;
            padding: 20px 0 25px;
        }

        .copyright p {
            float: left;
            width: 70%;
            font-style: normal;
            font-weight: 400;
            font-size: 18px;
            line-height: 127.18%;
            color: #666666;
            text-align: left;
            margin: 0;
        }

        .copyright .icon {
            float: right;
            width: 30%;
            display: inline-block;
            text-align: right;
        }

        .copyright .icon ul {
            display: inline;
            list-style: none;
        }

        .copyright .icon ul li {
            display: inline-block;
            margin: 0 10px;
            vertical-align: baseline;
        }

        .copyright .icon ul li img {
            width: auto;
            height: 20px;
        }

        .content {
            margin-top: 10px;
            text-align: center;
            border-top: 1px solid #EEEEEE;
            padding: 10px 0 20px;
        }

        .content p {
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 127.18%;
            text-align: center;
            color: #666666;
        }

        .content p a {
            color: #666666;
        }

        @media only screen and (max-width: 480px) {
            body {
                min-width: 100%;
                max-width: 100%;
            }

            .emailer {
                min-width: 90%;
                max-width: 90%;
                margin: 0 auto;
            }

            .logo img {
                width: 110px;
                height: auto;
            }

            .jk-info {
                width: auto;
            }

            .invite h3 {
                font-size: 16px;
            }

            .invite h6 {
                color: #fff;
                font-size: 16px;
                width: 95%;
                line-height:25px;
            }

            .jk-info p {
                font-size: 14px;
            }

            .unique h3 {
                font-size: 20px;
            }

            .unique ul {
                padding-left: 42px;
            }

            .unique ul li {
                padding: 2px;
                font-size: 14px;
            }

            .callus .image {
                padding-top: 0;
                float: none;
            }

            .callus .image img {
                display: none
            }

            .callus h1 {
                float: none;
                text-align: center;
                font-size: 12px;
                margin: 10px auto 10px;
            }

            .copyright {
                margin: 20px;
                padding: 0;
            }

            .copyright p {
                float: none;
                width: 100%;
                text-align: center;
                font-size: 10px;
            }

            .copyright .icon {
                float: none;
                width: 100%;
                display: block;
                text-align: center;
                margin: 0 auto;
            }

            .copyright .icon ul {
                display: inline-block;
                list-style: none;
                padding: 0;
                margin-bottom: 0;
            }

            .content p {
                font-style: normal;
                font-weight: 400;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="emailer">
        <div class="logo">
            <a href="https://online.jkshahclasses.com/" target="_blank">
            <img src="{{ asset('assets/emailer_image/logo.png') }}" alt="">
            </a>
        </div>
        <div class="annviersary">
            <img src="{{ asset('assets/emailer_image/emailer-banner.png') }}" alt="">
        </div>
        <div class="invite">
        <a href="{{route('email.redirect',['data'=>base64_encode('onine_jk_shah')])}}" target="_blank">
            <img src="{{ asset('assets/emailer_image/signup.png') }}" alt="">
        </a>
        </div>
        <div class="jk-info">
            <p><b>J.K. Shah Classes has led the commerce and CA coaching segment for more than 37 years now.</b>
                A name renowned for the country's best faculty, comprehensive study material, proven teaching
                methodology and excellent results for many years.</p>
        </div>
        <div class="jk-online">
            <img src="{{ asset('assets/emailer_image/access.png') }}" alt="">
        </div>
        <div class="unique">
            <h3>What makes us unique</h3>
            <ul>
                <li>
                    <b>Choice of Language</b>
                </li>
                <li>Stream on <b>Any Device</b></li>
                <li>Unique <b>Lecture Format</b></li>
                <li><b>Purchase any Chapter / Subject</b></li>
                <li>Integrated <b>Doubt Solving System</b></li>
                <li>Study at your <b>Place</b>, Study at your <b>Pace</b></li>
                <li>Experience a <b>Cutting-Edge Virtual Classroom</b></li>
            </ul>
        </div>
        <div class="callus">
            <div class="image">
                <img src="{{ asset('assets/emailer_image/call.png') }}" alt="">
            </div>
            <h1>CALL US: <a href="tel:+918070400900">+91 8070 400 900</a></h1>
        </div>
        <div class="copyright">
            <p>Copyrights@J.K.ShahClasses. All Rights Reserved</p>
            <div class="icon">
                <ul>
                    <li><a href="https://www.youtube.com/c/JKShahClassesOnline" target="_blank"><img src="{{ asset('assets/emailer_image/logos_youtube-icon.png') }}"></a></li>
                    <li><a href="https://www.facebook.com/officialjksc" target="_blank"><img src="{{ asset('assets/emailer_image/brandico_facebook-rect.png') }}"></a></li>
                    <li><a href="https://t.me/jkshahonline" target="_blank"><img src="{{ asset('assets/emailer_image/logos_telegram.png') }}"></a></li>
                    <li><a href="https://www.instagram.com/officialjksc" target="_blank"><img src="{{ asset('assets/emailer_image/instagram.png') }}"></a></li>
                </ul>
            </div>
        </div>
        <div class="content">
            <p>If you dont wish to receive email from us, please let us know by clicking - <a href="/unsubscribe" target="_blank"> Unsubscribe Me</a>
            </p>
        </div>
    </div>
</body>

</html>