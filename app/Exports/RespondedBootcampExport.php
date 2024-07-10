<?php

namespace App\Exports;

use App\Models\Bootcamp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RespondedBootcampExport implements FromCollection, WithHeadings
{
    protected $data;

public function __construct(Bootcamp $bootcamp)
{
    $this->data = $bootcamp->users->map(function ($user) {
        return [
            'Name' => $user->name,
            'Email' => $user->email,
            'Level Education' => $user->level_education,
            'Provincial Origin' => $user->provincial_origin,
            'WA Number' => $user->wa_number,
            'Institusi' => $user->institusi,
            'Age' => $user->age,
            'Jurusan' => $user->pivot->jurusan,
            'Description' => $user->pivot->description,
            'Pengembangan diri' => $user->pivot->pengembangan,
            'Ekspetasi Kedepannya' => $user->pivot->expetasi,
            'File Cv' => 'https://controller.ajakjago.com/storage/' . $user->pivot->file_cv,
            'Bukti follow' => 'https://controller.ajakjago.com/storage/' . $user->pivot->bukti_follows,
            'Bukti share' => 'https://controller.ajakjago.com/storage/' . $user->pivot->bukti_shared,
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
            'Jurusan',
            'Description',
            'Pengembangan diri',
            'Ekspetasi Kedepannya',
            'File CV',
            'Bukti follow',
            'Bukti share',
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
