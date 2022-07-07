@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        <h3>Productions</h3>
        <?php if(count($data) > 0){
            echo '<ul>';
            echo '<li>' . implode('</li><li>', $data) . '</li>';
            echo '</ul>';
        } else {
            echo '<p>No Productions</p>';
        }
        ?>
    </div>
@endsection
