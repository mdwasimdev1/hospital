@extends('layouts.navbar')

@section('title')
    Add Doctor Profile - Doctors Profile BD
@endsection

@section('content')
<div class="bg-white shadow text-center mb-3 rounded-md p-2">
    <h2 class="text-xl font-bold">বিশেষজ্ঞ ডাক্তার হিসেবে যোগ দিন</h2>
</div>
<div class="bg-white shadow text-center mb-3 rounded-md p-2">
   <p>{{ $paymants->introduction }}</p>
</div>
<div class="bg-white shadow text-center mb-3 rounded-md p-2">
    <div class="flex justify-center py-3">
        <img class="w-20" src="{{ asset('images/bkash-logo.png') }}" alt="">
    </div>
    <p class="py-3">{{ $paymants->payment_process }}</p>
    <p>
        <a
          href="javascript:void(0)"
          class="text-white bg-[#E1146E] p-2 rounded"
          onclick="copyToClipboard(this, '{{ $paymants->number }}')"
        >
          {{ $paymants->number }}
        </a>
      </p>
    <p class="py-3">{{ $paymants->apply_process }}</p>
</div>

<div class="bg-white shadow  mb-3 rounded-md p-2">
    <div class="p-6">
        <form action="{{ route('store.doctor.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium">Doctor's Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" placeholder="Doctor Name" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Doctor's Email<span class="text-red-500">*</span></label>
                <input type="text" name="email" placeholder="Enter Valid Email Address" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Doctor's Personal Mobile Number <span class="text-red-500">*</span></label>
                <input type="number" name="personal_phone" placeholder="Enter Doctor's Personal Mobile Number" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">BM&DC Number<span class="text-red-500">*</span></label>
                <input type="text" name="bmdc_number" placeholder="EnterDoctor BM&DC Register Number" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Degrees<span class="text-red-500">*</span></label>
                <input type="text" name="degrees" placeholder="Enter Your Degree or qualification" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Fellowships or Trainings (optional)</label>
                <input type="text" name="fellowships" placeholder="Enter Your Fellowships or Trainings" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Specialty<span class="text-red-500">*</span></label>
                <input type="text" name="specialty" placeholder="Example: Medicine or Surgery" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Workplace<span class="text-red-500">*</span></label>
                <input type="text" name="workplace" placeholder="Example: Dhaka Medical College Hospital" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Designation & Department<span class="text-red-500">*</span></label>
                <input type="text" name="designation" placeholder="Example: Assistant Professor, Surgery" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Chamber Name<span class="text-red-500">*</span></label>
                <input type="text" name="chamber_name" placeholder="Example: Dhaka Medical College Hospital" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Chamber Address<span class="text-red-500">*</span></label>
                <input type="text" name="chamber_address" placeholder="Example: House # 1, Road # 1, Dhaka" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Visiting Hour and Off Days<span class="text-red-500">*</span></label>
                <input type="text" name="visiting_hour" placeholder="Example: Monday to Friday 9:00 AM to 5:00 PM" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Appointment Number<span class="text-red-500">*</span></label>
                <input type="text" name="appointment_number" placeholder="Enter Your Appointment Number" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">bKash Transaction ID<span class="text-red-500">*</span></label>
                <input type="text" name="bKash_transaction" placeholder="Example: AZQERTDGTF" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">এই ওয়েবসাইট সম্পর্কে কিভাবে জেনেছেন? <span class="text-red-500">*</span></label>
                <input type="text" name="about" placeholder="Facebook, google, Friend, Instagram, Twitter" class="w-full border text-sm rounded px-3 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Upload Your Photo (Professional)<span class="text-red-500">*</span></</label>
                <input type="file" name="photo" class="w-full border text-sm rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-primary text-sm text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
 </div>








<script>
    function copyToClipboard(element, text) {
      navigator.clipboard.writeText(text).then(() => {
        const originalText = element.innerText;
        element.innerText = 'Copied';

        setTimeout(() => {
          element.innerText = originalText;
        }, 2000);
      }).catch(err => {
        console.error('Failed to copy!', err);
      });
    }
  </script>

@endsection
