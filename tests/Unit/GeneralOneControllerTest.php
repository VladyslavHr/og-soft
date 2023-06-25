<?php

namespace Tests\Unit;
// namespace Tests\Feature;

use App\Http\Controllers\GeneralOneController;
use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Support\Facades\View;
use Tests\TestCase;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneralOneControllerTest extends TestCase
{

    public function test_CheckApiRoute()
    {
        $response = $this->get('/api/check-api?country=1&date=19-06-2023&time=09:00:00&duration=60');

        $response->assertStatus(200);
    }

    public function test_DateFilterWithWeekend()
    {
        $controller = new GeneralOneController();

        $request = new Request([
            'date' => '2023-06-17', // Saturday
            'time' => '09:00:00',
            'duration' => 60,
            'country' => 1,
        ]);

        $response = $controller->checkApi($request);

        $responseData = json_decode($response->getContent(), true);

        $expectedResult = [
            'status' => 'ok',
            'date_result' => $responseData['date_result'],
            'message_result' => $responseData['message_result'],
            'date_end_result' => $responseData['date_end_result'],
            'time_result' => $responseData['time_result'],
        ];

        $this->assertEquals($expectedResult['status'], $responseData['status']);
        $this->assertStringContainsString('It is weekend!', $responseData['message_result']);
    }

    public function test_DateFilterWithWorkDay()
    {
        $controller = new GeneralOneController();

        $request = new Request([
            'date' => '2023-06-19', // Sunday
            'time' => '09:00:00',
            'duration' => 60,
            'country' => 1,
        ]);

        $response = $controller->checkApi($request);

        $responseData = json_decode($response->getContent(), true);

        $expectedResult = [
            'status' => 'ok',
            'date_result' => $responseData['date_result'],
            'message_result' => $responseData['message_result'],
            'date_end_result' => $responseData['date_end_result'],
            'time_result' => $responseData['time_result'],
        ];

        $this->assertEquals($expectedResult['status'], $responseData['status']);
        $this->assertStringContainsString('Work day', $responseData['message_result']);
    }

    public function test_DateFilterWithHoliday()
    {
        $controller = new GeneralOneController();

        $request = new Request([
            'date' => '2023-12-25', // 1.svátek vánoční
            'time' => '09:00:00',
            'duration' => 60,
            'country' => 1,
        ]);

        $response = $controller->checkApi($request);

        $responseData = json_decode($response->getContent(), true);

        $expectedResult = [
            'status' => 'ok',
            'date_result' => $responseData['date_result'],
            'message_result' => $responseData['message_result'],
            'date_end_result' => $responseData['date_end_result'],
            'time_result' => $responseData['time_result'],
        ];

        $this->assertEquals($expectedResult['status'], $responseData['status']);
        $this->assertStringContainsString('1.svátek vánoční', $responseData['message_result']);
    }
}
