<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>caretraxx</title>
    <style>
        /* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTa-j2U0lmluP9RWlSytm3ho.woff2) format('woff2');
            unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
        }
        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTZX5f-9o1vgP2EXwfjgl7AY.woff2) format('woff2');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTRWV49_lSm1NYrwo-zkhivY.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }
        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTaaRobkAwv3vxw3jMhVENGA.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }
        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTf8zf_FOSsgRmwsS7Aa9k2w.woff2) format('woff2');
            unicode-range: U+0102-0103, U+1EA0-1EF1, U+20AB;
        }
        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTT0LW-43aMEzIO6XUTLjad8.woff2) format('woff2');
            unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v13/DXI1ORHCpsQm3Vp6mXoaTegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }
        /* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/K88pR3goAWT7BTt32Z01mxJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
            unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
        }
        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/RjgO7rYTmqiVp7vzi-Q5URJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/LWCjsQkB6EMdfHrEVqA1KRJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }
        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/xozscpT2726on7jbcb_pAhJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }
        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/59ZRklaO5bWGqF5A9baEERJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
            unicode-range: U+0102-0103, U+1EA0-1EF1, U+20AB;
        }
        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/u-WUoqrET9fUeobQW7jkRRJtnKITppOI_IvcXXDNrsc.woff2) format('woff2');
            unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3VtXRa8TVwTICgirnJhmVJw.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }
        /* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzK-j2U0lmluP9RWlSytm3ho.woff2) format('woff2');
            unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
        }
        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzJX5f-9o1vgP2EXwfjgl7AY.woff2) format('woff2');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzBWV49_lSm1NYrwo-zkhivY.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }
        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzKaRobkAwv3vxw3jMhVENGA.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }
        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzP8zf_FOSsgRmwsS7Aa9k2w.woff2) format('woff2');
            unicode-range: U+0102-0103, U+1EA0-1EF1, U+20AB;
        }
        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzD0LW-43aMEzIO6XUTLjad8.woff2) format('woff2');
            unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 700;
            /* src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v13/k3k702ZOKiLJc3WVjuplzOgdm0LZdjqr5-oayXSOefg.woff2) format('woff2'); */
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(k3k702ZOKiLJc3WVjuplzOgdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }
        body {
            font-family: 'Open Sans', sans-serif;
            background: #EEE;
            margin: 0;
            padding: 0;
        }


        a {}
        a:link, a:visited {
            text-decoration: none;
            color: #0059B2;
        }
        a:focus, a:hover {
            text-decoration: underline;
            outline: none;
        }
        a:active, a.active {
            color: #2EAD59;
        }

        h1 {
            font-size: 24px;
            font-weight: 300;
        }
        h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 300;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 12px 0 0 12px;
            background: rgba(0,0,0,.3);
            overflow: hidden;
            height: 57px;
            box-shadow: 0px 3px 3px 0px rgba(0,0,0,.3);
            z-index:2;
            transition: height 400ms;
        }
        header.open {
            height: 100%;
            z-index: 4;
        }
        header .background {
            position: absolute;
            background: #FFF;
            top: 0;
            left: 0;
            width: 100%;
            height: 45px;
            padding: 12px 0 12px 12px;
            z-index: -1;
            box-shadow: 0px 3px 3px 0px rgba(0,0,0,.3);
        }
        header .logo {
            float: left;
            margin-right: 20px;
        }
        header .logo img {
            display: block;
        }
        header h2 {
            float: left;
            font-size: 24px;
            font-weight: 300;
            line-height: 42px;
        }
        header .loggedin-yes {
            float: right;
            line-height: 42px;
            margin-right: 69px;
            padding-right: 12px;
            border-right: 1px solid #e5e5e5;
        }
        header nav {
            float: right;
        }
        header nav:before {
            position: absolute;
            content: '';
            display: block;
            width: 69px;
            height: 69px;
            right: 0;
            top: 0;
            text-align: center;
            line-height: 69px;
            background: url(img/hamburger.png) no-repeat center center;
        }
        header nav ul {
            position: absolute;
            top: 53px;
            right: 0px;
            width: 250px;
            padding: 20px;
            background: #FFF;
            height: 100%;
            box-shadow: 0px 3px 3px 0px rgba(0,0,0,.3);
            display: none;
        }
        header.open nav ul {
            display: block;
        }
        header nav li {
            display: block;
        }
        header nav li a {
            display: block;
            line-height: 42px;
            font-size: 20px;
            font-weight: 300;
            padding: 10px 20px;
        }
        header nav li a:hover,
        header nav li a:focus {
            text-decoration: none;
            outline: 1px solid #0059B2;
        }

        #pin-bar {
            position: fixed;
            top: 70px;
            width: 100%;
            background: #FFF;
            z-index: 3;
            box-shadow: 0px 3px 3px 0px rgba(0,0,0,.3);
            font-size: 12px;
            padding: 3px;
        }
        #pin-bar a {
            line-height: 16px;
        }
        #pin-bar .item {
            padding: 3px 10px;
            border: 1px solid #E5E5E5;
            float: left;
            margin-left: 5px;
            cursor: pointer;
            border-radius: 4px;
        }
        #pin-bar .item a,
        #pin-bar .item a:hover,
        #pin-bar .item a:focus {
            text-decoration: none;
        }

        #pin-bar .item.active:hover {
            border: 1px solid #2EAD59;
        }
        #pin-bar .item.active a {
            color:#2EAD59;
        }

        #pin-bar .item:hover,
        #pin-bar .item:focus {
            text-decoration: none;
            border: 1px solid #0059B2;
        }
        #pin-bar .pin {
            width: 16px;
            height: 16px;
            display: inline-block;
            background: url(img/sprite.png) no-repeat 0 0;
            vertical-align: top;
            margin-left: 6px;
            margin-right: -6px;
            border-radius: 3px;
        }
        #pin-bar .pin:hover,
        #pin-bar .pin:focus {
            background: #0059B2 url(img/sprite.png) no-repeat 0 -32px;
        }
        #pin-bar .pin-view {
            position: absolute;
            right: 10px;
            top: 40px;
        }
        #pin-bar .pin-view a:after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            background: url(img/sprite.png) no-repeat -16px 0;
            vertical-align: top;
            margin-left: 4px;
        }

        .feedback {
            position: fixed;
            right: 10px;
            bottom: 10px;
            z-index: 5;
            font-size: 12px;
            line-height: 16px;
        }

        .feedback a:after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            background: url(img/sprite.png) no-repeat -32px 0;
            vertical-align: top;
            margin-left: 4px;
        }

        .container {
            position: fixed;
            top: 0px;
            left: 50%;
            width: 1280px;
            height: 100%;
            margin-left: -640px;
        }

        section {
            position: relative;
            display: block;
            height: 400px;
            background: #FFF;
            margin: 182px 40px 0 290px;
            left: 0;
            right: 0;
            padding: 5px;
            box-shadow: 0px 3px 3px 0px rgba(0,0,0,.3);
        }
        section.notabs {
            margin: 182px 40px 0;
        }
        section h1 {
            position: absolute;
            top: -90px;
        }
        section img {
            margin-top: -40px;
        }
        section ul.tabs {
            position: absolute;
            left: -250px;
            top: 20px;
            padding: 0;
            margin: 0;
        }
        section ul.tabs li {
            display: block;
            width: 225px;
            background: #FCFCFC;
            padding: 0 12px;
            line-height: 42px;
            margin-bottom: 8px;
            box-shadow: -1px 2px 1px -1px rgba(0,0,0,.2);
            border-right: 1px solid #E5E5E5;
        }
        section ul.tabs li.active {
            background: #FFF;
            box-shadow: -1px 3px 2px -1px rgba(0,0,0,.3);
            border-right: 1px solid #FFF;
        }
        section ul.tabs li a{
            display: block;
        }
        section .initial {
            padding-top: 50px;
            width: 600px;
            margin: 0 auto;
            position: relative;
        }
        section .slide {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100%;
            height: 100%;
            padding: 40px;
            box-shadow: 0px 3px 5px 1px rgba(0,0,0,.3);
            box-sizing: border-box;
            background: #FFF;
        }
        section a.button-large {
            text-align: center;
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto;
            padding: 25px 12px;
            border: 1px solid #E5E5E5;
            border-radius: 10px;
            box-sizing: border-box;
        }
        section a.button-large:hover,
        section a.button-large:focus {
            text-decoration: none;
            border: 1px solid #0059B2;
            outline: none;
        }

        section a.button-large img {
            display: block;
            margin: 0 auto;
        }

        .login {
            width: 300px;
            margin: 0 auto;
        }
        .login button {
            float: right;
        }
        .login a {
            font-size: 12px;
        }

        label {
            margin-bottom: 24px;
            display: block;
            font-size: 20px;
            font-weight: 300;
            box-sizing: border-box;
        }

        input, select {
            display: block;
            padding: 5px 10px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #000;
            font-size: 20px;
            font-weight: 300;
            font-family: 'Open Sans', sans-serif;
        }
        input:focus, input:hover {
            outline: none;
            border: 1px solid #0059B2;
            color: #0059B2;
        }

        button {
            display: block;
            padding: 5px 10px;
            border: 1px solid #0059B2;
            color: #0059B2;
            background: #FFF;
            box-sizing: border-box;
            font-size: 20px;
            font-weight: 300;
            font-family: 'Open Sans', sans-serif;
        }
        button:focus, button:hover {
            outline: none;
            border: 1px solid #0059B2;
            background: #0059B2;
            color: #fff;
        }
        .col-half {
            float: left;
            width: 50%;
        }
        .col-third {
            float: left;
            width: 33.333333333%;
        }

        .breadcrums {
            position: absolute;
            top: -32px;
        }

        .chartcontainer {
            width: 100%;
            height: 100%;
        }

        .chartcontainer.half {
            width: 344px;
            float: left;
        }
        .chartcontainer.quart {
            width: 344px;
            height: 50%;
            float: left;
        }
        .chartcontainer.hex {
            width: 33%;
            height: 50%;
            float: left;
        }

        .dataselection {
            position: absolute;
            z-index: 1;
            right: 20px;
            top: 20px;
        }

        .dataselection select {
            display: inline-block;
            width: auto;
        }

        .patient-comments {
            padding: 20px;
            width: 100%;
            height: 320px;
            box-sizing: border-box;
            line-height: 30px;
            font-size: 18px;
            font-weight: 300;
            font-family: 'Open Sans', sans-serif;
            resize: none;
        }
        .legend {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .close-x {
            position: absolute;
            right: 20px;
            top: 20px;
        }
    </style>
    <style>
        #chat_conversations{
            position: relative;
            width:100%;
            height: 100%;
            background: #ffffff;
            overflow: scroll;
        }
        #chat_conversations table {
            width: 100%;
        }

        #chat_conversations th {
            height: 50px;
            text-align: left;
        }
        #chat_conversations td {
            height: 50px;
            vertical-align: bottom;
        }
    </style>
</head>
<body>
<?php echo $__env->make('layouts.header', ['some' => 'data'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="pin-bar" class="loggedin-yes">

    <div class="item">
        <a href="/">Home</a>
    </div>

    <div class="item">
        <a href="/newchat">
            Create a new Chat
        </a>
        <a href="" class="pin"></a>
    </div>

    <div class="pin-view">
        <a href="">pin current view</a>
    </div>
</div>
<div class="container">
    <section id="main" class="notabs">
        <div id="chat_conversations">
            <table class="table">
                <tr>
                    <th>Participants</th>
                    <th>Last Message</th>
                    <th>Timestamp</th>
                </tr>



                <?php foreach($participants as $num=>$participant): ?>
                    <?php /**/ $allParticipants = $participant->allParticipants($participant->conversation_id) /**/ ?>
                <?php
                        foreach($allParticipants as $usr){
                            if($participant->cid != $usr['cid']){
                                $user['first_name'] = $usr['first_name'];
                                $user['last_name'] = $usr['last_name'];
                            }
                        }
                ?>
                    <?php foreach($participant->conversations as $num2=>$conversation): ?>
                        <tr>
                        <td>
                            <a href="chat/<?php echo e($conversation->id); ?>"><?php echo e($user['first_name']); ?> <?php echo e($user['last_name']); ?></a>,
                        </td>
                        <td><?php echo e($conversation->messages->last()['content']); ?></td>
                        <td><?php echo e($conversation->messages->last()['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </section>
</div>
</body>
</html>