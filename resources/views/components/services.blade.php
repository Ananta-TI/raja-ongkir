<!-- =========== services Section Start =========== -->
<section class="py-20">
    <div class="container">
        <div>
            <h2 class="md:text-3xl text-xl font-semibold my-5">What I Do</h2>
            <p class="text-slate-400 font-medium">Connecting brands and companies with their customers through <span class="text-red-500">good design</span>.</p>
        </div>

        <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6 pt-14">
            @foreach ($services as $service)
                <div class="group" data-aos="fade-up" data-aos-duration="{{ 600 + $loop->index * 300 }}">
                    <div class="p-6 rounded-md shadow group-hover:shadow-lg transition-all duration-500">
                        <div class="w-12 h-12 bg-red-500/10 flex items-center justify-center rounded-tr-xl rounded-bl-xl group-hover:rounded-tr-none group-hover:rounded-bl-none group-hover:rounded-tl-xl group-hover:rounded-br-xl transition-all duration-500">
                            <svg class="w-8 h-8 text-red-500" viewBox="0 0 24 24" xmlns="<http://www.w3.org/2000/svg>">
                                <!-- Ganti dengan path ke ikon yang sesuai -->
                                <use xlink:href="{{ asset($service['icon']) }}#icon"></use>
                            </svg>
                        </div>
                        <h4 class="text-lg mt-6">{{ $service['title'] }}</h4>
                        <p class="text-base text-slate-400 leading-7 mt-2">{{ $service['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- =========== services Section End =========== -->
