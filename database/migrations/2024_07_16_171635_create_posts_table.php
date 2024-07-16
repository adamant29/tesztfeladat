<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	class CreatePostsTable extends Migration
	{
		
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			
			Schema ::create( 'posts' , function( Blueprint $table ){
				
				$table -> id();
				$table -> foreignId( 'user_id' ) -> constrained() -> onDelete( 'cascade' ); //Nem tudom szükséges-e de törlődnek a postok, ha a user is
				//$table -> foreignId( 'user_id' ) -> constrained(); // ha szeretnéd, hogy a postok megmaradjanak :)
				$table -> string( 'title' );
				$table -> text( 'body' );
				$table -> timestamps();
			} );
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			
			Schema ::dropIfExists( 'posts' );
		}
	}
