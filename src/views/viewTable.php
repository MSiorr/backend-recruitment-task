<?php
function displayIndex($users)
{
    ob_start();

?>
    <table>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Company</th>
            <th></th>
        </tr>
        <?php
        foreach ($users as $user) {

            echo "
            <tr>
                <td>{$user["name"]}</td>
                <td>{$user["username"]}</td>
                <td>{$user["email"]}</td>
                <td>
                    {$user["address"]["street"]},<br>
                    {$user["address"]["zipcode"]}<br>
                    {$user["address"]["city"]}
                </td>
                <td>{$user["phone"]}</td>
                <td>{$user["company"]["name"]}</td>
                <td>
                    <button class='removeBtn' data-id='
                        {$user['id']}'
                    >REMOVE</button>
                </td>
            </tr>
        ";
        }
        ?>
    </table>

    <div class="addUserDiv">
        <form id="addForm" method="POST">
            <input type="text" name="name" id="iName" placeholder="Name" required>
            <input type="text" name="username" id="iUsername" placeholder="Username" required>
            <input type="email" name="email" id="iEmail" placeholder="Email" required>
            <input type="text" name="address" id="iAddress" placeholder="Address" required>
            <input type="text" name="phone" id="iPhone" placeholder="Phone" required>
            <input type="text" name="company" id="iCompany" placeholder="Company" required>
            <input type="submit" value="SUBMIT">
        </form>
    </div>

<?php

    return ob_get_clean();
}
