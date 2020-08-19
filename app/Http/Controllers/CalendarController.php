<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarRequest;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function submit(CalendarRequest $request) {
        session()->flash('success', 'You successfully submited form!');
        return redirect()->back();
    }
}
