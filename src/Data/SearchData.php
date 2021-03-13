<?php


namespace App\Data;


use App\Entity\Catcontrat;
use App\Entity\Secteur;

class SearchData
{
    /**
     * @var int
     */
    public $page = 1 ;
    /**
     * @var string
     */
    public $q = '';
    /**
     * @var Catcontrat []
     */
    public $categorie = [];
    /**
     * @var Secteur []
     */
    public $secteur = [];
    /**
     * @var string
     */
    public $pays;
    /**
     * @var integer
     */    
    public $min;
    /**
     * @var integer
     */
    public $max;
    /**
     * @var integer
     */
    public $etud;
    
    /**
     * @var integer
     */
    public $exp;


}