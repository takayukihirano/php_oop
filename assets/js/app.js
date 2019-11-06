$(function(){
    $('#add-button').on('click', function(e){
        // alert('addがクリックされたよ');

        // formタグの送信を無効化する(二重投稿を防ぐため)
        e.preventDefault();

        // 入力されたタスク名を取得
        let taskName = $('#input-task').val();

        // ajax開始
        $.ajax({
            // キー（決まった文言） : 値
            url: 'create.php',
            type: 'POST',
            dataType:'json',
            data: {
                // 送信する値を書くブロック
                task: taskName
            }

        }).done( (data) => {
            console.log(data);

            $('tbody').prepend(
            `<tr id="task-${data['id']}">` +
                `<td>${data['name']}</td>` +
                `<td>${data['created_date']}</td>` +
                `<td>NOT YET</td>` +
                `<td>
                <a class="text-success" href="edit.php?id=${data['id']}">EDIT</a>
                </td>` +
                `<td>
                <a data-id="${data['id']}" class="text-danger delete-button" href="delete.php?id=${data['id']}">DELETE</a>
                </td>` +
            `</tr>`);

        }).fail( (error) => {
            console.log(error);
        })
    });

    // 削除のボタンがクリックされた時の処理
    // $('.delete-button').on('click',function(e){
    $(document).on('click','.delete-button',function(e){

        // alert('deleteがクリックされたよ');

        // formタグの送信を無効化する(二重投稿を防ぐため)
        e.preventDefault();

        // 削除対象のIDを取得
        // $(this)今イベントが実行されている本体
        // 今回の場合は、クリックされたaタグ本体
        let selectedID = $(this).data('id');
        // alert(selectedID);

        // ajax開始
        $.ajax({
            url: 'delete.php',
            type: 'GET',
            dataType: 'json',
            data:{
                id: selectedID
            }

        }).done( (data) => {
            console.log(data);

            $("#task-" + data).fadeOut();

            // $('#task-${data}').fadeOut();


        }).fail( (error) => {
            console.log(error);
        })

     });
});