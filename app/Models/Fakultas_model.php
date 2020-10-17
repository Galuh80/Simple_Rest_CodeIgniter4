<?php namespace App\Models;

use CodeIgniter\Model;

class Fakultas_model extends Model {

    public $tabel = 'fakultas';
    public $primaryKey = 'fakultas_id';
    public $allowedField = ['kode_fakultas','nama_fakultas']; 

    public function __construct()
    {
        parent::__construct();
        
    }

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */