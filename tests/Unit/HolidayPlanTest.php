<?php

namespace Unit;

use App\Models\HolidayPlan;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class HolidayPlanTest extends TestCase
{
    private function getParamsHeaders()
    {
        $user = User::factory()->create();
        $token = $user->createToken(Str::random(10))->plainTextToken;
        return [
            'Authorization' => "Bearer {$token}",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }

    /**
     * Test Get All HolidayPlan whidout Token Bearer
     * EndPoint /api/holiday
     *
     * @test
     */
    public function getAllHolidayPlanWidoutBearer(): void
    {
        HolidayPlan::factory(10)->create();
        $response = $this->getJson('/api/holiday');
        $response->assertStatus(401);
    }

    /**
     * Test Get All HolidayPlan
     * EndPoint /api/holiday
     *
     * @test
     */
    public function getAllHolidayPlan(): void
    {
        HolidayPlan::factory(10)->create();
        $response = $this->getJson('/api/holiday', $this->getParamsHeaders());

        $response->assertStatus(200);
    }


    /**
     * Test Get One HolidayPlan with ID, without passed token Bearer
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function getOneHolidayPlanWithoutToken(): void
    {
        $holiday = HolidayPlan::factory()->create();
        $response = $this->getJson('/api/holiday/{$holiday->id}');

        $response->assertStatus(401);
    }

    /**
     * Test Get One HolidayPlan without ID
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function getOneHolidayPlanWithoutId(): void
    {
        $response = $this->getJson('/api/holiday/');

        $response->assertStatus(401);
    }

    /**
     * Test Get One HolidayPlan with ID
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function getOneHolidayPlan(): void
    {
        $holiday = HolidayPlan::factory()->create();
        $response = $this->getJson('/api/holiday/' . $holiday->id, $this->getParamsHeaders());

        $response->assertStatus(200);
    }


    /**
     * Test Post Create HolidayPlan, without passed token Bearer
     * EndPoint /api/holiday
     *
     * @test
     */
    public function postCreateHolidayPlanWithoutToken(): void
    {
        $payload = [
            'title' => Str::random(10),
            'description' => Str::random(150),
            'date' => fake()->date('Y-m-d H:i:s'),
            'location' => Str::random(10),
        ];

        $response = $this->postJson('/api/holiday', $payload);

        $response->assertStatus(401);
    }

    /**
     * Test Post Create HolidayPlan, without passed payload
     * EndPoint /api/holiday
     *
     * @test
     */
    public function postCreateHolidayPlanWithoutPayload(): void
    {
        $payload = [];

        $response = $this->postJson('/api/holiday', $payload, $this->getParamsHeaders());

        $response->assertStatus(422)
            ->assertJsonPath('errors.title', [
                trans('validation.required', ['attribute' => 'title'])
            ])
            ->assertJsonPath('errors.description', [
                trans('validation.required', ['attribute' => 'description'])
            ])
            ->assertJsonPath('errors.location', [
                trans('validation.required', ['attribute' => 'location'])
            ]);
    }

    /**
     * Test Post Create HolidayPlan
     * EndPoint /api/holiday
     *
     * @test
     */
    public function postCreateHolidayPlan(): void
    {
        $payload = [
            'description' => Str::random(150),
            'date' => fake()->date('Y-m-d'),
            'location' => Str::random(10),
            'title' => Str::random(10)
        ];

        $response = $this->postJson('/api/holiday', $payload, $this->getParamsHeaders());

        $response->assertStatus(201);
    }


    /**
     * Test Put Update HolidayPlan, without passed token Bearer
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function putUpdateHolidayPlanWithoutToken(): void
    {
        $holiday = HolidayPlan::factory()->create();
        $payload = [
            'title' => Str::random(10),
            'description' => Str::random(150),
            'date' => fake()->date('Y-m-d H:i:s'),
            'location' => Str::random(10),
        ];

        $response = $this->putJson('/api/holiday/' . $holiday->id, $payload);

        $response->assertStatus(401);
    }

    /**
     * Test Put Update HolidayPlan, without Payload
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function putUpdateHolidayPlanWithoutPayload(): void
    {
        $holiday = HolidayPlan::factory()->create();

        $payload = [];

        $response = $this->putJson('/api/holiday/' . $holiday->id, $payload, $this->getParamsHeaders());

        $response->assertStatus(422)
            ->assertJsonPath('errors.title', [
                trans('validation.required', ['attribute' => 'title'])
            ])
            ->assertJsonPath('errors.description', [
                trans('validation.required', ['attribute' => 'description'])
            ])
            ->assertJsonPath('errors.location', [
                trans('validation.required', ['attribute' => 'location'])
            ]);
    }

    /**
     * Test Put Update HolidayPlan
     * EndPoint /api/holiday
     *
     * @test
     */
    public function putUpdateHolidayPlan(): void
    {
        $holiday = HolidayPlan::factory()->create();

        $payload = [
            'description' => Str::random(150),
            'date' => fake()->date('Y-m-d'),
            'location' => Str::random(10),
            'title' => Str::random(10)
        ];

        $response = $this->putJson('/api/holiday/' . $holiday->id, $payload, $this->getParamsHeaders());

        $response->assertStatus(200);
    }


    /**
     * Test Delete HolidayPlan with ID, without passed token Bearer
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function deleteHolidayPlanWithoutToken(): void
    {
        $holiday = HolidayPlan::factory()->create();
        $response = $this->deleteJson('/api/holiday/{$holiday->id}');

        $response->assertStatus(401);
    }

    /**
     * Test Delete HolidayPlan, without ID
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function deleteHolidayPlanWithoutId(): void
    {
        $response = $this->deleteJson('/api/holiday/', $this->getParamsHeaders());

        $response->assertStatus(405);
    }

    /**
     * Test Delete HolidayPlan with ID
     * EndPoint /api/holiday/{id}
     *
     * @test
     */
    public function deleteHolidayPlan(): void
    {
        $holiday = HolidayPlan::factory()->create();

        $response = $this->deleteJson('/api/holiday/' . $holiday->id, [] ,$this->getParamsHeaders());

        $response->assertStatus(204);
    }
}
