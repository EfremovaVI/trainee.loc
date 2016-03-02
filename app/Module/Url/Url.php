<?php
/**
 * Create url
 *
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Url;

class Url
{
    /**
     * Get url sort
     *
     * @return string
     */
    public static function getUrlSort()
    {
        // переделать в универсальный для формирования всех урлов
        if (!empty($_SERVER['QUERY_STRING'])) {
            $query = explode('&', $_SERVER['QUERY_STRING']);
            $param = [];
            foreach ($query as $item) {
                $params = explode('=', $item);
                if ($params[0] != 'sort' && $params[0] != 'order') {
                    $param[] = $params[0] . '=' . $params[1];
                }
            }
            if (count($param) < 1) {
                $pageURL = $_SERVER['REDIRECT_URL'] . '?';
            } else {
                $pageURL = $_SERVER['REDIRECT_URL'] . '?' . implode('&', $param)
                    . '&';
            }
        } else {
            $pageURL = $_SERVER['REDIRECT_URL'] . '?';
        }
        return $pageURL;
    }

    /**
     * Get url page
     *
     * @return string
     */
    public static function getUrlPage()
    {
        if (!empty($_SERVER['QUERY_STRING'])) {
            $query = explode('&', $_SERVER['QUERY_STRING']);
            $param = [];
            foreach ($query as $item) {
                $params = explode('=', $item);
                if ($params[0] != 'page') {
                    $param[] = $params[0] . '=' . $params[1];
                }
            }
            if (count($param) < 1) {
                $pageURL = $_SERVER['REDIRECT_URL'] . '?';
            } else {
                $pageURL = $_SERVER['REDIRECT_URL'] . '?' . implode('&', $param)
                    . '&';
            }
        } else {
            $pageURL = $_SERVER['REDIRECT_URL'] . '?';
        }
        return $pageURL;
    }

    /**
     * Get url
     *
     * @param $url
     *
     * @return mixed
     */
    public static function getUrl($url)
    {
        $rus = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л',
                'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш',
                'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е',
                'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с',
                'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю',
                'я', ' ', '?', '/', "\/", ',', '.', '+'];

        $lat = ['a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k',
                'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c',
                'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', 'a', 'b',
                'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm',
                'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '-', '', '', '', '', '-',
                ''];

        $url = str_replace($rus, $lat, $url);
        return $url;
    }
}