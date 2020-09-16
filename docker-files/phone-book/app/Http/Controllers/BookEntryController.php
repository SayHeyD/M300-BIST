<?php

namespace App\Http\Controllers;

use App\Models\BookEntry;
use Illuminate\Http\Request;

class BookEntryController extends Controller
{
    public function edit(Request $request, $id)
    {
        $entry = BookEntry::findOrFail($id);

        return view('edit', [
            'entry' => $entry
        ]);
    }

    public function update(Request $request, $id)
    {
        $entry = BookEntry::findOrFail($id);

        $entry->fill([
            'name' => $request->name,
            'surename' => $request->surename,
            'street' => $request->street,
            'housenumber' => $request->housenumber,
            'location' => $request->location,
            'zipcode' => $request->zipcode,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber
        ]);

        $entry->save();

        return redirect()->route('index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $entry = new BookEntry();

        $entry->fill([
            'name' => $request->name,
            'surename' => $request->surename,
            'street' => $request->street,
            'housenumber' => $request->housenumber,
            'location' => $request->location,
            'zipcode' => $request->zipcode,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber
        ]);

        $entry->save();

        return redirect()->route('index');
    }

    public function delete(Request $request, $id)
    {
        $entry = BookEntry::findOrFail($id);
        $entry->delete();
        return redirect()->route('index');
    }
}
