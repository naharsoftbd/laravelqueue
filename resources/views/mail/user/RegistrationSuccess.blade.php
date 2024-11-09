<x-mail::message>
# Introduction

The body of your message.
{{$data->name}}

<x-mail::button :url="''">
Registration Success 
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
