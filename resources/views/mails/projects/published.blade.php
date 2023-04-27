<x-mail::message>
# {{ $published_text }}
## {{ $project->title }}

<p>
    {{ $project->getAbstract(100) }}
</p>
 
@if ($project->is_published)
 <x-mail::button :url="env('APP_FRONTEND_URL') . '/projects/' . $project->slug">
    View Project
 </x-mail::button>
 @endif
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            background-color: antiquewhite; 
        }
    </style>
</head>
<body>
    <h1>{{ $published_text }}</h1>
    <h2>{{ $project->title }}</h2>
    <p>{{ $project->getAbstract(100)}}</p>

</body>
</html> --}}

