<?php
if($notification->sendto == 'admin'){
$slug='/AdminPanel/';
}else{
$slug='/UserPanel';
}
?>

@component('mail::message')
{{ $notification->content }}

@if($notification->sendto =='admin')
@component('mail::button', ['url' => URL::to($slug.'ReadNotification/'.$notification->id)])
    المزيد
@endcomponent
@endif

<?php
$setting = \App\Setting::get()->keyBy('key')->all();
?>
شكراً ..
{{$setting['title']->value}}
@endcomponent
