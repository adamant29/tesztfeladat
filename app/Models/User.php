<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	
	class User extends Model
	{
		
		use HasFactory;
		
		protected $fillable = [
			'name' ,
			'email' ,
		];
		
		// Reláció beállítása: Egy User-nek több Post-ja lehet
		public function posts()
		{
			
			return $this -> hasMany( Post::class );
		}
	}
