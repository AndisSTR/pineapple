<?php
    function filterDB($sql){
        $hostname ="localhost";
        $db = "pineapple";
        $username = "root";
        $password = "";

        $mysqli = new mysqli($hostname,$username,$password,$db);

        if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
        }
        $result = mysqli_query($mysqli, $sql);
        return $result;
    }

    $sql = 'SELECT * FROM user_emails';
    $result = filterDB($sql);


    if(isset($_POST['delete'])){
        $checkArr = $_POST['checkbox'];
        foreach($checkArr as $id){
           $sql = 'DELETE FROM user_emails WHERE id='.$id;
           $result = filterDB($sql);
        }
    }
    if(isset($_POST['search_btn'])){
        $search = $_POST['search'];
        $sql = 'SELECT * FROM user_emails WHERE email LIKE "%'.$search.'%"';
        $result = filterDB($sql);
    }

    if(isset($_POST['email_btn'])){
        $sql = 'SELECT * FROM user_emails ORDER BY email';
        $result = filterDB($sql);
    }

    if(isset($_POST['date_btn'])){
        $sql = 'SELECT * FROM user_emails  ORDER BY date_created';
        $result = filterDB($sql);
    }

    $sql_domain = 'SELECT DISTINCT substring_index(email,"@",-1) FROM user_emails GROUP BY substring_index(email,"@",-1)';
    $query = filterDB($sql_domain);

    while($row = mysqli_fetch_assoc($query)){
        $domain_value = $row['substring_index(email,"@",-1)'];
        $domain = $row['substring_index(email,"@",-1)'];
        $domain = str_replace('.', '_', $domain);
    }
    if(isset($_POST[$domain])){
        $sql = 'SELECT * FROM user_emails WHERE email LIKE "%'.$domain.'%"';
        $result = filterDB($sql);
    }
?>

<html>
    <head>
    </head>
    <body>

        <form action="table.php" method="post">

            <input type="text" name="search" placeholder="Search...">
            <input type="submit" name="search_btn" id="search_btn" value="search">
            <table>
                <tr>
                    <th>
                        <input type="submit" name="delete" id="delete" value="Delete">
                    </th>
                    <th>
                        <input type="submit" name="email_btn" id="email_btn" value="Email">
                    </th>
                    <th>
                        <input type="submit" name="date_btn" id="date_btn" value="Date">
                    </th>
                </tr>
                <?php while($row = mysqli_fetch_array($result)):?>

                        <tr>
                            <td>
                                <input type='checkbox' name='checkbox[]' value='<?php echo $row['id'] ?>'>
                            </td>
                            <td name='name[]'><?php echo $row['email'] ?></td>
                            <td><?php echo $row['date_created'] ?></td>
                        </tr>

                <?php endwhile ?>
            </table>

            <?php 

            $sql_domain = 'SELECT DISTINCT substring_index(email,"@",-1) FROM user_emails GROUP BY substring_index(email,"@",-1)';
            $query = filterDB($sql_domain);

            while($row = mysqli_fetch_assoc($query)){
                $domain_value = $row['substring_index(email,"@",-1)'];
                $domain = $row['substring_index(email,"@",-1)'];
                $domain = str_replace('.', '_', $domain);
                echo '<input type="submit" name="'.$domain.'" id="'.$domain.'" value="'.$domain_value.'">';
            }

           ?>
        </form>

    </body>
</html>