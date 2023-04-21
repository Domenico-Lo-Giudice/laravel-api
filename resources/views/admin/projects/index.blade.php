@extends('layouts.app')


@section('title', 'Projects')

@section('actions')
<div>
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
    Aggiungi nuovo progetto
  </a>
</div>
@endsection

@section('content')
<section class="card">

  <div class="card-body">


    <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Titolo</th>
              <th scope="col">Type</th>
              <th scope="col">Teches</th>
              <th scope="col">Abstract</th>
            </tr>
          </thead>
          <tbody>

            @forelse($projects as $project)

            <tr>
              <th scope="row">{{ $project->id }}</th>
              <td>{{ $project->title }}</td>
              <td>{{ $project->type?->label }}</td>
              <td> @forelse($project->teches as $tech) {{ $tech->label }} @if (!$loop->last), @endif  @empty - @endforelse</td>
              <td>{{ $project->getAbstract() }}</td>
              <td>
                <a href="{{ route('admin.projects.show', $project)}}">
                    <i class="bi bi-eye mx-2"></i>
                </a>

                <a href="{{ route('admin.projects.edit', $project)}}">
                  <i class="bi bi-pencil mx-2"></i>
              </a>


              <a href="{{ route('admin.projects.edit', $project)}}" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete-project-modal-{{ $project->id}}">
                <i class="bi bi-trash mx-2"></i>
            </a>

              </td>
            </tr>
            @empty   
            @endforelse

          </tbody>
      </table>

      {{ $projects->links() }}
    </div>

</section>

@endsection

@section('modals')
  @foreach ($projects as $project)

  <div class="modal modal-lg fade" id="delete-project-modal-{{ $project->id }}" tabindex="-1" 
    aria-labelledby="delete-project-modal-{{ $project->id }}-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="delete-project-modal-{{ $project->id}}-label">Delete Project</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Sei sicuro di voler eliminare il progetto "{{ $project->title}}"? 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
          <form method="POST" action="{{ route('admin.projects.destroy', $project) }}">
          @method('delete')
          @csrf

            <button type="submit" class="btn btn-danger">Elimina</button>
          </form>

          
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection