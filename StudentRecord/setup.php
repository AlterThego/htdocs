<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "studentrecord");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


// USER
if (isset($_POST['save_user'])) {
    $user_name = mysqli_real_escape_string($connection, $_POST['signup-username']);
    $user_pass = mysqli_real_escape_string($connection, $_POST['signup-password']);
    $user_reenter = mysqli_real_escape_string($connection, $_POST['signup-reenter']);

    // Check if the password and reentered password match
    if ($user_pass != $user_reenter) {
        $_SESSION['status'] = 'Password and reentered password do not match';
        header('location: index.php');
        exit(); // Stop execution if passwords don't match
    }

    $insert_query = "INSERT INTO user (user_name, user_pass) 
                     VALUES ('$user_name', '$user_pass')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = 'User record added successfully';
        $_SESSION['user_id'] = mysqli_insert_id($connection); // Set the user_id in the session
        header('location: /StudentRecord/index.php');
    } else {
        $_SESSION['status'] = 'Failed to add user record: ' . mysqli_error($connection);
        header('location: /StudentRecord/index.php');
    }

} elseif (isset($_POST['login_user'])) {
    $login_user = mysqli_real_escape_string($connection, $_POST['login-username']);
    $login_pass = mysqli_real_escape_string($connection, $_POST['login-password']);

    // Example query (adjust according to your database schema)
    $login_query = "SELECT * FROM user WHERE user_name='$login_user' AND user_pass='$login_pass'";
    $login_query_run = mysqli_query($connection, $login_query);

    if ($login_query_run) {
        // Check if user credentials are valid
        if (mysqli_num_rows($login_query_run) > 0) {
            $user_data = mysqli_fetch_assoc($login_query_run);
            $_SESSION['status'] = 'Login successful';
            $_SESSION['user_id'] = $user_data['user_id']; // Set the user_id in the session
            header('location: /StudentRecord/Enrollment/index.php'); // Redirect to the dashboard page
        } else {
            $_SESSION['status'] = 'Invalid username or password';
            header('location: /StudentRecord/index.php'); // Redirect to the login page
        }
    } else {
        $_SESSION['status'] = 'Error during login: ' . mysqli_error($connection);
        header('location: /StudentRecord/index.php'); // Redirect to the login page
    }
}

// STUDENT
if (isset($_POST['save_student'])) {
    // Insert new student record
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
        header('location: /StudentRecord/Student/index.php');
    } else {
        $_SESSION['status'] = 'Failed to add student record: ' . mysqli_error($connection);
        header('location: /StudentRecord/Student/index.php');
    }
} elseif (isset($_POST['update_student'])) {
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
        header('location: /StudentRecord/Student/index.php');
    } else {
        $_SESSION['status'] = 'Failed to update student record: ' . mysqli_error($connection);
        header('location: /StudentRecord/Student/index.php');
    }
} elseif (isset($_GET['delete_student'])) {
    // Delete student record
    $delete_student_id = mysqli_real_escape_string($connection, $_GET['delete_student']);

    $delete_query = "DELETE FROM student WHERE StudentID='$delete_student_id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Student record deleted successfully';
        header('location: /StudentRecord/Student/index.php');
    } else {
        $_SESSION['status'] = 'Failed to delete student record: ' . mysqli_error($connection);
        header('location: /StudentRecord/Student/index.php');
    }
}

// INSTRUCTOR
if (isset($_POST['save_instructor'])) {
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
        header('location: /StudentRecord/Instructor/index.php');
    } else {
        $_SESSION['status'] = 'Failed to add instructor record: ' . mysqli_error($connection);
        header('location: /StudentRecord/Instructor/index.php');
    }
} elseif (isset($_POST['update_instructor'])) {
    $update_instructor_id = mysqli_real_escape_string($connection, $_POST['update_instructor_id']);
    $update_first_name = mysqli_real_escape_string($connection, $_POST['update_first_name']);
    $update_last_name = mysqli_real_escape_string($connection, $_POST['update_last_name']);
    $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($connection, $_POST['update_phone']);

    $update_query = "UPDATE instructor 
                     SET FirstName='$update_first_name', LastName='$update_last_name', Email='$update_email', Phone='$update_phone' 
                     WHERE InstructorID='$update_instructor_id'";
    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) {
        $_SESSION['status'] = 'Instructor record updated successfully';
        header('location: /StudentRecord/Instructor/index.php');
    } else {
        $_SESSION['status'] = 'Failed to update instructor record: ' . mysqli_error($connection);
        header('location: /StudentRecord/Instructor/index.php');
    }
} elseif (isset($_GET['delete_instructor'])) {
    $delete_instructor_id = mysqli_real_escape_string($connection, $_GET['delete_instructor']);

    $delete_query = "DELETE FROM instructor WHERE InstructorID='$delete_instructor_id'";
    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = 'Instructor record deleted successfully';
        header('location: /StudentRecord/Instructor/index.php');
    } else {
        $_SESSION['status'] = 'Failed to delete instructor record: ' . mysqli_error($connection);
        header('location: /StudentRecord/Instructor/index.php');
    }
}

// ENROLLMENT
if (isset($_POST['save_enrollment'])) {
    // Insert new enrollment record
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
    $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);

    // Check if the combination of student_id and course_id already exists
    $check_duplicate_query = "SELECT * FROM enrollment WHERE StudentID='$student_id' AND CourseID='$course_id'";
    $check_duplicate_result = mysqli_query($connection, $check_duplicate_query);

    if (mysqli_num_rows($check_duplicate_result) > 0) {
        $_SESSION['status'] = 'Enrollment record with the same Student ID and Course ID already exists.';
        header('location: /StudentRecord/Enrollment/index.php');
    } else {
        // If not, proceed with the insertion
        $enrollment_date = mysqli_real_escape_string($connection, $_POST['enrollment_date']);
        $grade = mysqli_real_escape_string($connection, $_POST['grade']);

        $insert_enrollment_query = "INSERT INTO enrollment(StudentID, CourseID, EnrollmentDate, Grade) 
                                    VALUES ('$student_id', '$course_id', '$enrollment_date', '$grade')";
        $insert_enrollment_query_run = mysqli_query($connection, $insert_enrollment_query);

        handleQueryResult($connection, $insert_enrollment_query_run, 'Enrollment record added successfully');
        header('location: /StudentRecord/Enrollment/index.php');
    }
} elseif (isset($_POST['update_enrollment'])) {
    // Update existing enrollment record
    $update_enrollment_id = mysqli_real_escape_string($connection, $_POST['update_enrollment_id']);
    $update_student_id = mysqli_real_escape_string($connection, $_POST['update_student_id']);
    $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);

    // Check if the updated combination of student_id and course_id already exists
    $check_duplicate_query = "SELECT * FROM enrollment WHERE StudentID='$update_student_id' AND CourseID='$update_course_id' AND EnrollmentID <> '$update_enrollment_id'";
    $check_duplicate_result = mysqli_query($connection, $check_duplicate_query);

    if (mysqli_num_rows($check_duplicate_result) > 0) {
        $_SESSION['status'] = 'Enrollment record with the same Student ID and Course ID already exists.';
        header('location: /StudentRecord/Enrollment/index.php');
    } else {
        // If not, proceed with the update
        $update_enrollment_date = mysqli_real_escape_string($connection, $_POST['update_enrollment_date']);
        $update_grade = mysqli_real_escape_string($connection, $_POST['update_grade']);

        $update_enrollment_query = "UPDATE enrollment 
                                    SET EnrollmentDate='$update_enrollment_date', Grade='$update_grade' 
                                    WHERE EnrollmentID='$update_enrollment_id'";
        $update_enrollment_query_run = mysqli_query($connection, $update_enrollment_query);

        handleQueryResult($connection, $update_enrollment_query_run, 'Enrollment record updated successfully');
        header('location: /StudentRecord/Enrollment/index.php');
    }
} elseif (isset($_GET['delete_enrollment'])) {
    // Delete enrollment record
    $delete_enrollment_id = mysqli_real_escape_string($connection, $_GET['delete_enrollment']);

    $delete_enrollment_query = "DELETE FROM enrollment WHERE EnrollmentID=?";
    $stmt = mysqli_prepare($connection, $delete_enrollment_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_enrollment_id);
    mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $stmt, 'Enrollment record deleted successfully');
}


// COURSE
if (isset($_POST['add_course'])) {
    // Add new course
    $course_id = mysqli_real_escape_string($connection, $_POST['course_id']);
    $course_name = mysqli_real_escape_string($connection, $_POST['course_name']);
    $instructor_id = mysqli_real_escape_string($connection, $_POST['instructor_id']);
    $credits = mysqli_real_escape_string($connection, $_POST['credits']);

    $insert_course_query = "INSERT INTO course(CourseID, CourseName, InstructorID, Credits) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $insert_course_query);
    mysqli_stmt_bind_param($stmt, "issi", $course_id, $course_name, $instructor_id, $credits);
    $insert_course_query_run = mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $insert_course_query_run, 'Course added successfully');

} elseif (isset($_POST['update_course'])) {
    // Update existing course
    $update_course_id = mysqli_real_escape_string($connection, $_POST['update_course_id']);
    $update_course_name = mysqli_real_escape_string($connection, $_POST['update_course_name']);
    $update_instructor_id = mysqli_real_escape_string($connection, $_POST['update_instructor_id']);
    $update_credits = mysqli_real_escape_string($connection, $_POST['update_credits']);

    $update_course_query = "UPDATE course SET CourseName=?, Credits=?, InstructorID=? WHERE CourseID=?";
    $stmt = mysqli_prepare($connection, $update_course_query);
    mysqli_stmt_bind_param($stmt, "ssii", $update_course_name, $update_credits, $update_instructor_id, $update_course_id);
    $update_course_query_run = mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $update_course_query_run, 'Course updated successfully');
    
} elseif (isset($_GET['delete_course'])) {
    // Delete course
    $delete_course_id = mysqli_real_escape_string($connection, $_GET['delete_course']);

    $delete_course_query = "DELETE FROM course WHERE CourseID=?";
    $stmt = mysqli_prepare($connection, $delete_course_query);
    mysqli_stmt_bind_param($stmt, "i", $delete_course_id);
    $delete_course_query_run = mysqli_stmt_execute($stmt);

    handleQueryResult($connection, $delete_course_query_run, 'Course deleted successfully');
}

mysqli_close($connection);

// Function to handle query result and redirect
function handleQueryResult($connection, $result, $successMessage)
{
    if ($result) {
        $_SESSION['status'] = $successMessage;
    } else {
        $_SESSION['status'] = 'Operation failed: ' . mysqli_error($connection);
    }
    header('location: index.php');
}
?>