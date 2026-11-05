<?php

namespace Tests\Feature;

use Tests\TestCase;

class HowItWorksPageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_public_how_it_works_page_explains_the_three_party_journey(): void
    {
        $response = $this->get(route('how-it-works'));

        $response->assertOk()
            ->assertSee('Two hearts.')
            ->assertSee('Candidate A')
            ->assertSee('Candidate B')
            ->assertSee('Family Rep / Elder')
            ->assertSee('Choose your perspective')
            ->assertSee('For the Candidate')
            ->assertSee('For the Family Representative')
            ->assertSee('For the Family')
            ->assertSee(route('how-it-works'));
    }
}
