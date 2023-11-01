<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class PostQueryFilter
{
    public static function applyFilter(Builder $postQuery, Request $request): Builder
    {

        $request->whenFilled('serchByText', function (string $text) use (&$postQuery) {
            $postQuery->where('title', 'like', "%$text%");
        });

        $request->whenFilled('serchByAutorName', function (string $text) use (&$postQuery) {
            $keywords = explode(' ', $text);
            $postQuery->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhereHas('author', function ($query) use ($keyword) {
                        $query->where('first_name', 'like', "%$keyword%")
                            ->orWhere('last_name', 'like', "%$keyword%");
                    });

                }
            });
        });

        $request->whenFilled('serchById', function (int $id) use (&$postQuery) {
            $postQuery->where('id', $id);
        });

        $request->whenFilled('serchByPublishDate', function (string $date) use (&$postQuery) {
            //   valid format  09.01.2023 'd.m.Y'
            if (preg_match("/\d{2}\.\d{2}\.\d{4}/", $date)) {
                $date = Carbon::createFromFormat('d.m.Y', $date);
                $postQuery->whereDate('publish_date', '=',  $date);
            }
        });

        return $postQuery;
    }

}
