@extends('layouts.app')

@section('content')
    <table style="border: 2px solid black; border-collapse: collapse">
        <tr style="border: 2px solid black">
            <th style="border: 2px solid black">Name</th>
            <th style="border: 2px solid black">Nachname</th>
            <th style="border: 2px solid black">Strasse</th>
            <th style="border: 2px solid black">Hausnummer</th>
            <th style="border: 2px solid black">Ort</th>
            <th style="border: 2px solid black">Postleitzahl</th>
            <th style="border: 2px solid black">E-Mail</th>
            <th style="border: 2px solid black">Telefonnummer</th>
            <th style="border: 2px solid black">Optionen</th>
        </tr>
        @if(count($entries) > 0)
            @foreach($entries as $entry)
                <tr>
                    <td style="border: 2px solid black">
                        {{ $entry->name }}
                    </td>
                    <td style="border: 2px solid black">
                        {{ $entry->surename }}
                    </td>
                    <td style="border: 2px solid black">
                        {{ $entry->street }}
                    </td>
                    <td  style="border: 2px solid black">
                        {{ $entry->housenumber }}
                    </td>
                    <td style="border: 2px solid black">
                        {{ $entry->location }}
                    </td>
                    <td style="border: 2px solid black">
                        {{ $entry->zipcode }}
                    </td>
                    <td style="border: 2px solid black">
                        {{ $entry->email }}
                    </td>
                    <td style="border: 2px solid black">
                        {{ $entry->phonenumber }}
                    </td>
                    <td style="border: 2px solid black">
                        <a href="{{ route('entry.edit', $entry->id) }}">Editieren</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="border: 2px solid black" colspan="9">Keine Einträge vorhanden</td>
            </tr>
        @endif
    </table>
    <a href="{{ route('entry.create') }}">Neuer Eintrag</a>
@endsection
