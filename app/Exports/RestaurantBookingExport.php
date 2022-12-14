<?php

namespace App\Exports;

use App\Models\RestaurantBooking;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class RestaurantBookingExport implements FromCollection, WithMapping, WithHeadings
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
       return RestaurantBooking::with(['user', 'table'])->whereDate('created_at', '>=', $this->created_at)->get();
    }

    
    // map what a single member row should look like
    // this method will iterate over each collection item
    public function map($booking): array
    {
        return [
            $booking->table->table_number,
            $booking->user->first_name . ' ' . $booking->user->last_name,
            $booking->user->email,
            $booking->user->number,
            $booking->booking_date,
            $booking->dine_in_time,
            $booking->dine_out_time,
            $booking->number_of_persons,
            $booking->status,
            $booking->created_at,
        ];
    }

    public function headings():array{
        return[
            'TABLE',
            'NAME',
            'EMAIL',
            'PHONENUMBER',
            'BOOKING DATE',
            'DINE IN TIME',
            'DINE OUT TIME',
            'NUMBER OF PEOPLE',
            'STATUS',
            'CREATED AT' 
        ];
    } 
}
