# Faculty-Schedule-Management-System
The Faculty Schedule Management System simplifies teacher schedule management for educational institutions. It provides personalized timetables, activity logs, and filters for teachers while offering admins tools to manage timetables and find free periods efficiently.
## Features

- **Admin Panel**: Manage teacher schedules, view timetables, and identify free periods.
- **Teacher Dashboard**: Log daily activities, update schedules, and filter logs by date.
- **Timetable Management**: Unique timetables for each teacher with seven periods daily from Monday to Saturday.
- **Attendance Tracking**: Maintain and access attendance logs for each teacher.
- **User Authentication**: Secure login for both teachers and admins.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL

## Table Structure

### `log`
- `log_id` (Primary Key, auto-increment)
- `user_id` (Session variable, unique to each user)
- `Name`
- `date`
- `p1` to `p7` (Daily period logs)

### `attendance`
- Similar structure to the `log` table for attendance tracking.

### `teachers_list`
- `names`
- `user_id`

### `admin`
- `user_id` (Primary Key, auto-increment)
- `Name`
- `Email`
- `password`

## How to Run the Project

1. Clone this repository:
   ```bash
   git clone <repository-url>
   ```
2. Set up a local web server (e.g., XAMPP, WAMP, MAMP).
3. Import the database:
   - Locate the `database.sql` file in the project directory.
   - Import it into MySQL using phpMyAdmin or a similar tool.
4. Update the database connection details in `config.php`.
5. Start the server and access the application in your browser at `http://localhost/faculty-schedule-management`.

## Screenshots

![Admin Dashboard](screenshots/admin-dashboard.png)
_Admin panel view with timetable management and teacher logs._

![Teacher Dashboard](screenshots/teacher-dashboard.png)
_Teacher dashboard showing daily activity logs._

## License

This project is licensed under the [MIT License](LICENSE).

## Contributing

Contributions are welcome! Feel free to submit a pull request or open an issue for discussion.

## Contact

For any queries or support, please contact:
- Email: vishwanathtuduru@gmail.com
