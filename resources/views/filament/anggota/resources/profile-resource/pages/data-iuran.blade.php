@extends('filament.anggota.resources.profile-resource.components.layout', ['active' => 'iuran'])

@section('content')
<div class="border border-chinese-white rounded-2xl p-4 md:p-6">
    {{ $this->table }}
</div>
@endsection