<?php

namespace App\Http\Controllers;

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
}
