<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "suaking");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Enrollment
if (isset($_POST['save_enrollment'])) {
    try {
        // Insert new enrollment record
        $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
        $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);

        // Check if the combination of student_id and course_id already exists
        $check_duplicate_query = "SELECT * FROM enrollment WHERE StudentID='$student_id' AND CourseID='$course_id'";
        $check_duplicate_result = mysqli_query($connection, $check_duplicate_query);

        if (mysqli_num_rows($check_duplicate_result) > 0) {
            throw new Exception('Enrollment record with the same Student ID and Course ID already exists.');
        } else {
            // If not, proceed with the insertion
            $enrollment_date = mysqli_real_escape_string($connection, $_POST['enrollment_date']);
            $grade = mysqli_real_escape_string($connection, $_POST['grade']);

            $insert_enrollment_query = "INSERT INTO enrollment(StudentID, CourseID, EnrollmentDate, Grade) 
                                        VALUES ('$student_id', '$course_id', '$enrollment_date', '$grade')";
            $insert_enrollment_query_run = mysqli_query($connection, $insert_enrollment_query);

            if ($insert_enrollment_query_run) {
                $_SESSION['status'] = 'Enrollment record added successfully';
            } else {
                throw new Exception('Failed to add enrollment record: ' . mysqli_error($connection));
            }
            header('location: frontend/enrollment.php');
        }
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: frontend/enrollment.php');
    }
} elseif (isset($_POST['update_enrollment'])) {
    try {
        // Update existing enrollment record
        $update_enrollment_id = mysqli_real_escape_string($connection, $_POST['update_enrollment_id']);
        $update_student_id = mysqli_real_escape_string($connection, $_POST['update_student_id']);
        $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);

        // Check if the updated combination of student_id and course_id already exists
        $check_duplicate_query = "SELECT * FROM enrollment WHERE StudentID='$update_student_id' AND CourseID='$update_course_id' AND EnrollmentID <> '$update_enrollment_id'";
        $check_duplicate_result = mysqli_query($connection, $check_duplicate_query);

        if (mysqli_num_rows($check_duplicate_result) > 0) {
            throw new Exception('Enrollment record with the same Student ID and Course ID already exists.');
        }

        // If not, proceed with the update
        $update_enrollment_date = mysqli_real_escape_string($connection, $_POST['update_enrollment_date']);
        $update_grade = mysqli_real_escape_string($connection, $_POST['update_grade']);

        $update_enrollment_query = "UPDATE enrollment 
                                    SET EnrollmentDate='$update_enrollment_date', Grade='$update_grade' 
                                    WHERE EnrollmentID='$update_enrollment_id'";

        $update_enrollment_query_run = mysqli_query($connection, $update_enrollment_query);

        if (!$update_enrollment_query_run) {
            throw new Exception('Failed to update enrollment record: ' . mysqli_error($connection));
        }

        $_SESSION['status'] = 'Enrollment record updated successfully';
        header('location: /finalexamination/frontend/enrollment.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/enrollment.php');
    }
} elseif (isset($_GET['delete_enrollment'])) {
    try {
        // Delete enrollment record
        $delete_enrollment_id = mysqli_real_escape_string($connection, $_GET['delete_enrollment']);

        $delete_enrollment_query = "DELETE FROM enrollment WHERE EnrollmentID=?";
        $stmt = mysqli_prepare($connection, $delete_enrollment_query);
        mysqli_stmt_bind_param($stmt, "i", $delete_enrollment_id);
        mysqli_stmt_execute($stmt);

        if ($stmt) {
            $_SESSION['status'] = 'Enrollment record deleted successfully';
            header('location: frontend/enrollment.php');
        } else {
            throw new Exception('Failed to delete enrollment record: ' . mysqli_error($connection));

        }
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: frontend/enrollment.php');
    }
}


// Student
if (isset($_POST['save_student'])) {
    try {
        $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $date_of_birth = mysqli_real_escape_string($connection, $_POST['date_of_birth']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);

        $insert_query = "INSERT INTO student(StudentID, FirstName, LastName, DateOfBirth, Email, Phone) 
                         VALUES ('$student_id','$first_name', '$last_name', '$date_of_birth', '$email', '$phone')";
        $insert_query_run = mysqli_query($connection, $insert_query);

        if ($insert_query_run) {
            $_SESSION['status'] = 'Student record added successfully';
        } else {
            throw new Exception('Failed to add student record: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/student.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/student.php');
    }
} elseif (isset($_POST['update_student'])) {
    try {
        // Update existing student record
        $update_student_id = mysqli_real_escape_string($connection, $_POST['update_student_id']);
        $update_first_name = mysqli_real_escape_string($connection, $_POST['update_first_name']);
        $update_last_name = mysqli_real_escape_string($connection, $_POST['update_last_name']);
        $update_date_of_birth = mysqli_real_escape_string($connection, $_POST['update_date_of_birth']);
        $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);
        $update_phone = mysqli_real_escape_string($connection, $_POST['update_phone']);

        $update_query = "UPDATE student 
                         SET FirstName='$update_first_name', LastName='$update_last_name', 
                             DateOfBirth='$update_date_of_birth', Email='$update_email', Phone='$update_phone' 
                         WHERE StudentID='$update_student_id'";
        $update_query_run = mysqli_query($connection, $update_query);

        if ($update_query_run) {
            $_SESSION['status'] = 'Student record updated successfully';
        } else {
            throw new Exception('Failed to update student record: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/student.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/student.php');
    }
} elseif (isset($_GET['delete_student'])) {
    try {
        // Delete student record
        $delete_student_id = mysqli_real_escape_string($connection, $_GET['delete_student']);

        $delete_query = "DELETE FROM student WHERE StudentID='$delete_student_id'";
        $delete_query_run = mysqli_query($connection, $delete_query);

        if ($delete_query_run) {
            $_SESSION['status'] = 'Student record deleted successfully';
        } else {
            throw new Exception('Failed to delete student record: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/student.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/student.php');
    }
}


// Instructor
if (isset($_POST['save_instructor'])) {
    try {
        $instructor_id = mysqli_real_escape_string($connection, $_POST['instructor_id']);
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);

        $insert_query = "INSERT INTO instructor(InstructorID, FirstName, LastName, Email, Phone) 
                         VALUES ('$instructor_id','$first_name', '$last_name', '$email', '$phone')";
        $insert_query_run = mysqli_query($connection, $insert_query);

        if ($insert_query_run) {
            $_SESSION['status'] = 'Instructor record added successfully';
        } else {
            throw new Exception('Failed to add instructor record: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/instructor.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/instructor.php');
    }
} elseif (isset($_POST['update_instructor'])) {
    try {
        $update_instructor_id = mysqli_real_escape_string($connection, $_POST['update_instructor_id']);
        $update_instructor_first = mysqli_real_escape_string($connection, $_POST['update_first_name']);
        $update_instructor_last = mysqli_real_escape_string($connection, $_POST['update_last_name']);
        $update_instructor_email = mysqli_real_escape_string($connection, $_POST['update_email']);
        $update_instructor_phone = mysqli_real_escape_string($connection, $_POST['update_phone']);

        $update_query = "UPDATE instructor 
                         SET FirstName='$update_instructor_first', LastName='$update_instructor_last', Email='$update_instructor_email', Phone='$update_instructor_phone' 
                         WHERE InstructorID='$update_instructor_id'";
        $update_query_run = mysqli_query($connection, $update_query);

        if ($update_query_run) {
            $_SESSION['status'] = 'Instructor record updated successfully';
        } else {
            throw new Exception('Failed to update instructor record: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/instructor.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/instructor.php');
    }
} elseif (isset($_GET['delete_instructor'])) {
    try {
        $delete_instructor_id = mysqli_real_escape_string($connection, $_GET['delete_instructor']);

        $delete_query = "DELETE FROM instructor WHERE InstructorID='$delete_instructor_id'";
        $delete_query_run = mysqli_query($connection, $delete_query);

        if ($delete_query_run) {
            $_SESSION['status'] = 'Instructor record deleted successfully';
        } else {
            throw new Exception('Failed to delete instructor record: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/instructor.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/instructor.php');
    }
}


// Course
if (isset($_POST['add_course'])) {
    try {
        // Add new course
        $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);
        $course_name = mysqli_real_escape_string($connection, $_POST['course_name']);
        $instructor_id = mysqli_real_escape_string($connection, $_POST['instructor_id']);
        $credits = mysqli_real_escape_string($connection, $_POST['credits']);

        $insert_course_query = "INSERT INTO course(CourseID, CourseName, InstructorID, Credits) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insert_course_query);
        mysqli_stmt_bind_param($stmt, "issi", $course_id, $course_name, $instructor_id, $credits);
        $insert_course_query_run = mysqli_stmt_execute($stmt);

        if ($insert_course_query_run) {
            $_SESSION['status'] = 'Course added successfully';
        } else {
            throw new Exception('Failed to add course: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/course.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/course.php');
    }
} elseif (isset($_POST['update_course'])) {
    try {
        // Update existing course
        $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);
        $update_course_name = mysqli_real_escape_string($connection, $_POST['update_course_name']);
        $update_instructor_id = mysqli_real_escape_string($connection, $_POST['update_instructor_id']);
        $update_credits = mysqli_real_escape_string($connection, $_POST['update_credits']);

        $update_course_query = "UPDATE course SET CourseName=?, Credits=?, InstructorID=? WHERE CourseID=?";
        $stmt = mysqli_prepare($connection, $update_course_query);
        mysqli_stmt_bind_param($stmt, "ssii", $update_course_name, $update_credits, $update_instructor_id, $update_course_id);
        $update_course_query_run = mysqli_stmt_execute($stmt);

        if ($update_course_query_run) {
            $_SESSION['status'] = 'Course updated successfully';
        } else {
            throw new Exception('Failed to update course: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/course.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/course.php');
    }
} elseif (isset($_GET['delete_course'])) {
    try {
        // Delete course
        $delete_course_id = mysqli_real_escape_string($connection, $_GET['delete_course']);

        $delete_course_query = "DELETE FROM course WHERE CourseID=?";
        $stmt = mysqli_prepare($connection, $delete_course_query);
        mysqli_stmt_bind_param($stmt, "i", $delete_course_id);
        $delete_course_query_run = mysqli_stmt_execute($stmt);

        if ($delete_course_query_run) {
            $_SESSION['status'] = 'Course deleted successfully';
        } else {
            throw new Exception('Failed to delete course: ' . mysqli_error($connection));
        }
        header('location: /finalexamination/frontend/course.php');
    } catch (Exception $e) {
        $_SESSION['status'] = $e->getMessage();
        header('location: /finalexamination/frontend/course.php');
    }
}




