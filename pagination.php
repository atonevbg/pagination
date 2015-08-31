<?php
include './database.php';

class Pagination extends Database
{
    public $iCount;
    public $iRange;
    public $iLimit;
    public $iCurrentPage;

    public function __construct()
    {
    }

    public function create()
    {
        $output = '';
        
        $iTotalPages = ceil($this->iCount / $this->iLimit);

        // first and previous page
        if ($this->iCurrentPage > 1 ) {
            $iPrevious = $this->iCurrentPage - 1;
            $output .= "<a href='?page=1'>First</a> ";
            $output .= "<a href='?page=$iPrevious'>Previous</a>";
        }

        // show previous pages in range
        for ($i = $this->iCurrentPage - $this->iRange; $i < $this->iCurrentPage; $i++) {
            if ($i>0) { 
                $output .= "<a href='?page=$i'>$i</a>";
            }
        }
        
        // active page
        $output .= "<b> $i </b>";
        
        // show next pages in range
        for ($i = $this->iCurrentPage+1; $i <= $iTotalPages; $i++) {
            $output .= "<a href='?page=$i'>$i</a>";
                if($i >= $this->iCurrentPage+$this->iRange){
                    break;
                }
        }
        
        // next and last page
        if ($this->iCurrentPage != $iTotalPages ) {
            $iNext = $this->iCurrentPage + 1;
            $output .= "<a href='?page=$iNext'>Next</a> ";
            $output .= "<a href='?page=$iTotalPages'>Last</a>";
        }
        
        return $output;
    }
}
?>