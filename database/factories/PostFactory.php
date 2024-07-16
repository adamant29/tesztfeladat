<?php
	
	namespace Database\Factories;
	
	use Illuminate\Database\Eloquent\Factories\Factory;
	use App\Models\User;
	use App\Models\Post;
	
	class PostFactory extends Factory
	{
		
		/**
		 * Define the model's default state.
		 *
		 * @return array
		 */
		public function definition()
		{
			
			return [
				'user_id' => User ::factory() ,
				'title'   => $this -> faker -> sentence ,
				'body'    => $this -> faker -> paragraph ,
			];
		}
	}
