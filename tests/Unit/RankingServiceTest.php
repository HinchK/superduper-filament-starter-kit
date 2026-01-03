<?php

namespace Tests\Unit;

use App\Services\RankingService;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RankingServiceTest extends TestCase
{
    /** @test */
    public function it_ranks_scores_correctly_with_ties()
    {
        $service = new RankingService();
        $scores = collect([
            (object)['total_score' => 75],
            (object)['total_score' => 72],
            (object)['total_score' => 72],
            (object)['total_score' => 80],
        ]);

        $ranked = $service->rankScores($scores);

        $this->assertEquals('T1', $ranked[0]->rank_display); // 72
        $this->assertEquals('T1', $ranked[1]->rank_display); // 72
        $this->assertEquals('3', $ranked[2]->rank_display);  // 75
        $this->assertEquals('4', $ranked[3]->rank_display);  // 80
    }

    /** @test */
    public function it_ranks_scores_without_ties()
    {
        $service = new RankingService();
        $scores = collect([
            (object)['total_score' => 75],
            (object)['total_score' => 72],
            (object)['total_score' => 80],
        ]);

        $ranked = $service->rankScores($scores);

        $this->assertEquals('1', $ranked[0]->rank_display);
        $this->assertEquals('2', $ranked[1]->rank_display);
        $this->assertEquals('3', $ranked[2]->rank_display);
    }
}
