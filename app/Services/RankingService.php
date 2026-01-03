<?php

namespace App\Services;

use Illuminate\Support\Collection;

class RankingService
{
    /**
     * Rank a collection of scores (lowest score first).
     * Adds a 'rank_display' attribute to each item (e.g., T1, T1, 3).
     */
    public function rankScores(Collection $scores): Collection
    {
        if ($scores->isEmpty()) {
            return $scores;
        }

        // Sort by total_score ascending
        $sorted = $scores->sortBy('total_score')->values();

        $ranked = $sorted->map(function ($score, $index) use ($sorted) {
            $rank = $index + 1;
            
            // Check for ties
            $isTie = $sorted->where('total_score', $score->total_score)->count() > 1;
            
            if ($isTie) {
                // Find the first occurrence of this score to get the base rank
                $firstIndex = $sorted->search(fn($item) => $item->total_score === $score->total_score);
                $baseRank = $firstIndex + 1;
                $score->rank_display = 'T' . $baseRank;
                $score->rank_value = $baseRank;
            } else {
                $score->rank_display = (string)$rank;
                $score->rank_value = $rank;
            }

            return $score;
        });

        return $ranked;
    }
}
