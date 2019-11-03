<?php

    require_once('Models/Todo.php');

    require_once('function.php');

    // Todoクラスのインスタンス化
    $todo = new Todo();

    // DBからデータを全件取得
    $tasks = $todo->all();

    // echo '<pre>';
    // var_dump($tasks);
    // exit();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

</head>
<body>
    <header class="px-5 bg-primary">
        <nav class="navbar navbar-dark">
            <a href="index.php" class="navbar-brand">TODO APP</a>
            <div class="justify-content-end">
                <span class="text-light">
                    Taka
                </span>
            </div>
        </nav>
    </header>

<main class="container py-5">
    <section>
        <form class="form-row justify-content-center" action="create.php" method="POST">

        <!-- todoの作成 -->
        <div class="col-10 col-md-6 py-2">
            <input type="text" class="form-control" placeholder="ADD TODO" name="task">
        </div>

        <!-- due dateの作成 -->
        <div class="col-5 col-md-4 py-2">
            <input type="date" class="form-control"  name="due_date">
        </div>

        <!-- 優先順位の設定 -->
        <form type="get" action="#">
            <div class="priority">
                <input id="star1" type="radio" name="star" value="5" />
                <label for="star1"><span class="text">最重要</span>★</label>
                <input id="star2" type="radio" name="star" value="4" />
                <label for="star2"><span class="text">かなり重要</span>★</label>
                <input id="star3" type="radio" name="star" value="3" />
                <label for="star3"><span class="text">まぁまぁ重要</span>★</label>
                <input id="star4" type="radio" name="star" value="2" />
                <label for="star4"><span class="text">あまり重要ではない</span>★</label>
                <input id="star5" type="radio" name="star" value="1" />
                <label for="star5"><span class="text">重要ではない</span>★</label>
            </div>
        </form>　       　



                <div class="py-2 col-md-3 col-10">
                    <button type="submit" class="col-12 btn btn-primary">ADD</button>
                </div>
            </form>
        </section>
        <section class="mt-5">
          <table class="table table-hover">
              <thead>
                <tr class="bg-primary text-light">
                    <th class=>TODO</th>
                    <th>CREATED DATE</th>
                    <th>STATUS</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task): ?>
            <tr>
            <td><?php echo h($task['name']); ?></td>
            <td><?php echo date("Y/m/d" , strtotime($task['created_date'])); ?></td>
            <td>NOT YET</td>
            <td>
            <a class="text-success" href="edit.php?id=<?php echo h($task['id']);?>"><i class="material-icons">edit</i></a>
            </td>
            <td>
            <a class="text-danger" href="delete.php?id=<?php echo h($task['id']);?>"><i class="fas fa-trash-alt"></i></a>
            </td>

            </tr>
            <?php endforeach; ?>
              </tbody>
          </table>
        </section>
    </main>

</body>
</html>