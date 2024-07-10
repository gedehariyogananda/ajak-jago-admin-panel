<?php

namespace App\Exports;

use App\Models\Webinar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RespondedWebinarExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Webinar $webinar)
    {
        $this->data = $webinar->users->map(function ($user) {
            return [
                'Name' => $user->name,
                'Email' => $user->email,
                'Level Education' => $user->level_education,
                'Provincial Origin' => $user->provincial_origin,
                'WA Number' => $user->wa_number,
                'Institusi' => $user->institusi,
                'Age' => $user->age,
                'Info' => $user->pivot->info,
                'Next Idea' => $user->pivot->next_idea,
                'Bukti follow' => 'https://controller.ajakjago.com/storage/' . $user->pivot->bukti_follow,
                'Bukti share' => 'https://controller.ajakjago.com/storage/' . $user->pivot->bukti_share,
            ];
        });
    }

    public function headings(): array
    {
        // Tentukan judul kolom/kolom header Excel di sini
        return [
            'Name',
            'Email',
            'Level Education',
            'Provincial Origin',
            'WA Number',
            'Institusi',
            'Age',
            'Info',
            'Next Idea',
            'Bukti Follow',
            'Bukti Share',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengembalikan data dari $this->data
        return $this->data;
    }
}
