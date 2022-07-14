<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FilterMovies
{
    protected function valid_date($start_date, $end_date, $shoot_date) {
        return $start_date <= $shoot_date && $shoot_date <= $end_date;
    }

    protected function sub_offset($date, $offset){
        if($offset[0] == '-'){
            return $date->addMinutes(substr($offset, 1));
        } else {
            return $date->subMinutes($offset);
        }
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'offset' => 'required|string'
        ]);
        $start_date = new Carbon($request->start_date);
        $end_date = new Carbon($request->end_date);
        $movies_dict = [];
        $data = file_get_contents('https://c2t-cabq-open-data.s3.amazonaws.com/film-locations-json-all-records_03-19-2020.json');
        $json = json_decode($data);
        $features = $json->features;
        foreach ($features as $f) {
            $movie = $f->attributes;
            $title = $movie->Title;
            $shoot_date = new Carbon($movie->ShootDate/1000);
            $shoot_date = $this->sub_offset($shoot_date, $request->offset);
            if (!array_key_exists($title, $movies_dict) && $this->valid_date($start_date, $end_date, $shoot_date)) {
                $movies_dict[$title] = [
                    "title" => $title,
                    "type" => $movie->Type,
                    "sites" => [$movie->Site => $shoot_date->toFormattedDateString()],
                ];
            } else if($this->valid_date($start_date, $end_date, $shoot_date)){
                $movies_dict[$title]['sites'][$movie->Site] = $shoot_date->toFormattedDateString();
            }
        }
        $request->merge(['productions'=>$movies_dict]);
        return $next($request);
    }
}
