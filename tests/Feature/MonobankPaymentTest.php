<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MonobankPaymentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post(route('mono.webhook'), [
            'invoiceId' => '1',
            'status' => 'success',
            'amount' => 100,
            'reference' => '4840366606',
            'destination' => 'Оплата води на сайті akva.loc'
        ]);

        $this->assertDatabaseHas('monobank_payments', ['invoiceId' => '1']);



        $response->assertStatus(200);
    }


}
