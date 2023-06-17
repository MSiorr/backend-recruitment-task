// Add your custom scripts here

$(function () {
    $('.removeBtn').on("click", function () {
        let id = $(this).data('id');

        $.post('index.php', { event: 'remove', id: id }, (res) => {
            location.reload();
        })

    })

    $('#addForm').on("submit", function (e) {
        e.preventDefault();

        let data = $(this).serialize();
        data += "&event=add";

        $.post('index.php', data, (res) => {
            console.log(res);
            location.reload();
        })
    })
})

console.log('Good luck 👌');
