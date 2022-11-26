<?php

namespace App\Exports;

use App\Models\TouristSpotBooking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class TouristSpotBookingExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return TouristSpotBooking::with(['user'])->get();
    }

    
    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($booking): array
    {
        return [
            $booking->user->email,
            $booking->booking_date,
            $booking->number_of_persons,
            $booking->status,
            $booking->created_at,
        ];
    }

    public function headings():array{
        return[
            'EMAIL',
            'BOOKING DATE',
            'NUMBER OF PEOPLE',
            'STATUS',
            'CREATED AT' 
        ];
    } 
}