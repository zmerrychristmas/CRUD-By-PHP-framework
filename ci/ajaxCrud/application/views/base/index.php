<div class="col-md-9">
    <h3>List Users</h3>
<?php
    if (isset($users) || !empty($users)) {
        $stt = isset($stt) ? ($stt+1) : 1;
?>
    <table class="table">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Name</th>
                <th>Email</th>
                <th>Create date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="users-tbody">
            <?php foreach($users as $key => $value) {
                ?>
                <tr id="user_<?php echo $value->user_id?>">
                    <td><?php echo $stt ++; ?></td>
                    <td><?php echo $value->user_name; ?></td>
                    <td><?php echo $value->user_email; ?></td>
                    <td><?php echo $value->created_at; ?></td>
                    <td><a href="/index.php/base/user/edit/<?php echo $value->user_id; ?>">Edit</a> /
                    <button data-url="/index.php/base/user/del" class="delUsers-btn" id="del-<?php echo $value->user_id; ?>" data-user-id="<?php echo $value->user_id; ?>" >Delete</button></td>
                </tr>
                <?php
            }?>
        </tbody>
    </table>
    <?php if (isset($pagination)) echo $pagination; ?>
<?php } ?>
</div>
<script>

</script>