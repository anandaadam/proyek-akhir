<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\FuncCall;

class TipePenggunaModel extends Model
{
    public function indexTipePengguna()
    {
        $db = db_connect();
        $query = $db->table('tipe_pengguna')->get();

        return $query;
    }
}
