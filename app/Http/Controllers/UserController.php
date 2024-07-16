<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Models\User;
	
	class UserController extends Controller
	{
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			
			return User ::with( 'posts' ) -> get();
		}
		
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}
		
		/**
		 * Store a newly created resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store( Request $request )
		{
			var_dump(1);
			$request -> validate( [
				                      'name'  => 'required|string|max:255' ,
				                      'email' => 'required|string|email|max:255|unique:users' ,
			                      ] );
			
			return User ::create( $request -> all() );
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param User $user
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( User $user )
		{
			
			return $user -> load( 'posts' );
		}
		
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit( $id )
		{
			//
		}
		
		/**
		 * Update the specified resource in storage.
		 *
		 * @param \Illuminate\Http\Request $request
		 * @param User                     $user
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request , User $user )
		{
			
			$request -> validate( [
				                      'name'  => 'sometimes|required|string|max:255' ,
				                      'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user -> id ,
			                      ] );
			
			$user -> update( $request -> all() );
			
			return $user;
			
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param User $user
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( User $user )
		{
			
			$user -> delete();
			
			return response() -> noContent();
		}
	}
