<?php

namespace Database\Factories;

use App\Models\TicketSupport;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text(),
            'user_id' => User::all()->random(1)->first()->id,
            'support_ticket_id' => TicketSupport::all()->random(1)->first()->id
        ];
    }
}
