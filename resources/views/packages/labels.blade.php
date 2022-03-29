@extends('layouts.app', ['title' => 'Labels'])

@section('content')
    <table>
        <thead class="table table-light">
        <tr>
            <th scope="col">Package nr</th>
            <th scope="col">Company name</th>
            <th scope="col">Customer name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->company->name }}</td>
                <td>{{ $package->first_name }} {{ $package->last_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--    <div class="max-w-2xl mx-auto">--}}
    {{--        <div class="flex flex-col">--}}
    {{--            <div class="overflow-x-auto shadow-md sm:rounded-lg">--}}
    {{--                <div class="inline-block min-w-full align-middle">--}}
    {{--                    <div class="overflow-hidden ">--}}
    {{--                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">--}}
    {{--                            <thead class="bg-gray-100 dark:bg-gray-700">--}}
    {{--                            <tr>--}}
    {{--                                <th scope="col"--}}
    {{--                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">--}}
    {{--                                    Package nr--}}
    {{--                                </th>--}}
    {{--                            </tr>--}}
    {{--                            <tr>--}}
    {{--                                <th scope="col"--}}
    {{--                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">--}}
    {{--                                    Company name--}}
    {{--                                </th>--}}
    {{--                            </tr>--}}
    {{--                            <tr>--}}
    {{--                                <th scope="col"--}}
    {{--                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">--}}
    {{--                                    Customer name--}}
    {{--                                </th>--}}
    {{--                            </tr>--}}
    {{--                            <tr>--}}
    {{--                                <th scope="col"--}}
    {{--                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">--}}
    {{--                                    Select--}}
    {{--                                </th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">--}}
    {{--                            @foreach($packages as $package)--}}
    {{--                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">--}}
    {{--                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->id}}</td>--}}
    {{--                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->company->name}}</td>--}}
    {{--                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$package->first_name}}  {{$package->last_name}}</td>--}}
    {{--                                    <td class="p-4 w-4">--}}
    {{--                                        <div class="flex items-center">--}}
    {{--                                            <input id="toPrint" type="checkbox"--}}
    {{--                                                   class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">--}}
    {{--                                            <label for="toPrint" class="sr-only">checkbox</label>--}}
    {{--                                        </div>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
