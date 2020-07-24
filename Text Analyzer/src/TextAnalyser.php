<?php

namespace src;

use DateTime;

class TextAnalyser
{
    /**
     * @const
     */
    public const  WORD_PATTERN = '[\s, ]+';

    /**
     * @param string $text
     *
     * @return array
     */
    public function analise(string $text): array
    {
        mb_regex_encoding('UTF-8');
        $date = new DateTime('now');
        $text = preg_replace('/[\r\n]+/', ' ', $text);
        $loverText = $this->stripPunctuation($text);

        return array(
            'Number of characters' => mb_strlen($text),
            'Number of words' => str_word_count($loverText, 0),
            'Number of sentences' => preg_match_all('([^.!?]+[.?!]*)', $text),
            'Frequency of characters' => $this->getCharactersFrequency($text),
            'Distribution of characters as a percentage of total' => $this->getCharactersDistribution($text),
            'Average word length' => $this->getAvgWordLen($loverText),
            'The average number of words in a sentence' => $this->wordsCountInSentence($text),
            'Top 10 most used words' => $this->topUsedWords($loverText, 10),
            'Top 10 longest words' => $this->topLongestWords($loverText, 10),
            'Top 10 shortest words' => $this->topShortestWords($loverText, 10),
            'Number of palindrome words' => $this->getPalindromeCount($loverText),
            'Top 10 longest palindrome words' => $this->getLongestPalindrome($loverText),
            'date' => $date->format('Y-m-d-h-m'),
            'The reversed text' => $this->mbStrRev($text),
            'The reversed words text' => $this->mbStrRevWords($text)
        );
    }

    /**
     * @param $text
     * @return array
     */
    private function getCharactersFrequency($text): array
    {
        $chars = mb_str_split($text);
        $resultArray = array_fill_keys($chars, 0);
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

        return array_map(fn($value) => number_format($value / $totalCount, 2), $frequency);
    }

    /**
     * @param $text
     *
     * @return string
     */
    private function getAvgWordLen($text): string
    {
        $wordsArray = $this->getWords($text);
        $count = count($wordsArray);
        $totalLen = array_reduce($wordsArray, static function ($carry, $item) {
            $carry += mb_strlen($item);
            return $carry;
        });
        $avgLen = $totalLen / $count;

        return number_format($avgLen, 2);
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
            $sentence = $this->stripPunctuation($sentence);
            $wordsCount += preg_match_all('/[\p{L}\p{M}]+/u', $sentence);
        }

        return number_format($wordsCount / count($sentences), 2);
    }

    /**
     * @param $text
     *
     * @return string[]
     */
    private function getWords($text): array
    {
        return mb_split(self::WORD_PATTERN, $text);
    }

    /**
     * @param $string
     * @param int $count
     * @return array
     */
    private function topUsedWords($string, int $count): array
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
    private function getTop(array $dataRow, int $count): array
    {
        $resultArray = array_fill_keys($dataRow, 0);
        foreach ($dataRow as $data) {
            $resultArray[$data]++;
        }

        asort($resultArray, SORT_NUMERIC);
        $resultArray = array_reverse($resultArray);

        return array_slice($resultArray, 0, $count);
    }

    /**
     * @param string $text
     * @param int $int
     *
     * @return array
     */
    private function topShortestWords(string $text, int $int): array
    {
        $words = $this->getWordsByLen($text);
        asort($words, SORT_NUMERIC);

        return array_splice($words, 0, $int);
    }

    /**
     * @param $text
     * @param int $int
     * @return array
     */
    private function topLongestWords($text, int $int): array
    {
        $words = $this->getWordsByLen($text);
        asort($words, SORT_NUMERIC);
        $words = array_reverse($words);

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
            if ($word !== '') {
                $resultArray[$word] = mb_strlen($word);
            }
        }

        return $resultArray;
    }

    /**
     * @param string $text
     * @return string|string[]|null
     */
    private function stripPunctuation(string $text)
    {
        $text = mb_strtolower($text);

        return preg_replace("/(?![.=$'€%-])\p{P}|[:punct]+/u", '', $text);
    }

    /**
     * @param string $text
     * @return int
     */
    private function getPalindromeCount(string $text): int
    {
        $words = $this->getWords($text);

        return count(array_filter($words, array($this, 'isPalindrome'), true));
    }

    /**
     * @param string $text
     * @param int $len
     * @return array
     */
    private function getLongestPalindrome(string $text, int $len = 10): array
    {
        $words = $this->getWords($text);
        $palindromeWords = array_filter(
            $words,
            array($this, 'isPalindrome'),
            true
        );

        $result = array_fill_keys($palindromeWords, 0);
        foreach ($palindromeWords as $word) {
            $result[$word] = mb_strlen($word);
        }

        asort($result);
        $result = array_reverse($result);

        return array_splice($result, 0, $len);
    }

    /**
     * @param $word
     *
     * @return bool
     */
    private function isPalindrome(string $word): bool
    {
        return mb_strlen($word) > 1 && $this->mbStrRev($word) === $word;
    }

    /**
     * @param string $text
     *
     * @return false|string
     */
    private function mbStrRev(string $text)
    {
        $rWord = iconv('utf-8', 'utf-16le', $text);

        return iconv('utf-16be', 'utf-8', strrev($rWord));
    }

    /**
     * @param string|null $text
     * @return string
     */
    private function mbStrRevWords(string $text): string
    {
        $result = $this->mbStrRev(' ' . $text);
        $words = $this->getWords($text);
        foreach ($words as $word) {
            $result = str_replace($this->mbStrRev($word) . ' ', $word . ' ', $result);
        }

        return $result;
    }
}
