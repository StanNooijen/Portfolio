<?php

namespace App\Http\Controllers;

use App\Models\Popups;
use App\Models\Popups_details;
use App\Models\Projects;
use App\Models\Skills;
use Illuminate\Http\Request;
use App\Models\Blocks;
use Intervention\Image\Facades\Image;

class ApiController extends Controller
{
    public function updatenBlok(Request $request)
    {
        $data = $request->all();
        $block_id = $data['block_id'];
        $block_name = $data['type'];
        $position = $data['position'];
        $title = $data['title'];
        $tekst1 = $data['editordata'];
        $button_tekst = $data['button_text'];
        $place_name = $data['place_name'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = date('Y-m-d') . '_' . $block_name . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $img = '/images/' . $imageName;
        } else {
            $img = null;
        }

        $updateData = [
            'title' => $title,
            'text' => $tekst1,
            'button_text' => $button_tekst,
            'place_name' => $place_name,
        ];

        if ($img !== null) {
            $updateData['image'] = $img;
        }

        Blocks::updateOrInsert(
            ['block_id' => $block_id, 'type' => $block_name, 'position' => $position],
            $updateData
        );

        return redirect()->back();
    }

    public function setActive($popup_id)
    {
        $popup = Popups::where('popup_id', $popup_id)->first();
        if ($popup) {
            $newStatus = $popup->active ? 0 : 1;
            Popups::where('popup_id', $popup_id)->update(['active' => $newStatus]);
        }

        return redirect()->back();
    }

    public function skillPopup(Request $request) {
        $data = $request->all();
        $popup_id = $data['popup_id'];
        $project_id = $data['project_id'];
        $description = $data['short-description'];
        $label = $data['label'];
        $title = $data['title'];
        $text = $data['editordata'];
        $skills = $data['languages'];
        $button_url = $data['url'];

        // Save title and text in the popups table
        Popups::updateOrInsert(
            ['popup_id' => $popup_id],
            ['title' => $title, 'text' => $text]
        );

        Projects::updateOrInsert(
            ['project_id' => $project_id],
            ['title' => $title, 'programming_languages' => $skills, 'text' => $description]
        );

        // Retrieve existing popup details
        $existingDetails = Popups_details::where('popup_id', $popup_id)->first();

        // Handle image1
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $imageName1 = date('Y-m-d') . '_image1_' . $popup_id . '.' . $image1->extension();
            $image1->move(public_path('images'), $imageName1);
            $img1 = '/images/' . $imageName1;
        } else {
            $img1 = $existingDetails ? $existingDetails->image_1 : null;
        }

        // Handle image2
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $imageName2 = date('Y-m-d') . '_image2_' . $popup_id . '.' . $image2->extension();
            $image2->move(public_path('images'), $imageName2);
            $img2 = '/images/' . $imageName2;
        } else {
            $img2 = $existingDetails ? $existingDetails->image_2 : null;
        }

        // Save the rest of the data in the popup_details_table
        $updateDetails = [
            'popup_id' => $popup_id,
            'value' => $skills,
            'button_link' => $button_url,
            'label' => $label,
        ];

        if ($img1 !== null) {
            $updateDetails['image_1'] = $img1;
        }

        if ($img2 !== null) {
            $updateDetails['image_2'] = $img2;
        }

        Popups_details::updateOrInsert(
            ['popup_id' => $popup_id],
            $updateDetails
        );

        return redirect()->back();
    }
}
