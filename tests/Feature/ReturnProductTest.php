<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;

class ReturnProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_return_product(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user['id']
        ]);
        $book = Book::factory()->create();
        $orderItem = OrderItem::factory()->create([
            'book_id' => $book['id'],
            'order_id' => $order['id']
        ]);
        $response = $this->delete('/order/'.$orderItem['id']);

        $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('order/previous');
    }
}
