<?php
function confirmQuery($result)
{
    global $conn;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    return $result;
}
function insert_categories()
{
    global $conn;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty('cat_title')) {
            echo "This field is empty";
        } else {
            $query = "insert into categories(cat_title)";
            $query .= "value('{$cat_title}')";

            $create_category_query = mysqli_query($conn, $query);
            if (!$create_category_query) {
                die('query feild' . mysqli_error($conn));
            }
        }
    }
}

function findAllCategories()
{
    global $conn;
    $query = "SELECT * from categories";
    $select_sidebar_categories = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_sidebar_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'><i class='fa-solid fa-trash'></i></a> | <a href='categories.php?edit={$cat_id}'><i class='fa-solid fa-edit'></i></a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){
    global $conn;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE from categories WHERE cat_id = $the_cat_id";
        $deleted_query = mysqli_query($conn, $query);
        header("Location: categories.php");
     }
}

function deletePosts(){
    global $conn;
    if (isset($_GET['delete'])) {
        $the_post_id = $_GET['delete'];
        $query = "DELETE from posts WHERE post_id = $the_post_id";
        $deleted_query = mysqli_query($conn, $query);
        header("Location: posts.php");
     }
}