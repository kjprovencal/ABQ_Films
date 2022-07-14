@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="step">
        <h3>Enter Start and End Dates</h3>
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form onsubmit="getoffset()" action=<?php echo $_ENV['APP_URL'] . ":" . $_ENV['APP_PORT'] . "/show"?> method="GET">
            <label for="start_date">Start Date: </label>
            <input type="date" id="start_date" name="start_date"/>
            <label for="end_date">End Date: </label>
            <input type="date" id="end_date" name="end_date"/>
            <input type="hidden" name="offset" id="offset" value="offset" />
            <input type="submit" value="Submit" /> 
        </form>
    </div>
@endsection