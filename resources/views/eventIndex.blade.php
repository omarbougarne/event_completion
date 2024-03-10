<x-main-layout>
    <!-- component -->
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All Events</h1>
            <div class="p-4">
                <form class="flex items-center justify-between" action="{{ route('events.index') }}" method="GET">
                    <input type="text" name="query" placeholder="Search..." class="px-4 py-2 rounded-l-lg border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ request('query') }}">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($categories as $category)
                    <div class="lg:flex bg-slate-100 rounded-md text-black">
                        <h2 class="text-xl font-semibold text-gray-800 hover:underline">{{ $category->name }}</h2>
                        <div class="flex flex-col justify-between py-6 lg:mx-6">
                            <ul>
                                @foreach ($category->events as $event)
                                    <li>
                                        <a href="{{ route('eventShow', $event->id) }}" class="text-lg font-semibold text-gray-800 hover:underline">{{ $event->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-main-layout>
