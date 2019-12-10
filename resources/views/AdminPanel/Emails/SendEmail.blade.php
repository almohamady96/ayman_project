@component('mail::message')
{{$message->title}}

{!! html_entity_decode($message->content)  !!}

<?php
$setting = \App\Setting::get()->keyBy('key')->all();
?>
{{$setting['title']->value}}
@endcomponent
