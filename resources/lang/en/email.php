<?php
$setting = \App\Setting::get()->keyBy('key')->all();

return [
    'welcome'=>' welcome ..',
    'ops'=>' sorry ..  ',
    'site'=>'TechnoMasr',
    'footer'=>$setting['copyrights_'.session('lang')]->value,
    'restPassword'=>' Reset password ',
    'haveProblem'=>' if you have a problem in clicking on the button ',
    'copyLink'=>' copy this link and paste it in your browser ',
    'thanks'=>' thanks  ',
    'follow'=>' please follow the link ',

    /*
    ===================================================
                        WelcomeEmail
    ===================================================
    */
    'proud'=>' Pleased to your choice  ',
    'login_msg'=>' Please login to access our services ',
    'login'=>' login ',


    /*
    ===================================================
                        WelcomeGuest
    ===================================================
    */

    'guest_msg'=>' You will be notified with every new in our site ',
    'go'=>' see more ',


    /*
    ===================================================
                        CancelSubscribe
    ===================================================
    */

    'cancel_msg'=>' Your subscription to the site has been canceled. You will not receive any more messages , you can resubscribe to again when you want ',



    /*
    ===================================================
                        UpdateSubscribe
    ===================================================
    */

    'update_msg'=>' Your subscription has been modified for another email. You will not receive more messages from our website ',



    /*
    ===================================================
                     ForgetPasswordEmail
    ===================================================
    */




    /*
    ===================================================
                         SendEmail
    ===================================================
    */
    'home' => 'Home',


];