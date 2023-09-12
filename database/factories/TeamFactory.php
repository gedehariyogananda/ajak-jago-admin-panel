<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'id' => '1',
                'name' => 'C-LEVEL',
                'identifier' => 'c-level',
        ];

    }

    // public function customDefination(){
    //     return [
    //         'id' => '2',
    //         'name' => 'USER',
    //         'identifier' => 'user',
    // ];
    // }

    // public function customDefination2(){
    //     return [
    //         'id' => '3',
    //         'name' => 'IT-ADDMINISTRATION',
    //         'identifier' => 'it-addministration',
    //     ];
    // }

}
