<?php

namespace Interlink\LabelResolver;

use PDO;

class PdoLookupLabelResolver implements LabelResolverInterface
{
    private $pdo;
    private $tablename;
    private $keycolumn;
    private $labelcolumn;
    
    public function __construct(PDO $pdo, $tablename, $keycolumn, $labelcolumn)
    {
        $this->pdo = $pdo;
        $this->tablename = $tablename;
        $this->keycolumn = $keycolumn;
        $this->labelcolumn = $labelcolumn;
    }
    
    public function resolve($reference)
    {
        $statement = $this->pdo->prepare(
            "SELECT " . $this->labelcolumn . " FROM " . $this->tablename . " WHERE " . $this->keycolumn . '=:reference'
        );
        $statement->execute(array(":reference" => $reference));
        $rows = $statement->fetchAll();
        if (count($rows)!=1) {
            return null;
        }
        $row = $rows[0];
        return $row[$this->labelcolumn];
        
    }
}
