@component('mail::message')
# New Lead: {{ $leads->name }}

{{ $leads->company }}

@component('mail::button', ['url' => '/pages/'.$leads->id.'/edit'])
View Lead
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
