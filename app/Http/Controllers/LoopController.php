<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class LoopController extends Controller
{
    function randomize() {
        $bookid = rand(1,999);
        $randomAlph = substr(str_shuffle(str_repeat($char='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', ceil(2/strlen($char)))),1 ,2);
        return $bookid.$randomAlph;
    }

    public function loop()
    {   
        $randomize_code = $this->randomize();
        $book_id_checker = Booking::where('idbooking', $randomize_code)->get()->first();
        while($book_id_checker) {
            $randomize_code = $this->randomize();
        }
        // loops 100x
        for($i=1;$i<=100;$i++) {
            $unique_code[$i] = str_pad($randomize_code, 5, '0', STR_PAD_LEFT).str_pad($i, 3, '0', STR_PAD_LEFT);
            $booking_id = new Booking([
                'idbooking' => $unique_code[$i]
            ]);
            $booking_id->save();
        }
        return $unique_code;
    }
}
