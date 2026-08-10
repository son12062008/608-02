<?php
// 1. ตั้งค่าการเชื่อมต่อฐานข้อมูล
$host     = "sql300.infinityfree.com";
$username = "if0_42363615361632";
$password = "s1o2n345";
$dbname   = "if0_42363615_student";

$conn = @new mysqli($host, $username, $password, $dbname);

if ($conn && !$conn->connect_error) {
    $conn->set_charset("utf8mb4");
}

// 2. ดึงข้อมูลเฉพาะ ID = 5 คนเดียว
$student = null;
if (!$conn->connect_error) {
    $target_id = 2;
    $sql = "SELECT * FROM students WHERE id = $target_id LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $student = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>งานที่ 2 - แสดงข้อมูลเฉพาะ ID 5</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    
    <!-- ปุ่มนำทาง (Navigation Buttons) -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <!-- ปุ่มย้อนกลับหน้าแรกภาษาอังกฤษ -->
            <a href="index.php" class="btn btn-secondary me-2">Back to All Records</a>
        </div>
        <div>
            <!-- ปุ่ม View Source ลิงก์ไปยัง GitHub แท็บใหม่ -->
            <a href="https://github.com/YOUR_USERNAME/YOUR_REPOSITORY" target="_blank" class="btn btn-outline-dark">
                View Source on GitHub
            </a>
        </div>
    </div>

    <!-- งานที่ 2: แสดงตารางดึงมาแค่ ID 5 คนเดียว -->
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="card-title mb-0">งานที่ 2: แสดงข้อมูลเฉพาะ ID = 5</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableTask2" class="table table-striped table-hover table-bordered w-100">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">เลขที่</th>
                            <th>ID จริง</th>
                            <th>รหัสนักเรียน</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>ชั้น</th>
                            <th>ห้อง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($student): ?>
                            <tr class="table-warning fw-bold">
                                <td class="text-center">1</td>
                                <td><?php echo $student['id']; ?></td>
                                <td><?php echo $student['student_id']; ?></td>
                                <td><?php echo $student['firstname']; ?></td>
                                <td><?php echo $student['lastname']; ?></td>
                                <td><?php echo $student['education_level']; ?></td>
                                <td><?php echo $student['room']; ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-danger">ไม่พบข้อมูล ID = 5</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript Script -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tableTask2').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/th.json"
        }
    });
});
</script>

</body>
</html>
