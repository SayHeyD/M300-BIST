@extends('layouts.app')

@section('content')
    <form style="display: flex; flex-direction: column" action="{{ route('entry.update', $entry->id) }}">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="@if(old('name')){{ old('name') }}@else{{ $entry->name }}@endif">

        <label for="surename">Nachname</label>
        <input id="surename" type="text" name="surename" value="@if(old('surename')){{ old('surename') }}@else{{ $entry->surename }}@endif">

        <label for="street">Strasse</label>
        <input id="street" type="text" name="street" value="@if(old('street')){{ old('street') }}@else{{ $entry->street }}@endif">

        <label for="housenumber">Hausnummer</label>
        <input id="housenumber" type="text" name="housenumber" value="@if(old('housenumber')){{ old('housenumber') }}@else{{ $entry->housenumber }}@endif">

        <label for="location">Ort</label>
        <input id="location" type="text" name="location" value="@if(old('location')){{ old('location') }}@else{{ $entry->location }}@endif">

        <label for="zipcode">Postleitzahl</label>
        <input id="zipcode" type="text" name="zipcode" value="@if(old('zipcode')){{ old('zipcode') }}@else{{ $entry->zipcode }}@endif">

        <label for="email">E-Mail</label>
        <input id="email" type="email" name="email" value="@if(old('email')){{ old('email') }}@else{{ $entry->email }}@endif">

        <label for="phonenumber">Telefonnummer</label>
        <input id="phonenumber" type="text" name="phonenumber" value="@if(old('phonenumber')){{ old('phonenumber') }}@else{{ $entry->phonenumber }}@endif">

        <button style="margin-top: 50px" type="submit">Erstellen</button>
    </form>
    <p style="margin-top: 50px"><a href="{{ route('entry.delete', $entry->id) }}">Eintrag löschen</a></p>
@endsection
