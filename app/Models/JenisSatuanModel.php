<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisSatuanModel extends Model
{
    public function indexJenisSatuan()
    {
        $db = db_connect();
        $query = $db->table('jenis_satuan')->get();

        return $query;
    }
}
