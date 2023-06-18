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
                    <button class='btn removeBtn' data-id='
                        {$user['id']}'
                    >REMOVE</button>
                </td>
            </tr>
        ";
        }
        ?>
    </table>

    <div class="addUserDiv">

        <h2 class='starting-title'>Add user</h2>

        <form id="addForm" method="POST">
            <input type="text" name="name" id="iName" placeholder="Name" required autocomplete="off">
            <input type="text" name="username" id="iUsername" placeholder="Username" required autocomplete="off">
            <input type="email" name="email" id="iEmail" placeholder="Email" required autocomplete="off">
            <input type="text" name="address" id="iAddress" placeholder="Address" required autocomplete="off">
            <input type="text" name="phone" id="iPhone" placeholder="Phone" required autocomplete="off">
            <input type="text" name="company" id="iCompany" placeholder="Company" required autocomplete="off">

            <!-- <label for="iName">Name: <input type="text" name="name" id="iName" placeholder="Name" required></label>
            <label for="iName">Username: <input type="text" name="username" id="iUsername" placeholder="Username" required></label>
            <label for="iName">Email: <input type="email" name="email" id="iEmail" placeholder="Email" required></label>
            <label for="iName">Address: <input type="text" name="address" id="iAddress" placeholder="Address" required></label>
            <label for="iName">Phone: <input type="text" name="phone" id="iPhone" placeholder="Phone" required></label>
            <label for="iName">Company: <input type="text" name="company" id="iCompany" placeholder="Company" required></label> -->

            <input class='btn submitBtn' type="submit" value="SUBMIT">
        </form>
    </div>

<?php

    return ob_get_clean();
}
