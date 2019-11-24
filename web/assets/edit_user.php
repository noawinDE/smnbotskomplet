<?php
if(isset($_POST['id'])){
    require '../vendor/autoload.php';
    \smnbots\Auth::getInstance()->requireAdmin();
    $user = \smnbots\User::findByID($_POST['id']);
    if ($user !== null){ ?>
        <div class="modal-header">
            <h4 class="modal-title">Nutzer Bearbeiten</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="userinfoform">
            <input type="hidden" name="uid" value="<?= $user->id ?>">
            <input type="hidden" name="method" value="update">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 pr-md-1">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required="required" placeholder="<?= $user->name ?>" value="<?= $user->name ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pr-md-1">
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="text" class="form-control" name="email" placeholder="<?= $user->email ?>" value="<?= $user->email ?>">
                        </div>
                    </div>
                    <div class="col-md-6 pr-md-1">
                        <div class="form-group">
                            <label>Maximale Bots</label>
                            <input type="number" class="form-control" name="maxbots" required="required" min="-1" max="200" placeholder="<?= $user->max_bots ?>" value="<?= $user->max_bots ?>">
                        </div>
                    </div>
					
                </div>
				
                <div class="row">
                    <div class="col-md-12 pr-md-1">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Server</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ((new smnbots\Bot)->userbotlist($user->id) as $bot){?>
                                <tr>
                                    <td>ID-<?= $bot['id'] ?></td>
                                    <td><?= $bot['name'] ?></td>
                                    <td><?= $bot['server'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger do-deleteuser" data-user-id="<?= $user->id ?>">Löschen</button>
                <button type="button" class="btn btn-danger do-resetuserpw" data-user-id="<?= $user->id ?>">Passwort zurücksetzen</button>
                <button type="submit" class="btn btn-success">Aktualisieren</button>
            </div>
        </form>
    <?php } else {
        echo "error";
    }
}
?>