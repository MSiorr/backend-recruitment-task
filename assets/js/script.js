// Add your custom scripts here

$(function () {
    $('.removeBtn').on("click", function () {
        let id = $(this).data('id');

        $.post('src/events/removeUser.php', { event: 'remove', id: id }, (res) => {
            location.reload();
        })

    })

    $('#addForm').on("submit", function (e) {
        e.preventDefault();

        let data = $(this).serialize();
        data += "&event=add";

        $.post('src/events/addUser.php', data, (res) => {
            console.log("HELLO");
            console.log(res);
        })
    })
})

console.log('Good luck 👌');
