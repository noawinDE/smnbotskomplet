<?php
require '../vendor/autoload.php';
\smnbots\Auth::getInstance()->requireLogin();
$_LANG = \smnbots\translation::getPHP();
if (isset($_POST['method'])){
    switch ($_POST['method']){
        case "GET":
            $user = \smnbots\Auth::getInstance()->getCurrentUser();
            $qp = json_decode($user->private_streamurl,true);
            ?>
            <div class="modal-header">
                <h4 class="modal-title"><?= $_LANG['QP_CUSTOM'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="cqpform">
                <input type="hidden" name="method" value="SET">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                                <label><?= $_LANG['QP_NEW_NAME'] ?></label>
                                <input type="text" class="form-control" name="newname" >
                            </div>
                        </div>
                        <div class="col-md-6 pr-md-1">
                            <div class="form-group">
                                <label><?= $_LANG['QP_NEW_STREAM'] ?></label>
                                <input type="url" class="form-control" name="newstream">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-md-1">
                            <table class="table tablesorter" id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th><?= $_LANG['TABLE_NAME'] ?></th>
                                    <th><?= $_LANG['TABLE_URL'] ?></th>
                                    <th><?= $_LANG['TABLE_DELETE'] ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; foreach ($qp as $name => $url) { ?>
                                    <tr id="qp_h_i_<?=$i?>">
                                        <input type="hidden" name="<?= $name ?>" value="<?= $url ?>">
                                        <td><?= $name ?></td>
                                        <td><?= $url ?></td>
                                        <td><a class="btn btn-danger do-removeqp" data-id="<?= $i ?>"><i class="fas fa-times"></i></a></td>
                                    </tr>
                                <?php $i++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?= $_LANG['FORM_BUTTON_CLOSE'] ?></button>
                    <button type="submit" class="btn btn-info"><?= $_LANG['FORM_BUTTON_SAVE'] ?></button>
                </div>
            </form>
            <?php
            break;
        case "SET":
            $stations = $_POST;
            if ($_POST['newname'] !== "" && $_POST['newstream'] !== ""){
                $stations[$_POST['newname']] = $_POST['newstream'];
            }
            unset($stations['method']);
            unset($stations['newname']);
            unset($stations['newstream']);
            if (\smnbots\User::saveUserQP($stations)){
                echo "success";
            } else {
                echo "error";
            }
            break;
        default:
            echo "error";
            break;

    }
}

?>