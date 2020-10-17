<?php

namespace App\Models;

use CodeIgniter\Model;

class Semester_model extends Model
{
    protected $table = 'semester';

    public function getSemester($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['semester_id' => $id])->getRowArray();
        }
    }

    public function insertSemester($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateSemester($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['semester_id' => $id]);
    }

    public function deleteSemester($id)
    {
        return $this->db->table($this->table)->delete(['semester_id' => $id]);
    }
}
