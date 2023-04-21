@extends('layouts.app')

@section('title', $project->title)

@section('actions')
<div>
  <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">
    Torna alla lista progetti
  </a>
</div>
@endsection

@section('content')
    <section class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data"> 
                @method('put')
                @csrf

                
        <div class="row mb-3">
            <div class="col-md-2 text-end">
                <label for="title" class="form-label">Titolo</label>
            </div>
            <div class="col-md-10">
                <input type= "text" name = "title" id = "title" class="form-control"/>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2 text-end">
                <label for="type_id" class="form-label">Type</label>
            </div>
            <div class="col-md-10">
                <select name = "type_id" id = "type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Nessun Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                    @endforeach
                  </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-2 text-end">
                <label for="type_id" class="form-label">Teches</label>
            </div>
            <div class="col-md-10">
                @foreach ($teches as $tech)
                    <input type="checkbox" id="tech-{{ $tech->id }}" value="{{ $tech->id }}" name="teches[]" 
                        class="form-check-control" @if(in_array($tech->id, old('teches', $project_teches ?? []))) checked @endif> 
                    <label for="tech-{{ $tech->id }}">{{ $tech->label }}</label>
                    <br>
                @endforeach



            </div>
        </div>

    
        <div class="row mb-3">
            <div class="col-md-2 text-end">
                <label for="title" class="form-label">Immagine</label>
            </div>
            <div class="col-md-10">
                <input type= "file" name = "image" id = "image" value ="{{ $project->image }}" class="form-control"/>
            </div>
        </div>
    
        <div class="row mb-3">
            <div class="col-md-2 text-end">
                <label for="text" class="form-label">Testo</label>
            </div>
            <div class="col-md-10">
                <textarea type= "text" name = "text" id = "text" class="form-control" rows="5">{{ $project->text }}</textarea>
            </div>
        </div>
                
                <div class="row">
                    <div class="offset-2 col-8">
                        <input type= "submit" class="btn btn-primary" value="Salva"/>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection