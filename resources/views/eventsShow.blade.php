<x-main-layout>
    <div class="m-2 p-2 flex justify-between">
        <h3 class="mb-4 text-2xl font-bold text-indigo-700">{{ $event->title }}</h3>
        <div class="flex space-x-2">
            From:
            <span class="mx-2 text-light text-white">{{ $event->start_date->format('m/d/Y') }}</span> | <span class="mx-2 text-white">{{ $event->end_date->format('m/d/Y') }}</span>
        </div>
    </div>

    <div class="mb-16 flex flex-wrap">
        <div class="w-full lg:w-6/12 lg:pr-6">
            <div class="mb-6">
                <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20" data-te-ripple-init data-te-ripple-color="light">
                    <img src="{{ asset('/images/' . $event->image) }}" class="w-full text-white" alt="Event Image" />
                    <a href="#!">
                        <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
                    </a>
                </div>
                @auth
                    <div class="mt-4 flex justify-between">
                        <button type="button" @click="onHandleAttending" class="text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 {{ $attending ? 'bg-indigo-700 hover:bg-indigo-800' : 'bg-slate-400 hover:bg-slate-500' }}">
                            Attending
                        </button>
                    </div>
                @endauth
                <div class="flex flex-col p-4 mt-6 bg-slate-200 rounded-md">
                    <span class="text-indigo-600 font-semibold">Host Info</span>
                    <div class="flex space-x-4 mt-4">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <div class="flex flex-col">
                            <span class="text-2xl">{{ $event->user->name }}</span>
                            <span class="text-2xl">{{ $event->user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-6/12 lg:pl-6 bg-slate-50 rounded-md p-2">
            <p class="mb-6 text-sm text-yellow-600 dark:text-neutral-400">Start: <time>{{ $event->start_time }}</time></p>
            <p class="mb-6 mt-4 text-neutral-500 dark:text-neutral-300">{{ $event->description }}</p>
            <div class="flex justify-end">
                <div class="flex flex-col">
                    <div class="text-yellow-700">{{ $event->address }}</div>
                </div>
            </div>
        </div>
    </div>

</x-main-layout>
