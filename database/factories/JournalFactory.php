<?php

namespace Database\Factories;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JournalFactory extends Factory
{
    protected $model = Journal::class;

    public function definition(): array
    {
        $submissionChance = $this->faker->boolean(90); // 90% chance of submission
        $submittedAt = $submissionChance ? now() : null;

        return [
            'user_id' => User::factory(),
            'entry_date' => $this->faker->dateTimeBetween('2025-04-01', '2025-04-30'),
            'mengawali_hari_dengan_berdoa' => $this->faker->boolean(80),
            'baca_alkitab_pl' => $this->faker->boolean(75),
            'baca_alkitab_pb' => $this->faker->boolean(75),
            'hadir_kelas_sc' => $this->faker->boolean(90),
            'hadir_css' => $this->faker->boolean(85),
            'hadir_cgg' => $this->faker->boolean(85),
            'merapikan_tempat_tidur' => $this->faker->boolean(95),
            'menyapa_orang_tua' => $this->faker->boolean(90),
            'is_submitted' => $submissionChance,
            'parent_signature' => $submissionChance ? 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==' : null,
            'attachments' => null,
            'status' => $submissionChance ? 'submitted' : 'draft',
            'submitted_at' => $submittedAt,
            'reviewed_at' => null,
            'reviewed_by' => null,
            'created_at' => function (array $attributes) {
                return $attributes['entry_date'];
            },
            'updated_at' => function (array $attributes) {
                return $attributes['entry_date'];
            }
        ];
    }

    /**
     * Configure the factory to generate journals for a specific user
     */
    public function forUser(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
            ];
        });
    }

    /**
     * Configure the factory to generate journals for a specific date
     */
    public function forDate(string $date)
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'entry_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
                'submitted_at' => $date,
            ];
        });
    }
}
