<?php

namespace App\Controllers;

class CheckListController {

    const MIN_COUNT_WORDS = 4;
    const KEYWORDS = ['banana', 'apple'];

    public function index() {
        if (isset($_POST['content'])) {
            $content = $_POST['content'];
            $counterWords = 0;
            $fullCountWords = count(explode(" ", $content)) > 0 ? count(explode(" ", $content)) : 1;

            if ($fullCountWords < self::MIN_COUNT_WORDS) {
                $response = json_encode(['status' => false, 'message' => 'Content should be more ' . self::MIN_COUNT_WORDS . ' words' ]);
                echo $response;
                return $response;
            }
            foreach (self::KEYWORDS as $keyword) {
                $countWords = substr_count($content, $keyword);                
                $counterWords = $countWords > 0 ? ++$counterWords : $counterWords;
            }
            
            $response = json_encode([
                'status' => true,
                'content' => $content,
                'keywords used' => $counterWords,
                'average keywords density' => number_format($counterWords / $fullCountWords, 2),
                'fullCountWords' => $fullCountWords
            ]);
            echo $response;

            return $response;

        } else {
            $response = json_encode(['status' => false, 'message' => 'Error input parameter' ]);
            echo $response;
            return $response;
        }
    }
}