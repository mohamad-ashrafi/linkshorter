<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("All URLs") }}
                </div>
            </div>
        </div>
    </div>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="flex items-center gap-4 mb-4">
                            <input type="text" name="search" placeholder="Search by Original URL" class="form-control" value="{{ request('search') }}">
                            <select name="sort" class="form-control">
                                <option value="">Sort by Clicks</option>
                                <option value="most" {{ request('sort') == 'most' ? 'selected' : '' }}>Most clicks</option>
                                <option value="fewest" {{ request('sort') == 'fewest' ? 'selected' : '' }}>Fewest clicks</option>
                            </select>
                            <select name="users" class="form-control">
                                <option value="">all</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ request('users') == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Filter</button>
                        </div>
                    </form>

                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User Author</th>
                            <th scope="col">Short URL</th>
                            <th scope="col">Show</th>
                            <th scope="col">Click count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $link)
                            <tr>
                                <th scope="row">{{ $link->id }}</th>
                                <td>{{ $link->user->name }}</td>
                                <td>
                                    <a href="{{ route('user.redirect', ['short_url' => $link->short_url]) }}" class="bg-[#FF2D20]/10 p-1 rounded" target="_blank">
                                        {{env('APP_URL').'/'. $link->short_url }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('user.redirect', ['short_url' => $link->short_url]) }}" class="bg-[#FF2D20]/10 p-1 rounded" target="_blank">
                                        Show Main URL
                                    </a>
                                </td>
                                <td>{{ $link->getClicks() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
