@extends('layouts.app')

@section('content')
    <form style="display: flex; flex-direction: column" action="{{ route('entry.store') }}">
        <label for="name">Name</label>
        <input id="name" type="text" name="name">

        <label for="surename">Nachname</label>
        <input id="surename" type="text" name="surename">

        <label for="street">Strasse</label>
        <input id="street" type="text" name="street">

        <label for="housenumber">Hausnummer</label>
        <input id="housenumber" type="text" name="housenumber">

        <label for="location">Ort</label>
        <input id="location" type="text" name="location">

        <label for="zipcode">Postleitzahl</label>
        <input id="zipcode" type="text" name="zipcode">

        <label for="email">E-Mail</label>
        <input id="email" type="email" name="email">

        <label for="phonenumber">Telefonnummer</label>
        <input id="phonenumber" type="text" name="phonenumber">

        <button style="margin-top: 50px" type="submit">Erstellen</button>
    </form>
@endsection
