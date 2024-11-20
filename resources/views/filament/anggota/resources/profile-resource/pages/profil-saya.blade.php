@extends('filament.anggota.resources.profile-resource.components.layout', ['active' => 'index'])

@section('content')
<div class="border border-chinese-white rounded-2xl p-4 md:p-6">
    <div class="flex justify-between items-center">
        <h3 class="text-base md:text-2xl font-semibold">Data diri</h3><a class="cursor-pointer" href="{{ route('filament.anggota.resources.profiles.edit') }}">
            <div class="flex items-center text-button-blue font-semibold space-x-1.5"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.5858 0.585786C11.3668 -0.195262 12.6332 -0.195262 13.4142 0.585786C14.1953 1.36683 14.1953 2.63316 13.4142 3.41421L12.6213 4.20711L9.79289 1.37868L10.5858 0.585786Z" fill="#2196F3"></path>
                    <path d="M8.37868 2.79289L0 11.1716V14H2.82842L11.2071 5.62132L8.37868 2.79289Z" fill="#2196F3"></path>
                </svg><span class="hidden md:flex">Ubah</span></div>
        </a>
    </div>
    <div class="flex flex-col space-y-4 mt-4 text-sm md:text-base">
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">NIK</span>
            <div class="flex items-center space-x-2"><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->nik }}</span><span class="bg-mint rounded-2xl text-white text-xs font-semibold py-0.5 px-1.5">Tervalidasi</span></div>
        </div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Nama</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->nama }}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Tempat/tanggal lahir</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->tempat_lahir }}, {{ $anggota?->tanggal_lahir }}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Jenis kelamin</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->jk }}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Agama</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->agama }}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Golongan Darah</span><span class="font-semibold flex-1 md:pl-12">{{$anggota?->gd}}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">DPC</span><span class="font-semibold flex-1 md:pl-12">{{$anggota?->dpc}}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Provinsi</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->provinsi }}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Kota/kabupaten</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->kab }}</span></div>
        <div class="flex flex-col md:flex-row"><span class="w-full md:w-[320px]">Alamat domisili</span><span class="font-semibold flex-1 md:pl-12">{{ $anggota?->alamat }}</span></div>
    </div>
</div>
@endsection