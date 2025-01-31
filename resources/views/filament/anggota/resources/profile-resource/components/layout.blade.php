<x-filament-panels::page>
    <div class="mx-auto w-full mt-4 md:mt-12">
        <div class="flex flex-col space-y-4 md:space-y-6">
            <div class="rounded-2xl border border-chinese-white">
                <div id="canvas-container"></div>
                <div class="bg-white rounded-2xl relative h-[236px] flex items-center"><img alt="Banner Profile" loading="lazy" width="1176" height="236" decoding="async" data-nimg="1" class="overflow-hidden h-[236px] w-full object-cover rounded-2xl absolute top-0 left-0 object-right" style="color:transparent" src="{{asset('/images/banner-profile-white.5f50c65d.png')}}">
                    <div class="px-6 flex relative flex-col">
                        <div class="flex relative z-0 items-center">
                            @livewire('avatar-uploader')
                            <div class="pl-4 md:pl-12 flex-1"><strong class="text-lg md:text-32 font-semibold flex items-center space-x-2"><span>{{$anggota?->nama}}</span></strong><span class="text-xs md:text-base text-granite-grey">{{$anggota?->pekerjaan}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="overflow-x-auto hide-scrollbar border-b-2 md:border-b-0">
                    <ul class="flex border-b-0 md:border-b-2 space-x-3 md:space-x-6 flex-nowrap md:flex-wrap">
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'index' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.index') }}"><span class="whitespace-nowrap">Data diri</span></a>
                        </li>
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'str' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.str') }}"><span class="whitespace-nowrap">STR</span></a>
                        </li>
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'serkom' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.serkom') }}"><span class="whitespace-nowrap">Serkom</span></a>
                        </li>
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'pekerjaan' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.pekerjaan') }}"><span class="whitespace-nowrap">Pekerjaan</span></a>
                        </li>
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'pendidikan' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.pendidikan') }}"><span class="whitespace-nowrap">Pendidikan</span></a>
                        </li>
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'sumprof' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.sumprof') }}"><span class="whitespace-nowrap">Sumprof</span></a>
                        </li>
                        <li class="-mb-0.5">
                            <a class="whitespace-nowrap text-base md:font-semibold px-2 md:px-4 py-2 flex border-b-2 {{ ($active??null) == 'kta-siporlin' ? 'text-primary-500 border-primary-500' : 'text-sonic-silver border-transparent' }}" href="{{ route('filament.anggota.resources.profiles.kta-siporlin') }}"><span class="whitespace-nowrap">KTA Siporlin</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</x-filament-panels::page>