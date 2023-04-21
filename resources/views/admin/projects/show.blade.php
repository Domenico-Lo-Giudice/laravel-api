@extends('layouts.app')

@section('title', $project->title)

@section('content')
<section class="card clearfix">
    <div class="card-body">
        {{-- @dump($project->type?->color) --}}
    


    {{-- <h2 class="text-muted text-secondary my-5"> {{ $project->slug }} </h2> --}}

    <p>
        <strong>Type: </strong>
        <span class="badge rounded-pill" style="background-color: {{ $project->type?->color }}"> {{ $project->type?->label }}</span>
       
    </p>
    
    <p>
        <strong>Teches: </strong>
        @forelse ($project->teches as $tech)
        {!! $tech->getBadgeHTML() !!}
        @empty
        Nessuna tech associata
        @endforelse
       
    </p>

    <figure>
        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->slug }}" width="300" class="float-start me-3 mb-1" >
    </figure>
    
    <p> <strong> Contenuto: </strong> {{ $project->text }} </p>

         
</div>
</section>
<a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-5"> Torna alla lista</a>

@endsection 