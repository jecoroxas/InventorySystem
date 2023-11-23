<?php

require_once 'core.php';

if ($_POST) {
  $productId = $_POST['productId'];
  $categories = $_POST['categories'];

  $sql = "SELECT categories_id, quantity FROM product WHERE product_id = $productId  AND categories_id= $categories AND active = 1 AND status = 1";

  $result = $connect->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $response = array(
      'categories' => $row['categories'],
    //   'categoriesId' => $row['categories_id'], // Add categories_id to the response
      'quantity' => $row['quantity'],
    );

    echo json_encode($response);
  } else {
    $response = array(
      'categories' => '',
      'categoriesId' => '', // Add categories_id to the response
      'quantity' => '',
    );

    echo json_encode($response);
  }
}
?>
