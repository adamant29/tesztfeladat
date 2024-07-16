<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
class PostControllerTest extends TestCase
{
	use RefreshDatabase, WithFaker;
	
	/** @test */
	public function it_can_create_a_post()
	{
		$user = User::factory()->create();
		
		$postData = [
			'user_id' => $user->id,
			'title' => $this->faker->sentence,
			'body' => $this->faker->paragraph,
		];
		
		$response = $this->postJson('/api/posts', $postData);
		
		$response->assertStatus(201)
			->assertJson([
				             'title' => $postData['title'],
				             'body' => $postData['body'],
			             ]);
		
		$this->assertDatabaseHas('posts', $postData);
	}
	
	/** @test */
	public function it_can_show_a_post()
	{
		$post = Post::factory()->create();
		
		$response = $this->getJson('/api/posts/' . $post->id);
		
		$response->assertStatus(200)
			->assertJson([
				             'id' => $post->id,
				             'title' => $post->title,
				             'body' => $post->body,
			             ]);
	}
	
	/** @test */
	public function it_can_update_a_post()
	{
		$post = Post::factory()->create();
		
		$updatedData = [
			'title' => 'Updated Title',
			'body' => 'Updated Body',
		];
		
		$response = $this->putJson('/api/posts/' . $post->id, $updatedData);
		
		$response->assertStatus(200)
			->assertJson($updatedData);
		
		$this->assertDatabaseHas('posts', $updatedData);
	}
	
	/** @test */
	public function it_can_delete_a_post()
	{
		$post = Post::factory()->create();
		
		$response = $this->deleteJson('/api/posts/' . $post->id);
		
		$response->assertStatus(204);
		
		$this->assertDatabaseMissing('posts', ['id' => $post->id]);
	}
}
