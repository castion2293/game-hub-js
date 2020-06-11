<?php

namespace SuperStation\Gamehub\Traits;

trait ApiExceptionTrait
{
    /**
     * 整合錯誤資料訊息
     *
     * @param array $errorData
     * @return string
     */
    private function makeExceptionMessage(array $errorData = null): string
    {
        $responseText = '';

        foreach ($errorData ?? [] as $key => $text) {
            $responseText .= $key . ': ' . json_encode($text, JSON_UNESCAPED_UNICODE) . ' / ';
        }

        $responseText = rtrim($responseText, ' / ');

        return $responseText;
    }
}