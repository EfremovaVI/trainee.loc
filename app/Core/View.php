<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Core;

class View
{
    /**
     * @param      $content
     * @param      $template
     * @param null $data
     * @param null $messages
     * @param null $pagination
     */
    public function generate($content, $template, $data = null,
        $messages = null, $pagination = null
    ) {
        include 'app/View/layouts/template.php';
    }
}