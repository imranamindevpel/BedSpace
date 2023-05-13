<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Profile;
use App\Models\User;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'men'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'bio' => $this->faker->paragraph
        ];
    }
}
