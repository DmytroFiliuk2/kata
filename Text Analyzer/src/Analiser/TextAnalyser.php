<?php

namespace src\Analyser;

use DateTime;

class TextAnalyser
{
    /**
     * @const
     */
    public const  WORD = '[\s,]+';

    /**
     * @param string $text
     *
     * @return array
     */
    public function analise(string $text): array
    {
        mb_regex_encoding('UTF-8');
        $date = new DateTime('now');
        $loverText = mb_convert_case($text, MB_CASE_LOWER);
        return array(
            'Number of characters' => mb_strlen($text),
            'Number of words' => str_word_count($loverText, 0),
            'Number of sentences' => preg_match_all('([^\.\!\?]+[\.\?\!]*)', $text),
            'Frequency of characters' => $this->getCharactersFrequency($text),
            'Distribution of characters as a percentage of total' => $this->getCharactersDistribution($text),
            'Average word length' => $this->getAvgWordLen($text),
            'The average number of words in a sentence' => $this->wordsCountInSentence($text),
            'Top 10 most used words' => $this->topUsedWords($text, 10),
            'Top 10 longest words' => $this->topLongestWords($text, 10),
            'Top 10 shortest words' => $this->topShortestWords($text, 10),
            'Number of palindrome words' => null,
            'Top 10 longest palindrome words' => null,
            'date' => $date->format('Y-m-d-h-m')
        );
    }

    /**
     * @param $text
     * @return array
     */
    private function getCharactersFrequency($text): array
    {
        $resultArray = array();
        $chars =  mb_str_split($text);
        foreach ($chars as $char) {
            $resultArray[$char]++;
        }

        return $resultArray;
    }

    /**
     * @param string $text
     * @return float[]|int[]
     */
    private function getCharactersDistribution(string $text): array
    {
        $frequency = $this->getCharactersFrequency($text);
        $totalCount = array_sum($frequency);
        $resultDistribution = array_map(function ($value) use ($totalCount) {
            return $value / $totalCount;
        }, $frequency);

        return $resultDistribution;
    }

    /**
     * @param $text
     *
     * @return float
     */
    private function getAvgWordLen($text): float
    {
        $resultArray = $this->getWords($text);
        $count = count($resultArray);
        $resultLen = array_reduce($resultArray, function ($carry, $item) {
            $carry += mb_strlen($item);
            return $carry;
        });

        return $resultLen / $count;
    }

    /**
     * @param $text
     * @return float|int
     */
    private function wordsCountInSentence($text)
    {
        $sentences = mb_split('\.|\?|!', $text);
        $wordsCount = 0;
        foreach ($sentences as $sentence) {
            $wordsCount += preg_match_all('/[\p{L}\p{M}]+/u', $sentence);
        }

        return $wordsCount/count($sentences);
    }

    /**
     * @param $text
     *
     * @return string[]
     */
    private function getWords($text): array
    {
        return mb_split('[\s,]+', $text);
    }

    /**
     * @param $string
     * @param int $count
     * @return array
     */
    private function topUsedWords($string, int $count)
    {
        $words = $this->getWords($string);
        return $this->getTop($words, $count);
    }

    /**
     * @param array $dataRow
     * @param int $count
     *
     * @return array
     */
    private function getTop(array $dataRow, int $count){

        $resultArray = array();
        foreach ($dataRow as $data) {
            $resultArray[$data]++;
        }
        sort($resultArray);

        return array_slice($resultArray, 0, $count);
    }

    /**
     * @param string $text
     * @param int $int
     *
     * @return array
     */
    private function topLongestWords(string $text, int $int)
    {
        $words = $this->getWordsByLen($text);
        var_export($words);
        asort($words );
        array_reverse($words);
        var_export($words);

        return array_splice($words, 0, $int);
    }

    /**
     * @param string $text
     * @param int $int
     * @return array
     */
    private function topShortestWords(string $text, int $int)
    {
        $words =  $this->getWordsByLen($text);

        rsort($words);

        return array_splice($words, 0, $int);
    }

    /**
     * @param string $text
     * @return string|string[]
     */
    private function getWordsByLen(string $text)
    {
        $resultArray = array();

        $words = $this->getWords($text);
        foreach ($words as $word) {
            $resultArray[$word] = mb_strlen($word);
        }

        return $resultArray;
    }
}

