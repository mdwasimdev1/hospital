@extends('layouts.navbar')

@section('title')
    Advertisement - Doctors Profile BD
@endsection

@section('content')
    <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
        <h1 class="text-2xl font-bold">বিজ্ঞাপন দিন, আপনার জনপ্রিয়তা বৃদ্ধি করুন</h1>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->description }}</p>
    </div>





    <div class="bg-white shadow mb-3 rounded-md">
        <table class="w-full">
            <thead>
                <tr class="">
                    <th class="border border-gray-300 px-4 py-2">
                        পজিশন</th>
                    <th class="border border-gray-300 px-4 py-2">মেয়াদ</th>
                    <th class="border border-gray-300 px-4 py-2"> টাকা/ক্যাটাগরি</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($advertisementPosition as $position)
                    <tr class="hover:bg-gray-100 border-t">

                        <td class="border border-gray-300 px-4 py-2">{{ $position->position }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $position->duration ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $position->price ?? 'N/A' }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white shadow py-2  mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">বিজ্ঞাপন প্রচারের শর্তাবলি</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->conditions }}</p>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">বিজ্ঞাপন পজিশন ও প্রাপ্যতা</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->position_priority }}</p>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">স্বচ্ছতা</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->transparency }}</p>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">মূল্য নির্ধারণ ও পরিবর্তন</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->pricing_policy }}</p>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">প্রদর্শনের নীতিমালা</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->display_policy }}</p>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">পুনরায় বিজ্ঞাপন প্রকাশ</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->renewal_policy }}</p>
    </div>
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label for="" class="text-xl text-start p-5 font-semibold">ব্যাখ্যা ও প্রয়োগ</label>
        <hr>
        <p class="text-gray-600 text-justify p-5">{{ $advertisement->rights_and_preparation }}</p>
    </div>
    <div class="bg-white shadow py-2 text-center my-5 rounded-md pb-5">
        <div class="mt-5"><i class="fa-solid fa-envelope text-3xl text-white bg-primary p-3 rounded-full"></i></div>
        <p class="text-gray-600 text-justify p-5">To edit your profile information, advertise, or contact us, please email
            us. Please note, we do not provide doctor serials or appointments.</p>
        <a href="" class="bg-primary p-2 rounded text-white mb-3 ">doctorprofilebd@gmail.com</a>
    </div>
@endsection
