<?php

namespace Tests\Unit;

use App\Http\Controllers\GeneralOneController;
use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GeneralOneControllerTest extends TestCase
{
    public function test_DateFilterWithWeekend()
    {
        $controller = new GeneralOneController();

        $request = new Request([
            'date' => '2023-06-17', // Saturday
            'time' => '09:00:00',
            'duration' => 60,
            'country' => 1,
        ]);

        $response = $controller->dateFilter($request);

        $expectedResult = [
            'status' => 'ok',
            'date_view' => '<div class="container">
                <div class=" py-5 destination-result-select preloader-overlay ">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="date">
                                Datum:
                                <span>
                                    <strong>
                                        17-06-2023
                                    </strong>
                                </span>
                                <span>
                                    <strong>
                                        It is weekend! Saturday
                                    </strong>
                                </span>
                                <span>
                                    <strong>

                                    </strong>
                                </span>
                                <span>
                                    <strong>

                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            ',
        ];

        $this->assertEquals($expectedResult['status'], $response['status']);
        $this->assertStringContainsString('It is weekend!', $response['date_view']);
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

        $response = $controller->dateFilter($request);

        $expectedResult = [
            'status' => 'ok',
            'date_view' => '<div class="container">
                <div class=" py-5 destination-result-select preloader-overlay ">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="date">
                                Datum:
                                <span>
                                    <strong>
                                    19-06-2023
                                    </strong>
                                </span>
                                <span>
                                    <strong>
                                    Work day! Monday
                                    </strong>
                                </span>
                                <span>
                                    <strong>

                                    </strong>
                                </span>
                                <span>
                                    <strong>

                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            ',
        ];

        $this->assertEquals($expectedResult['status'], $response['status']);
        $this->assertStringContainsString('Work day', $response['date_view']);
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

        $response = $controller->dateFilter($request);

        $expectedResult = [
            'status' => 'ok',
            'date_view' => '<div class="container">
                <div class=" py-5 destination-result-select preloader-overlay ">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="date">
                                Datum:
                                <span>
                                    <strong>
                                    25-12-2023, 1.svátek vánoční
                                    </strong>
                                </span>
                                <span>
                                    <strong>
                                    1.svátek vánoční
                                    </strong>
                                </span>
                                <span>
                                    <strong>

                                    </strong>
                                </span>
                                <span>
                                    <strong>

                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            ',
        ];

        $this->assertEquals($expectedResult['status'], $response['status']);
        $this->assertStringContainsString('1.svátek vánoční', $response['date_view']);
    }
}
