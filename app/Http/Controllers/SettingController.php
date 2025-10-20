<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Advertisement;
use App\Models\AdvertisementPosition;
use App\Models\Disclaimer;
use App\Models\DoctorRequest;
use App\Models\PaymentCondintion;
use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{


    public function payment_edit()
    {
        $payment = PaymentCondintion::first();
        return view('backend.settings.payment_condition', ['payment' => $payment]);
    }

    public function payment_update(Request $request)
    {
        $request->validate([
            'introduction' => 'nullable|string',
            'payment_process' => 'nullable|string',
            'number' => 'nullable|string',
            'apply_process' => 'nullable|string',
        ]);

        $payment = PaymentCondintion::first();
        if (!$payment) {
            $payment = new PaymentCondintion();
        }

        $payment->fill($request->only([
            'introduction',
            'payment_process',
            'number',
            'apply_process',
        ]));

        $payment->save();

        return redirect()->back()->with('success', 'Payment condition updated successfully!');
    }








    public function about_us_edit()
    {
        $about = AboutUs::first();
        return view('backend.settings.aboutUs', ['about' => $about]);
    }

    public function about_us_update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'home_description' => 'nullable|string',
            'description' => 'nullable|string',
            'why_create_website' => 'nullable|string',
            'comment' => 'nullable|string',
        ]);

        $about = AboutUs::first();

        // ✅ Image Upload (to public/uploads/about_us/)
        if ($request->hasFile('image')) {
            // ✅ পুরোনো ইমেজ ডিলিট করুন
            if ($about->image && File::exists(public_path($about->image))) {
                File::delete(public_path($about->image));
            }

            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/about_us');

            // ✅ ফোল্ডার না থাকলে তৈরি করুন
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            // ✅ ফাইল মুভ করুন
            $image->move($destination, $imageName);

            // ✅ ডাটাবেজে ইমেজ পাথ সংরক্ষণ
            $about->image = 'uploads/about_us/' . $imageName;
        }

        // ✅ Text fields update
        $about->home_description = $request->home_description;
        $about->description = $request->description;
        $about->why_create_website = $request->why_create_website;
        $about->comment = $request->comment;

        $about->save();

        return redirect()->back()->with('success', 'About Us updated successfully!');
    }





    public function advertisement_edit()
    {
        $advertisement = Advertisement::first();
        return view('backend.settings.advertisement', ['advertisement' => $advertisement]);
    }

    public function advertisement_update(Request $request)
    {
        // Validate input
        $request->validate([
            'description' => 'nullable|string',
            'conditions' => 'nullable|string',
            'position_priority' => 'nullable|string',
            'transparency' => 'nullable|string',
            'pricing_policy' => 'nullable|string',
            'display_policy' => 'nullable|string',
            'renewal_policy' => 'nullable|string',
            'rights_and_preparation' => 'nullable|string',
        ]);

        $advertisement = Advertisement::first();
        if (!$advertisement) {
            $advertisement = new Advertisement();
        }

        $advertisement->fill($request->only([
            'description',
            'conditions',
            'position_priority',
            'transparency',
            'pricing_policy',
            'display_policy',
            'renewal_policy',
            'rights_and_preparation',
        ]));

        $advertisement->save();

        return redirect()->back()->with('success', 'Advertisement policy updated successfully!');
    }

    public function advertisement_position()
    {
        $positions = AdvertisementPosition::all();
        return view('backend.settings.advertisement_position', ['positions' => $positions]);
    }


    public function advertisement_position_store(Request $request)
    {
        // Validate input
        $request->validate([
            'position' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'price'    => 'required|string|min:255',
        ]);

        // Store data
        AdvertisementPosition::create([
            'position' => $request->position,
            'duration' => $request->duration,
            'price'    => $request->price,
        ]);

        return redirect()->back()->with('success', 'Advertisement Position added successfully!');
    }
    public function advertisement_position_edit($id)
    {
        $position = AdvertisementPosition::findOrFail($id); // renamed from $positions to $position
        return view('backend.settings.advertisement_position_edit', compact('position'));
    }


    public function advertisement_position_update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'price'    => 'required|numeric|min:0',
        ]);

        $position = AdvertisementPosition::findOrFail($id);
        $position->update([
            'position' => $request->position,
            'duration' => $request->duration,
            'price'    => $request->price,
        ]);

        return redirect()->route('advertisement.position')->with('success', 'Advertisement position updated successfully!');
    }






    public function privacy_edit()
    {
        $privacy = Privacy::first();  // assume only one row
        return view('backend.settings.privacy', compact('privacy'));
    }

    public function privacy_update(Request $request)
    {
        $request->validate([
            'introduction' => 'nullable|string',
            'information' => 'nullable|string',
            'cookies' => 'nullable|string',
            'google_analytics' => 'nullable|string',
            'third_party_links' => 'nullable|string',
        ]);

        $privacy = Privacy::first();
        if (!$privacy) {
            $privacy = new Privacy();
        }

        $privacy->fill($request->only([
            'introduction',
            'information',
            'cookies',
            'google_analytics',
            'third_party_links',
        ]));

        $privacy->save();

        return redirect()->back()->with('success', 'Privacy policy updated successfully!');
    }










    public function disclaimer_edit()
    {
        $disclaimer = Disclaimer::first(); // assume ekta row
        return view('backend.settings.disclaimer', compact('disclaimer'));
    }

    public function disclaimer_update(Request $request)
    {
        $request->validate([
            'disclaimer' => 'nullable|string',
        ]);

        $disclaimer = Disclaimer::first();
        if (!$disclaimer) {
            $disclaimer = new Disclaimer();
        }
        $disclaimer->disclaimer = $request->disclaimer;
        $disclaimer->save();

        return redirect()->back()->with('success', 'Disclaimer updated successfully!');
    }
}
