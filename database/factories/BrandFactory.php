<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Brand;

class BrandFactory extends Factory
{

    use HasFactory;
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'logo_url' => $this->faker->randomElement([
                'https://ih1.redbubble.net/image.5160944228.1058/raf,360x360,075,t,fafafa:ca443f4786.u6.jpg',
                'https://pictures.trbna.com/image/cfba80fb-24e6-4e1c-a911-57a8a0242358?width=1920&quality=70'
            ]),
        ];
    }
}
