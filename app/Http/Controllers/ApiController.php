<?php

namespace App\Http\Controllers;

use App\Models\Entries;
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

        $img = $this->handleImageUpload($request, 'image', $block_name, null);

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
        $title = $data['title'];
        $text = $data['editordata'];
        $skills = $data['languages'] ?? null;
        $button_url = $data['url'] ?? null;
        $description = $data['short-description'] ?? null;
        $project_id = $data['project_id'] ?? null;
        $popup_type = $data['popupType'];
        $detail_type = $data['detailType'];

        if (isset($data['detail_ids'])) {
            $detail_ids = str_replace(['[', ']'], '', $data['detail_ids']);
            $detail_ids = explode(',', $detail_ids);
            foreach ($detail_ids as $id) {
                $label = $data['label_' . $id];
                $labels_input = $data['labels_input_' . $id];
                Popups_details::updateOrInsert(
                    ['detail_id' => $id, 'popup_id' => $popup_id],
                    ['label' => $label, 'value' => $labels_input]
                );
            }
        }

        Popups::updateOrInsert(
            ['popup_id' => $popup_id],
            ['title' => $title, 'text' => $text, 'type' => $popup_type]
        );

        Projects::updateOrInsert(
            ['project_id' => $project_id],
            ['title' => $title, 'programming_languages' => $skills, 'text' => $description]
        );

        $existingDetails = Popups_details::where('popup_id', $popup_id)->get();
        $img1 = $this->handleImageUpload($request, 'image1', $popup_id, $existingDetails->first()->image_1 ?? null);
        $img2 = $this->handleImageUpload($request, 'image2', $popup_id, $existingDetails->first()->image_2 ?? null);

        $updateDetails = [
            'popup_id' => $popup_id,
            'value' => $skills ?? '',
            'button_link' => $button_url,
            'label' => $data['label'],
            'image_1' => $img1,
            'image_2' => $img2,
            'type' => $detail_type,
        ];

        if (isset($data['detail_id'])){
            Popups_details::updateOrInsert(
                ['popup_id' => $popup_id, 'detail_id' => $data['detail_id']],
                array_filter($updateDetails, fn($value) => !is_null($value))
            );
        }

        if ($popup_type === 'projects' && $existingDetails->count() > 1) {
            $detailsToDelete = $existingDetails->sortByDesc('detail_id')->take(3);
            foreach ($detailsToDelete as $detail) {
                $detail->delete();
            }
        } elseif ($popup_type !== 'projects' && $existingDetails->count() <= 1) {
            for ($i = 0; $i < 3; $i++) {
                Popups_details::create([
                    'popup_id' => $popup_id,
                    'label' => '',
                    'value' => '',
                    'type' => $detail_type,
                ]);
            }
            Popups::where('project_id', $project_id)->update(['project_id' => null]);
            Projects::where('project_id', $project_id)->delete();
        }

        return redirect()->back();
    }

    public function entrieSave(Request $request)
    {
        $data = $request->all();
        $entry_id = $data['entry_id'];
        $title = $data['title'];
        $place = $data['place'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $type = $data['type'];
        $text = $data['editordata'];

        $img = $this->handleImageUpload($request, 'image1', $entry_id, null);

        $updateData = [
            'title' => $title,
            'place' => $place,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'text' => $text,
            'type' => $type,
        ];

        if ($img !== null) {
            $updateData['logo'] = $img;
        }

        Entries::updateOrInsert(
            ['entry_id' => $entry_id],
            $updateData
        );

        return redirect()->back();
    }

    public function addEntry(){
        $entry = new Entries();
        $entry->save();
        return redirect()->back();
    }

    public function addPopup(){
        $projects = new Projects();
        $projects->title = 'New Project';
        $projects->save();

        $popup = new Popups();
        $popup->project_id = $projects->id;
        $popup->save();


        $details = new Popups_details();
        $details->popup_id = $popup->id;
        $details->save();


        return redirect()->back();
    }

    public function deletePopup($popup_id, $type){

        if ($type === 'projects') {
            $project_id = Popups::where('popup_id', $popup_id)->first()->project_id;
            Projects::where('project_id', $project_id)->delete();
        }

        Popups::where('popup_id', $popup_id)->delete();
        Popups_details::where('popup_id', $popup_id)->delete();

        return redirect()->back();
    }

    public function deleteEntry($entry_id){
        Entries::where('entry_id', $entry_id)->delete();
        return redirect()->back();
    }

    private function handleImageUpload($request, $imageField, $popup_id, $existingImage) {
        if ($request->hasFile($imageField)) {
            $image = $request->file($imageField);
            $imageName = date('Y-m-d') . "_{$imageField}_{$popup_id}." . $image->extension();
            $image->move(public_path('images'), $imageName);
            return '/images/' . $imageName;
        }
        return $existingImage;
    }
}
