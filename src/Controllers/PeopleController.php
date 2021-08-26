<?php

namespace AndreaOrtu\AdmProject\Controllers;

use AndreaOrtu\AdmProject\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public function index()
    {
        $direction = request()->direction ?? 'ASC';
        $sortBy = request()->sortBy ?? 'name';

        $peoples = People::orderBy($sortBy, $direction);

        if(request()->has('filter')) {
            $filter =  json_decode(request()->filter);
            $peoples->where($filter[0], $filter[1]);
        }

        return response($peoples->paginate(People::PAGINATION));
    }

    public function show(People $people)
    {
        return response($people);
    }
}
