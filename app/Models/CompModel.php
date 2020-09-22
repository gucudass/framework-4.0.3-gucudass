<?php namespace App\Models;

use CodeIgniter\Model;

class CompModel extends Model
{
    protected $table = 'eq_company';

    protected $primaryKey = 'comp_no';
    protected $returnType = 'array';

    // 업데이트 가능 컬럼
    protected $allowedFields = ['comp_type', 'comp_name', 'is_deleted', 'deleted_ts'];
}
