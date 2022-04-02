@extends('layouts.app', ['title' => 'Labels'])

@section('content')

    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col">
            <div class="relative flex lg:inline-flex items-center py-1 ml-auto">
                <form method="get" action="#">
                    <input type="text" name="search" placeholder="Search..."
                           class="bg-transparent placeholder-black font-semibold text-sm"
                           value="{{ request('search') }}">
                </form>
            </div>

            <form class="flex flex-col" action="{{ route('packages.labels.toPDF') }}" method="POST">
                @csrf
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-4 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Company name
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-4 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Customer name
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-4 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Street
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-4 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Zipcode
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-4 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Country
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Select
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($packages as $package)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-4 px-2 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->id}}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->company->name}}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->first_name}}  {{$package->last_name}}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->street}}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->zipcode}}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->country}}</td>
                                        <td class="p-4 w-4">
                                            <div class="flex items-center">
                                                <input id="toProcess" type="checkbox" name="toProcess[]"
                                                       value="{{ $package->id }}"
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="toProcess" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="relative flex lg:inline-flex items-center py-1 ml-auto">
                    <button type="submit"
                            class="bg-blue-500 rounded-lg font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600">
                        To PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
