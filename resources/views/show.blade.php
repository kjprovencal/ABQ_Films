@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        <h3>Productions</h3>
        <?php if(count($data) > 0){
            echo '<ul>';
            foreach ($data as $location => $loc_data){
                echo "<li>" . $location;
                    echo "<li>Title: " . $loc_data['title'] . "</li>";
                    echo "<li>Type: " . $loc_data['type'] . "</li>"; 
                    echo "<li>Sites: ";
                        foreach ($loc_data['sites'] as $site){
                            echo gettype($site);
                            //echo "<li>Name: " . $site['name'] . "</li>";
                            //echo "<li>Shoot Date: " . $site['shoot_date'] . "</li>";
                        }
                    echo "</li>";
                echo "</li>";
            }
            //echo '<li>' . implode('</li><li>', $data) . '</li>';
            echo '</ul>';
        } else {
            echo '<p>No Productions</p>';
        }
        ?>
    </div>
@endsection
