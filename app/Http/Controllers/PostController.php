<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Models\Post;
	
	class PostController extends Controller
	{
		
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			
			return Post ::with( 'user' ) -> get();
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
			
			$request -> validate( [
				                      'user_id' => 'required|exists:users,id' ,
				                      'title'   => 'required|string|max:255' ,
				                      'body'    => 'required|string' ,
			                      ] );
			
			return Post ::create( $request -> all() );
		}
		
		/**
		 * Display the specified resource.
		 *
		 * @param Post $post
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( Post $post )
		{
			
			return $post -> load( 'user' );
			
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
		 * @param Post                     $post
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request , Post $post )
		{
			
			$request -> validate( [
				                      'user_id' => 'sometimes|required|exists:users,id' ,
				                      'title'   => 'sometimes|required|string|max:255' ,
				                      'body'    => 'sometimes|required|string' ,
			                      ] );
			
			$post -> update( $request -> all() );
			
			return $post;
		}
		
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param Post $post
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( Post $post )
		{
			
			$post -> delete();
			
			return response() -> noContent();
		}
	}
