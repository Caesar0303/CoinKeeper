<?php 
 $_POST = json_decode(file_get_contents('php://input'), true);
 session_start();
 require_once "connect.php";
 
 if (isset($_SESSION['userid'])&&isset($_SESSION['account_id'])) {
    $account = mysqli_query($connect, "SELECT * FROM `accounts` WHERE user_id = {$_SESSION['userid']} AND id = {$_SESSION['account_id']}");
    $account = mysqli_fetch_all($account);
    
    $expenses = mysqli_query($connect, "SELECT * FROM expenses WHERE user_id = {$_SESSION['userid']} AND account_id = {$_SESSION['account_id']}");
    $expenses = mysqli_fetch_all($expenses);
 }
 
 if ($_POST['value'] > 0) {
     // Получаем выбранную категорию из таблицы categories
     $category_id = $_POST['selectID'];
     $user_id = $_SESSION['userid'];
     $category_query = mysqli_query($connect, "SELECT * FROM categories WHERE id = $category_id AND user_id = $user_id");
     $category = mysqli_fetch_assoc($category_query);
     
     var_dump($category);
     if ($_SESSION['balance'] < $_POST['value']) {
         $_SESSION['flag'] = true;
     } else {
         // Вычисляем новое значение для категории
         $new_total_expenses = $category['total_expenses'] + $_POST['value'];
 
         // Обновляем значение в таблице categories
         mysqli_query($connect, "UPDATE categories SET total_expenses = $new_total_expenses WHERE id = $category_id AND user_id = $user_id");
 
         // Получаем текущий баланс пользователя для выбранного счета
         $account_id = $_SESSION['account_id'];
         $account_balance_query = mysqli_query($connect, "SELECT `balance` FROM `accounts` WHERE `id` = $account_id AND `user_id` = $user_id");
         $account_balance = mysqli_fetch_assoc($account_balance_query)['balance'];
 
         // Вычисляем новый баланс счета после вычета суммы траты
         $new_account_balance = $account_balance - $_POST['value'];
 
         // Обновляем значение баланса в таблице accounts
         mysqli_query($connect, "UPDATE accounts SET balance = $new_account_balance WHERE id = $account_id AND user_id = $user_id");
 
         // Получаем выбранную трату из таблицы expenses
         $selected_expense_id = $_POST['selectID'];
         $selected_expense_query = mysqli_query($connect, "SELECT * FROM `expenses` WHERE `id` = $selected_expense_id AND user_id = $user_id AND account_id = $account_id");
         $selected_expense = mysqli_fetch_assoc($selected_expense_query);
 
         // Вычисляем новую сумму траты после добавления суммы в эту трату
         $new_expenses_for_type = $selected_expense['expenses_for_type'] + $_POST['value'];
 
         // Обновляем значение суммы траты в таблице expenses
         mysqli_query($connect, "UPDATE expenses SET expenses_for_type = $new_expenses_for_type WHERE id = $selected_expense_id AND user_id = $user_id AND account_id = $account_id");
     }

 }
var_dump($_POST['newBalance']);

if(isset($_POST['newBalance'])) {
    mysqli_query($connect, "UPDATE accounts SET balance = {$_POST['newBalance']} WHERE user_id = {$_SESSION['userid']} AND id = {$_SESSION['account_id']}");
}  

if (isset($_POST['newExpenses'])) {
    $user_id = $_SESSION['userid'];
    $account_id = $_SESSION['account_id'];

    $new_expense_description = $_POST['newExpenses'];
    mysqli_query($connect, "INSERT INTO categories (user_id, name) VALUES ($user_id, '{$_POST['newExpenses']}');");
}

if (isset($_GET['deleteId'])) {
    // Удаляем расход из таблицы expenses
    $id = $_GET['deleteId'];
    mysqli_query($connect, "DELETE FROM categories WHERE id = $id AND user_id = {$_SESSION['userid']} ");
}
    
//     // Обновляем id в таблице expenses
//     mysqli_query($connect, "SET @count = 0");
//     mysqli_query($connect, "UPDATE expenses SET id = @count:= @count + 1 WHERE user_id = {$_SESSION['userid']} AND account_id = {$_SESSION['account_id']}");
//     mysqli_query($connect, "ALTER TABLE expenses AUTO_INCREMENT = 1");
// }
header('Location: spend.php');
exit;
?>
