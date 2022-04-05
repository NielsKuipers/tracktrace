@extends('layouts.app', ['title' => 'Packages'])

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col">
            <div class="relative flex lg:inline-flex items-center py-1">
                <p class="text-2xl mr-auto font-bold">Packages</p>
                <form method="get" action="#">
                    <input type="text" name="search" placeholder="Search..."
                           class="bg-transparent placeholder-black font-semibold text-sm"
                           value="{{ request('search') }}">
                </form>
            </div>

            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="text-left py-3">
                                    <a href="?sort=id&order={{ $dir }}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="id_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        #
                                    </a>
                                </th>
                                <th scope="col"
                                    class="text-left py-3">
                                    <a href="?sort=company.name&order={{ $dir }}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="company_name_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        Company name
                                    </a>
                                </th>
                                <th scope="col"
                                    class=" text-left">
                                    <a href="?sort=first_name&order={{$dir}}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="first_name_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        First name
                                    </a>
                                </th>
                                <th scope="col"
                                    class=" text-left">
                                    <a href="?sort=last_name&order={{$dir}}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="last_name_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        Last name
                                    </a>
                                </th>
                                <th scope="col"
                                    class="text-left">
                                    <a href="?sort=street&order={{$dir}}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="street_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        Street
                                    </a>
                                </th>
                                <th scope="col"
                                    class="text-left">
                                    <a href="?sort=zipcode&order={{$dir}}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="zipcode_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        Zipcode
                                    </a>
                                </th>
                                <th scope="col"
                                    class="text-left">
                                    <a href="?sort=country&order={{$dir}}&{{ http_build_query(request()->except('sort', 'search', 'order')) }}" id="country_header" class="py-3 px-4 text-xs font-medium tracking-wider ext-gray-700 uppercase dark:text-gray-400">
                                        Country
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($packages as $package)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-4 px-2 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->id}}</td>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->company->name}}</td>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->first_name}}</td>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->last_name}}</td>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->street}}</td>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->zipcode}}</td>
                                    <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->country}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $packages->links() }}
            </div>
        </div>
    </div>
@endsection
