<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterMovies
{
    protected function date_localizer(Request $request, $d) {
        return date('Y-m-d', $d/1000);
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
        ]);
        $movies_dict = [];
        $data = file_get_contents('https://c2t-cabq-open-data.s3.amazonaws.com/film-locations-json-all-records_03-19-2020.json');
        $json = json_decode($data);
        $features = $json->features;
        foreach ($features as $f) {
            $movie = $f->attributes;
            $title = $movie->Title;
            if (!array_key_exists($title, $movies_dict)) {
                $movies_dict[$title] = [
                    "title" => $title,
                    "type" => $movie->Type,
                    "sites" => [$movie->Site => $this->date_localizer($request, $movie->ShootDate)],
                ];
            } else{
                $movies_dict[$title]['sites'][$movie->Site] = $this->date_localizer($request, $movie->ShootDate);
            }
        }
        $request->merge(['productions'=>$movies_dict]);
        return $next($request);
    }
}
