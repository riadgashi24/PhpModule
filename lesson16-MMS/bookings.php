<?php
session_start();

include_once('config.php');

$user_id = $_SESSION["id"];

if(isset('is_admin') == 'true'){
    $sql = " SELECT movies.movie_name, users.email, bookings,id, bookings.nr_tickets, bookings.date, bookings.time FROM movies 
    INNER JOIN bookings ON movies.id = bookings.movie_id
    INNER JOIN users ON users.id = bookings.user_id";

    $selectBookings = $conn -> prepare($sql);
    $selectBookings -> execute();

    $bookings_data = $selectBookings -> fetchAll();
}

else {
    $sql = "SELECT movies.movie_name, users.email, bookings.nr_tickets, bookings.date, bookings.is_approved, bookings.time FROM movies
    INNER JOIN users ON users.id = bookings.user_id
    WHERE bookings.users_id = :user_id";
    

    $selectBookings = $conn -> prepare($sql);
    $selectBookings -> bindParam(':user_id', $user_id);
    $selectBookings -> execute();

    $bookings_data = $selectBookings -> fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Bookings</h2>
    <table>
        <tr>
            <th>Movie Name</th>
            <th>Users Email</th>
            <th>Number of Tickets</th>
            <th>Date</th>
            <th>Time</th>
            <th>Approved</th>
        </tr>
        <tbody>
        <?php if($_SESSION['is_admin'] == 'true'){
            foreach($bookings_data as $booking){ ?>
                <tr>
                    <td><?php echo $booking['movie_name']; ?></td>
                    <td><?php echo $booking['email']; ?></td>
                    <td><?php echo $booking['nr_tickets']; ?></td>
                    <td><?php echo $booking['date']; ?></td>
                    <td><?php echo $booking['time']; ?></td>
                    <td><?php echo $booking['is_approved'] ?></td>

                    <td><a href="approve.php?id=<?php echo $booking['id'] ?>">Approve</a></td>
                    <td><a href="decline.php?id=<?php echo $booking['id'] ?>">Decline</a></td>
                </tr>
                <?php }} else {
            foreach($bookings_data as $booking){ ?>
                <tr>
                    <td><?php echo $booking['movie_name']; ?></td>
                    <td><?php echo $booking['email']; ?></td>
                    <td><?php echo $booking['nr_tickets']; ?></td>
                    <td><?php echo $booking['date']; ?></td>
                    <td><?php echo $booking['time']; ?></td>
                    <td><?php echo $booking['is_approved'] ?></td>
                </tr>
            <?php }} ?>
        </tbody>

    </table>
</body>
</html>