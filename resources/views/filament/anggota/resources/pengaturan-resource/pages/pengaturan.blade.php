@extends('filament.anggota.resources.pengaturan-resource.components.layout', ['active' => 'index'])

@section('content')
{{ $this->form }}

<div class="flex gap-3">
{{ $this->cancel }}
    {{ $this->save }}
</div>
@endsection
