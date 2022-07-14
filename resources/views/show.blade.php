@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        <h1>Productions</h1>
        <?php if(count($data) > 0){
            echo "<p style=\"margin-left:40px\"><b>Count: </b>" . count($data) . '</p>';
            echo "<ul class='output'>";
            foreach ($data as $location => $loc_data){
                echo "<div class='film-container'>";
                echo "<li class='film'><b>" . $loc_data['title'] . "</b>";
                    echo "<ul class='film-data'>";
                        echo "<li>Type: " . $loc_data['type'] . "</li>"; 
                        echo "<li>Sites: ";
                        echo "<ul>";
                            foreach ($loc_data['sites'] as $name => $shoot_date){
                                echo "<li>" . $name . ": " . $shoot_date . "</li>";
                            }
                        echo "</ul></li>";
                    echo "</ul>";
                echo "</li></div>";
            }
            //echo '<li>' . implode('</li><li>', $data) . '</li>';
            echo '</ul>';
        } else {
            echo '<p>No Productions</p>';
        }
        ?>
    </div>
@endsection
