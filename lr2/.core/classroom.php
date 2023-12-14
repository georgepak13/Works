<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/lr2/.core/db.php");
class classroom
{
    public static function getAllFiltered(string $number, string $studentsfrom, string $studentsto, string $furniture): array
    {
        $condition = [];
        $sql =
            "SELECT 
                c.id as id, 
                c.photo as photo, 
                c.number as number, 
                cam.name as name, 
                c.furniture as furniture, 
                c.students as students
            FROM classroom c inner join web.campus cam on c.campus = cam.id";
        if(!empty($number))
        {
            $condition[] = " c.number like '%$number%' ";
        }
        if(!empty($furniture))
        {
            $condition[] = " c.furniture like '%$furniture%' ";
        }
        if(!empty($studentsfrom) && !empty($studentsto))
        {
            $condition[] = " c.students between $studentsfrom and $studentsto ";
        }
        if (!empty($condition))
        {
            $sql .= " where " . implode(" and ", $condition);
        }
        $query = DB::prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}