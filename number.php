<?php

$number = new Number();
$number->calc(4000);

class Number
{
    const ONE = 'I';
    const FIVE = 'V';
    const TEN = 'X';
    const FIFTY = 'L';
    const HUNDRED = 'C';
    const FIVE_HUNDRED = 'D';
    const THOUSAND = 'M';

    // exceptions
    const FOUR = 'IV';
    const NINE = 'IX';
    const FORTY = 'XL';
    const NINETY = 'XC';
    const FOUR_HUNDRED = 'CD';
    const NINE_HUNDRED = 'CM';

    public $_result = array();

    public function calc($number)
    {
        // thousands
        if($number >= 4000){
            echo  'Number is greater than 3999 cannot be converted';
        }
        elseif ($number >= 1000) {
            $n = floor($number / 1000);
            for ($i = 1; $i <= $n; $i++) {
                $this->_result[] = self::THOUSAND;
            }
            $this->calc($number % 1000);

            // hundreds
        } elseif ($number / 100 >= 1) {
            $n = floor($number / 100);
            if ($n == 9) {
                $this->_result[] = self::NINE_HUNDRED;
                $this->calc($number - 900);
            } elseif ($number / 500 >= 1) {
                $this->_result[] = self::FIVE_HUNDRED;
                $this->calc($number - 500);
            } elseif ($n == 4) {
                $this->_result[] = self::FOUR_HUNDRED;
                $this->calc($number - 400);
            } else {
                for ($i = 1; $i <= $n; $i++) {
                    $this->_result[] = self::HUNDRED;
                }
                $this->calc($number % 100);
            }

            // dozens
        } elseif ($number / 10 >= 1) {
            $n = floor($number / 10);
            if ($n == 9) {
                $this->_result[] = self::NINETY;
                $this->calc($number - 90);
            } elseif ($number / 50 >= 1) {
                $this->_result[] = self::FIFTY;
                $this->calc($number - 50);
            } elseif ($n == 4) {
                $this->_result[] = self::FORTY;
                $this->calc($number - 40);
            } else {
                for ($i = 1; $i <= $n; $i++) {
                    $this->_result[] = self::TEN;
                }
                $this->calc($number % 10);
            }

            // units
        } elseif ($number >= 0) {
            if ($number < 4) {
                for ($i = 1; $i <= $number; $i++) {
                    $this->_result[] = self::ONE;
                }
            } elseif ($number == 4) {
                $this->_result[] = self::FOUR;
            } elseif ($number > 5 && $number < 9) {
                $this->_result[] = self::FIVE;
                for ($i = 1; $i <= ($number - 5); $i++) {
                    $this->_result[] = self::ONE;
                }
            } elseif ($number == 9) {
                $this->_result[] = self::NINE;
            }

            // result
            echo implode('', $this->_result);
        }
    }
}