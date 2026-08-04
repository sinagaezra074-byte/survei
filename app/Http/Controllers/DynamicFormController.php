<?php

namespace App\Http\Controllers;

use App\Models\Sidebar;
use App\Models\SidebarRecord;
use App\Models\SidebarRecordValue;
use Illuminate\Http\Request;

class DynamicFormController extends Controller
{

    public function index(Sidebar $sidebar)
    {

        $fields = $sidebar->fields()
            ->where('status', 1)
            ->orderBy('urutan')
            ->get();

        return view('dynamic.index', compact(
            'sidebar',
            'fields'
        ));
    }

    public function store(Request $request, Sidebar $sidebar)
    {
        $record = SidebarRecord::create([
            'sidebar_id' => $sidebar->id
        ]);

        foreach ($sidebar->fields as $field) {

            $value = null;

            if ($request->hasFile($field->id)) {

                $value = $request
                    ->file($field->id)
                    ->store('dynamic_uploads', 'public');
            } else {

                $value = $request->input($field->id);
            }

            SidebarRecordValue::create([

                'record_id' => $record->id,

                'field_id' => $field->id,

                'value' => $value

            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Data berhasil disimpan.');
    }
}
