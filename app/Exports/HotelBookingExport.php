<?php

namespace App\Exports;

use App\Models\HotelBooking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class HotelBookingExport implements FromCollection, WithMapping, WithHeadings
{

    protected $created_at;

    function __construct($created_at) {
            $this->created_at = $created_at;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return HotelBooking::with(['user', 'room'])->whereDate('created_at', '>=', $this->created_at)->get();
    }

    
    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($booking): array
    {
        return [
            $booking->room->room_number,
            $booking->user->first_name . ' ' . $booking->user->last_name,
            $booking->user->email,
            $booking->user->number,
            $booking->start_date,
            $booking->end_date,
            $booking->status,
            $booking->created_at,
        ];
    }

    public function headings():array{
        return[
            'ROOM',
            'NAME',
            'EMAIL',
            'PHONENUMBER',
            'START DATE',
            'END DATE',
            'STATUS',
            'CREATED AT' 
        ];
    } 
   
}
