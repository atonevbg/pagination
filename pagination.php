<?php

include './database.php';

class Pagination extends Database {

    private $count;
    private $range;
    private $limit;
    private $currentPage;

    public function getCount() {
        return $this->count;
    }

    public function getRange() {
        return $this->range;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    public function setRange($range) {
        $this->range = $range;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function create() {
        $output = '';

        $iTotalPages = ceil($this->count / $this->limit);

        // show back links if you are not on 1 page
        if ($this->currentPage > 1) {
            $iPrevious = $this->currentPage - 1;
            $output .= "<a href='?page=1'>First</a> ";
            $output .= "<a href='?page=$iPrevious'>Previous</a> ";
        }

        // show previous pages in range
        for ($i = $this->currentPage - $this->range; $i < ($this->currentPage + $this->range) + 1; $i++) {
            // generate and show pages
            if (($i > 0) && ($i <= $iTotalPages)) {
                // if we are on current page
                if ($i == $this->currentPage) {
                    $output .= "<b>$i</b>";
                } else {
                    $output .= "<a href='?page=$i'>$i</a> ";
                }
            }
        }
        // show next and last page if are not on last page       
        if ($this->currentPage != $iTotalPages) {
            $iNext = $this->currentPage + 1;
            $output .= "<a href='?page=$iNext'>Next</a> ";
            $output .= "<a href='?page=$iTotalPages'>Last</a> ";
        }

        return $output;
    }
}

?>