<x-filament-panels::page>

    <style>
        .bg-dashboard-info {
            background-image: url('/images/bg-dashboard-info.png');
        }
    </style>

    <div class="bg-dashboard-info bg-[#1EAAA2] rounded-lg p-2 md:p-14">
        <h1 class="font-bold text-lg md:text-3xl text-white">Selamat datang di PROMIKI JABAR</h1>
        <p class="text-xs md:text-base font-semibold text-white mt-2 mb-0">Media profil tenaga kesehatan di Indonesia yang terpusat untuk efisiensi pengelolaan data SDM kesehatan.</p>
    </div>

    <div class="mt-10">
        @if($user->anggota != null)
        <div class="flex flex-col md:flex-row space-x-0 md:space-x-6">
            <div class="flex flex-col relative w-full md:w-[55%] border border-chinese-white px-4 md:px-6 py-6 md:py-6 rounded-lg">
                <div class="flex flex-col md:flex-row ">
                    <div class="mr-auto md:mr-10 ml-auto md:ml-0"><img alt="Profile" width="229" height="283" decoding="async" data-nimg="1" class="rounded-lg" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" style="color: transparent;"></div>
                    <div class="mt-6 md:mt-0 flex-1">
                        <div class="flex flex-col border-b border-chinese-white pb-3 mb-3"><strong class="tracking-primary font-bold text-xl pr-10">{{ strtoupper($user->name) }}</strong><span>{{ $user->anggota?->pekerjaan }}</span></div>
                        <div>
                            <ul class="flex flex-col space-y-2">
                                <li class="flex space-x-3">
                                    <div class="pt-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.33329 14.1665H9.16663V14.9998C9.16663 15.2209 9.25442 15.4328 9.4107 15.5891C9.56698 15.7454 9.77894 15.8332 9.99996 15.8332C10.221 15.8332 10.4329 15.7454 10.5892 15.5891C10.7455 15.4328 10.8333 15.2209 10.8333 14.9998V14.1665H11.6666C11.8876 14.1665 12.0996 14.0787 12.2559 13.9224C12.4122 13.7661 12.5 13.5542 12.5 13.3332C12.5 13.1122 12.4122 12.9002 12.2559 12.7439C12.0996 12.5876 11.8876 12.4998 11.6666 12.4998H10.8333V11.6665C10.8333 11.4455 10.7455 11.2335 10.5892 11.0772C10.4329 10.921 10.221 10.8332 9.99996 10.8332C9.77894 10.8332 9.56698 10.921 9.4107 11.0772C9.25442 11.2335 9.16663 11.4455 9.16663 11.6665V12.4998H8.33329C8.11228 12.4998 7.90032 12.5876 7.74404 12.7439C7.58776 12.9002 7.49996 13.1122 7.49996 13.3332C7.49996 13.5542 7.58776 13.7661 7.74404 13.9224C7.90032 14.0787 8.11228 14.1665 8.33329 14.1665ZM15.8333 4.99984H14.1666V4.1665C14.1666 3.50346 13.9032 2.86758 13.4344 2.39874C12.9656 1.9299 12.3297 1.6665 11.6666 1.6665H8.33329C7.67025 1.6665 7.03437 1.9299 6.56553 2.39874C6.09668 2.86758 5.83329 3.50346 5.83329 4.1665V4.99984H4.16663C3.50358 4.99984 2.8677 5.26323 2.39886 5.73207C1.93002 6.20091 1.66663 6.8368 1.66663 7.49984V15.8332C1.66663 16.4962 1.93002 17.1321 2.39886 17.6009C2.8677 18.0698 3.50358 18.3332 4.16663 18.3332H15.8333C16.4963 18.3332 17.1322 18.0698 17.6011 17.6009C18.0699 17.1321 18.3333 16.4962 18.3333 15.8332V7.49984C18.3333 6.8368 18.0699 6.20091 17.6011 5.73207C17.1322 5.26323 16.4963 4.99984 15.8333 4.99984ZM7.49996 4.1665C7.49996 3.94549 7.58776 3.73353 7.74404 3.57725C7.90032 3.42097 8.11228 3.33317 8.33329 3.33317H11.6666C11.8876 3.33317 12.0996 3.42097 12.2559 3.57725C12.4122 3.73353 12.5 3.94549 12.5 4.1665V4.99984H7.49996V4.1665ZM16.6666 15.8332C16.6666 16.0542 16.5788 16.2661 16.4225 16.4224C16.2663 16.5787 16.0543 16.6665 15.8333 16.6665H4.16663C3.94561 16.6665 3.73365 16.5787 3.57737 16.4224C3.42109 16.2661 3.33329 16.0542 3.33329 15.8332V9.99984H16.6666V15.8332ZM16.6666 8.33317H3.33329V7.49984C3.33329 7.27882 3.42109 7.06686 3.57737 6.91058C3.73365 6.7543 3.94561 6.6665 4.16663 6.6665H15.8333C16.0543 6.6665 16.2663 6.7543 16.4225 6.91058C16.5788 7.06686 16.6666 7.27882 16.6666 7.49984V8.33317Z" fill="#242424"></path>
                                        </svg></div>
                                    <div class="flex flex-col"><strong class="font-bold">Lama bekerja</strong><span>-</span></div>
                                </li>
                                <li class="flex space-x-3">
                                    <div class="pt-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.9084 8.49189L17.0751 8.03356L9.57506 3.86689H9.48339C9.4323 3.84529 9.37929 3.82855 9.32506 3.81689H9.16673H9.01673C8.95979 3.82856 8.90402 3.84529 8.85006 3.86689H8.75839L1.25839 8.03356C1.13015 8.10624 1.02347 8.21164 0.949256 8.33901C0.87504 8.46638 0.835937 8.61115 0.835938 8.75856C0.835937 8.90597 0.87504 9.05075 0.949256 9.17811C1.02347 9.30548 1.13015 9.41088 1.25839 9.48356L3.33339 10.6336V14.5836C3.33339 15.2466 3.59679 15.8825 4.06563 16.3513C4.53447 16.8202 5.17035 17.0836 5.83339 17.0836H12.5001C13.1631 17.0836 13.799 16.8202 14.2678 16.3513C14.7367 15.8825 15.0001 15.2466 15.0001 14.5836V10.6336L16.6667 9.70023V12.0836C16.6667 12.3046 16.7545 12.5165 16.9108 12.6728C17.0671 12.8291 17.279 12.9169 17.5001 12.9169C17.7211 12.9169 17.933 12.8291 18.0893 12.6728C18.2456 12.5165 18.3334 12.3046 18.3334 12.0836V9.21689C18.3331 9.06923 18.2937 8.92429 18.219 8.7969C18.1443 8.66951 18.0371 8.56425 17.9084 8.49189ZM13.3334 14.5836C13.3334 14.8046 13.2456 15.0165 13.0893 15.1728C12.933 15.3291 12.7211 15.4169 12.5001 15.4169H5.83339C5.61238 15.4169 5.40042 15.3291 5.24414 15.1728C5.08786 15.0165 5.00006 14.8046 5.00006 14.5836V11.5586L8.75839 13.6419L8.88339 13.6919H8.9584C9.02757 13.7006 9.09756 13.7006 9.16673 13.6919C9.2359 13.7006 9.30589 13.7006 9.37506 13.6919H9.45006C9.4943 13.6826 9.53659 13.6657 9.57506 13.6419L13.3334 11.5586V14.5836ZM9.16673 11.9669L3.38339 8.75023L9.16673 5.53356L14.9501 8.75023L9.16673 11.9669Z" fill="#242424"></path>
                                        </svg></div>
                                    <div class="flex flex-col"><strong class="font-bold">Alumnus</strong><span>-</span></div>
                                </li>
                                <li class="flex space-x-3">
                                    <div class="pt-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16 7.552C15.9922 7.47851 15.9771 7.4061 15.955 7.336V7.264C15.9189 7.18174 15.8708 7.10613 15.8125 7.04L11.3125 2.24C11.2505 2.17777 11.1796 2.12646 11.1025 2.088H11.035L10.795 2H6.25C5.65326 2 5.08097 2.25286 4.65901 2.70294C4.23705 3.15303 4 3.76348 4 4.4V15.6C4 16.2365 4.23705 16.847 4.65901 17.2971C5.08097 17.7471 5.65326 18 6.25 18H13.75C14.3467 18 14.919 17.7471 15.341 17.2971C15.7629 16.847 16 16.2365 16 15.6V7.6C16 7.6 16 7.6 16 7.552ZM11.5 4.728L13.4425 6.8H11.5V4.728ZM14.5 15.6C14.5 15.8122 14.421 16.0157 14.2803 16.1657C14.1397 16.3157 13.9489 16.4 13.75 16.4H6.25C6.05109 16.4 5.86032 16.3157 5.71967 16.1657C5.57902 16.0157 5.5 15.8122 5.5 15.6V4.4C5.5 4.18783 5.57902 3.98434 5.71967 3.83431C5.86032 3.68429 6.05109 3.6 6.25 3.6H10V7.6C10 7.81217 10.079 8.01566 10.2197 8.16569C10.3603 8.31571 10.5511 8.4 10.75 8.4H14.5V15.6Z" fill="#242424"></path>
                                        </svg></div>
                                    <div class="flex flex-col"><strong class="font-bold">Nomor STR</strong><span>GL00001613642334</span></div>
                                </li>
                                <li class="flex space-x-3">
                                    <div class="pt-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 1.6665C8.23193 1.6665 6.53624 2.36888 5.286 3.61913C4.03575 4.86937 3.33337 6.56506 3.33337 8.33317C3.33337 12.8332 9.20837 17.9165 9.45837 18.1332C9.60932 18.2623 9.80141 18.3332 10 18.3332C10.1987 18.3332 10.3908 18.2623 10.5417 18.1332C10.8334 17.9165 16.6667 12.8332 16.6667 8.33317C16.6667 6.56506 15.9643 4.86937 14.7141 3.61913C13.4638 2.36888 11.7682 1.6665 10 1.6665ZM10 16.3748C8.22504 14.7082 5.00004 11.1165 5.00004 8.33317C5.00004 7.00709 5.52682 5.73532 6.46451 4.79764C7.40219 3.85996 8.67396 3.33317 10 3.33317C11.3261 3.33317 12.5979 3.85996 13.5356 4.79764C14.4733 5.73532 15 7.00709 15 8.33317C15 11.1165 11.775 14.7165 10 16.3748ZM10 4.99984C9.34077 4.99984 8.6963 5.19533 8.14814 5.56161C7.59998 5.92788 7.17273 6.44847 6.92044 7.05756C6.66815 7.66665 6.60214 8.33687 6.73076 8.98347C6.85937 9.63008 7.17684 10.224 7.64302 10.6902C8.10919 11.1564 8.70314 11.4738 9.34974 11.6025C9.99634 11.7311 10.6666 11.6651 11.2757 11.4128C11.8847 11.1605 12.4053 10.7332 12.7716 10.1851C13.1379 9.63691 13.3334 8.99244 13.3334 8.33317C13.3334 7.44912 12.9822 6.60127 12.3571 5.97615C11.7319 5.35103 10.8841 4.99984 10 4.99984ZM10 9.99984C9.6704 9.99984 9.34817 9.90209 9.07409 9.71895C8.80001 9.53582 8.58639 9.27552 8.46024 8.97098C8.3341 8.66643 8.30109 8.33132 8.3654 8.00802C8.42971 7.68472 8.58844 7.38775 8.82153 7.15466C9.05462 6.92157 9.35159 6.76284 9.67489 6.69853C9.99819 6.63422 10.3333 6.66723 10.6378 6.79337C10.9424 6.91952 11.2027 7.13314 11.3858 7.40722C11.569 7.6813 11.6667 8.00354 11.6667 8.33317C11.6667 8.7752 11.4911 9.19912 11.1786 9.51168C10.866 9.82424 10.4421 9.99984 10 9.99984Z" fill="#242424"></path>
                                        </svg></div>
                                    <div class="flex flex-col"><strong class="font-bold">Domisili</strong><span>-</span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 md:mt-0 flex-1 relative border border-chinese-white px-4 md:px-6 py-6 rounded-lg flex-col flex">
                <h3 class="text-2xl font-bold"><span>Satuan Kredit Profesi (SKP)</span></h3>
                <div><span class="text-xs text-[#4d5054]">Sumber data: SKP Platform. Data terakhir diperbarui: <strong class="text-969BA2">12 November 2024, 09:28 WIB</strong>.</span></div>
                <p class="mt-4 text-sm">Target SKP yang ditampilkan adalah jumlah pengumpulan SKP yang tervalidasi selama masa periode SIP Anda dan dapat digunakan untuk perpanjangan SIP berikutnya.</p>
                <div class="mt-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center"><strong>Target</strong></div><span class="text-xs font-semibold text-313336">0/25</span>
                    </div>
                    <div class="flex space-x-2 mt-2">
                        <div class="flex-1">
                            <div class="h-4 rounded-100  relative bg-green-water">
                                <div class="h-full rounded-100 absolute left-0 top-0 bg-primary" style="width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm mt-2">Periode pengumpulan SKP dari tanggal <strong class="font-bold">17-12-2023</strong> sampai <strong class="font-bold">16-12-2028</strong>.</p>
                </div>
            </div>
        </div>
        @else
        <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Lengkapi Profil Anda</h2>
                <p class="mx-auto mt-6 max-w-xl text-pretty text-lg/8 text-gray-600">Mohon lengkapi data profil anda untuk kebutuhan verifikasi. Tekan tombol dibawah ini atau kunjungi halaman profil.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('filament.anggota.resources.profiles.index') }}" class="rounded-md bg-primary-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Lengkapi Profil</a>
                </div>
            </div>
        </div>
        @endif
    </div>

</x-filament-panels::page>