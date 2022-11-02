<?php

namespace Tests\Feature;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;
     
     function test_can_get_all_books(){
        //en lugar de usar la ruta como tal se usa la rutas con nombres de laravel
        $book = Book::factory()->create();
        $this->getJson(route('books.index'))
            ->assertJsonFragment([
            'title'=>$book[0]->title;
        ]);
     }

     function test_can_get_one_book(){
        $book = Book::factory()->create();
        $response = $this->getJson(route('books.show', $book))
            ->assertJsonFragment([
            'title' => $book->title
        ]);
     }

     function test_can_create_book(){
        $this->postJson(route('books.store'),[])
        ->assertJsonValidationErrorFor('title');
        $this->postJson(route('books.store'),[
            'title'=>'My new book'
        ])->assertJsonFragment([
             'title'=>'My new book'
            ]);
            $this->assertDatabaseHas('boooks',[
                'title'=>'My new book'
        ]);
     }

     function test_can_update_books(){
        $book = Book::factory()->create();

        $this->patchJson(route('books.update',$book).[])
        ->assertJsonVAlidationErrorFor('title');

        $this->patchJson(route('books.update',$books),[
            'title'=>'Edited book'
        ])->assertJsonFragment([
            'title'=>'Edited book'
        ]);
     }

     function test_can_destroy_books(){
        $book = Book::factory()->create();

        $this->deleteJson(route('books.destroy',$book))
            ->assertNoContent();
            $this->assertDatabaseCount('books',0);
     }


}
