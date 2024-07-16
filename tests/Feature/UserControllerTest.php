<?php
	
	namespace Tests\Feature;
	
	use Illuminate\Foundation\Testing\RefreshDatabase;
	use Illuminate\Foundation\Testing\WithFaker;
	use Tests\TestCase;
	use App\Models\User;
	
	class UserControllerTest extends TestCase
	{
		
		use RefreshDatabase , WithFaker;
		
		/** @test
		 * TEST - Create User
		 *
		 * */
		public function it_can_create_a_user()
		{
			
			$userData = [
				'name'  => $this -> faker -> name ,
				'email' => $this -> faker -> unique() -> safeEmail ,
			];
			
			$response = $this -> postJson( '/api/users' , $userData );
			
			$response -> assertStatus( 201 )
				-> assertJson( [
					               'name'  => $userData[ 'name' ] ,
					               'email' => $userData[ 'email' ] ,
				               ] );
			
			$this -> assertDatabaseHas( 'users' , $userData );
		}
		/** @test
		 * TEST - Show User
		 *
		 * */
		public function it_can_show_a_user()
		{
			
			$user = User ::factory() -> create();
			
			$response = $this -> getJson( '/api/users/' . $user -> id );
			
			$response -> assertStatus( 200 )
				-> assertJson( [
					               'id'    => $user -> id ,
					               'name'  => $user -> name ,
					               'email' => $user -> email ,
				               ] );
		}
		/** @test
		 * TEST - Update User
		 *
		 * */
		public function it_can_update_a_user()
		{
			
			$user = User ::factory() -> create();
			
			$updatedData = [
				'name'  => 'Updated Name' ,
				'email' => 'updated@example.com' ,
			];
			
			$response = $this -> putJson( '/api/users/' . $user -> id , $updatedData );
			
			$response -> assertStatus( 200 )
				-> assertJson( $updatedData );
			
			$this -> assertDatabaseHas( 'users' , $updatedData );
		}
		/** @test
		 * TEST - Delete User
		 *
		 * */
		public function it_can_delete_a_user()
		{
			
			$user = User ::factory() -> create();
			
			$response = $this -> deleteJson( '/api/users/' . $user -> id );
			
			$response -> assertStatus( 204 );
			
			$this -> assertDatabaseMissing( 'users' , [ 'id' => $user -> id ] );
		}
	}
