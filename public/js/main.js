
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$(document).ready(function() {
    function loadSort() {
        $('#productsTable').tablesorter({
            headers: {
                0: { sorter: false },
                2: { sorter: false },
                6: { sorter: false },
                7: { sorter: false }
            }
        });
    } 
    loadSort();

    // 検索機能の非同期処理
    $(function() {
        $('#search-btn').on('click', function(event) {
            event.preventDefault();

            let serialize = $('form').serialize();
            console.log(serialize);

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'GET',
                url: 'products',
                dataType: 'html',
                data: serialize
            })
        
            .done(function(response) {
                console.log('成功');
                let table = $(response).find('#productTable');

                $('#productsTable').replaceWith(table);
                loadSort();
            })

            .fail(function() {
            // .fail(function(xhr, status, error) {
                console.log("エラー");
            })
        })
    })

    // 削除機能の非同期処理
    $(function() {
        $('.delete-btn').on('click', function(event) {
            // HTMLでの送信をキャンセル
            event.preventDefault();
            const deleteConfirm = confirm('削除してよろしいでしょうか？');
            if(deleteConfirm) {
                const productID = $(this).data('product_id');
        // console.log(productID);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    // const productID = $(this).data('product_id');
                    type: 'POST',
                    url: 'products/' + productID,
                    // dataType: 'json',
                    dataType: 'html',
                    data: {'product_id': productID, '_method': 'DELETE'} // DELETE リクエストだよ！と教えてあげる。
                })

                .done(function() {
                    location.reload();
                    // console.log("成功");
                })

                .fail(function() {
                    // event.preventDefault();
                    alert("削除できませんでした");
                })
            };
        });
    });
});
