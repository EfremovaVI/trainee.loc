<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\Pagination;

class PaginationArray
{
    public $currentPage;
    private $_page = 5;
    private $_data = [];
    private $_url;

    /**
     * @param array $data
     * @param       $page
     * @param       $currentPage
     * @param       $url
     *
     * @return array
     */
    public function getPaginate(array $data, $page, $currentPage, $url)
    {
        $this->currentPage = $currentPage;
        $this->currentPage = $this->currentPage < 1 ? 1 : $this->currentPage;
        $this->_page = $page;
        $this->_data = $data;
        $this->_url = $url;

        // start position in the $display_array
        // +1 is to account for total values.
        $start = ($this->currentPage - 1) * ($this->_page + 1);
        $offset = $this->_page + 1;

        $outArray = array_slice($this->_data, $start, $offset);

        return $outArray;
    }

    /**
     * @return array
     */
    public function getPager()
    {
        $countPage = count($this->_data);
        $countLinkPage = ceil($countPage / $this->_page);
        $pager = [];
        for ($i = 1; $i < $countLinkPage; $i++) {
            $pager[] = '<a href="' . $this->_url . '?page=' . $i . '">'
                . $i . '</a> &nbsp';
        }
        return $pager;
    }
}