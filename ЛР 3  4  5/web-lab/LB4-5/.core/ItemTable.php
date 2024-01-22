

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/.core/index.php');

class Filter {
    public ?string $number;
    public ?int $campusId;
    public ?int $minStudents;
    public ?int $maxStudents;

    public function __construct(?string $number, ?int $campusId, ?int $minStudents, ?int $maxStudents) {
        $this->number = $number;
        $this->campusId = $campusId;
        $this->minStudents = $minStudents;
        $this->maxStudents = $maxStudents;
    }    
}

class ItemTable {
    private $db;
    private ?Filter $filter;

    public function __construct($db) {
        $this->db = $db;
        $this->filter = null;
    }

    public function set_filter(Filter $filter): void {
        $this->filter = $filter;
    }
    public function get_all_classrooms_with_campus_info(): array {
       
        $sql = "SELECT classroom.*, campus.name as campus_name FROM classroom JOIN campus ON classroom.campus = campus.id";

        $result = $this->db->query($sql);

        $classrooms = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $classrooms[] = $row;
            }
        }

        return $classrooms;
    }
    public function getAllCampuses() {
        $sql = "SELECT id, name FROM campus"; 
        $result = $this->db->query($sql);

        $campuses = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $campuses[] = $row;
            }
        }

        return $campuses;
    }
    public function get_filtered_classrooms(): array {
        $condition = [];
        $sql = "SELECT * FROM classroom";

        if ($this->filter) {
            if ($this->filter->number) {
                $number = $this->db->real_escape_string($this->filter->number);
                $condition[] = "number LIKE '%$number%'";
            }

            if ($this->filter->campusId) {
                $campusId = intval($this->filter->campusId);
                $condition[] = "campus = $campusId";
            }

            if ($this->filter->minStudents !== null && $this->filter->maxStudents !== null) {
                $minStudents = intval($this->filter->minStudents);
                $maxStudents = intval($this->filter->maxStudents);
                $condition[] = "students BETWEEN $minStudents AND $maxStudents";
            }

            if (!empty($condition)) {
                $sql .= " WHERE " . implode(" AND ", $condition);
            }
        }

        $result = $this->db->query($sql);

        $classrooms = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $classrooms[] = $row;
            }
        }

        return $classrooms;
    }

    public function getClassroomById($id) {
        $sql = "SELECT * FROM classroom WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }


    public function editClassroom($id, $photo, $number, $campus, $furniture, $students) {
        $sql = "UPDATE classroom SET photo = ?, number = ?, campus = ?, furniture = ?, students = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssisii', $photo, $number, $campus, $furniture, $students, $id);
        $stmt->execute();
    }


    public function addClassroom($photo, $number, $campus, $furniture, $students) {
        $sql = "INSERT INTO classroom (photo, number, campus, furniture, students) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssisi', $photo, $number, $campus, $furniture, $students);
        $stmt->execute();
    }

    public function deleteClassroom($id) {
        $sql = "DELETE FROM classroom WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

}
