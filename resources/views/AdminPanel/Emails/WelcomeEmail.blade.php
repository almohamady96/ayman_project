@component('mail::message')
مرحباً {{$user->name}} .. سعداء بإضمامك لنا

<br>
<?php
$setting = \App\Setting::get()->keyBy('key')->all();
?>
{{$setting['title']->value}}
@endcomponent
