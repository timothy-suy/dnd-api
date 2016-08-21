<?php namespace App\Models;

interface DatabaseModelInterface {
    
    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable();
    
}