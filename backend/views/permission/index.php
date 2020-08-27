
<?php

use common\components\View;

/** @var $this View */
/** @var $admin string */
/** @var $currentRole */
/** @var $roleNames array */
/** @var $rolePermission array */
/** @var $cbList array */
/** @var $allList array */
/** @var $userNames array */
/** @var $userList array */


$this->title = 'Permission';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row settings" id="permission">
    <div class="col-sm-2" style="">
        <div class="col-md-12">
            <div class="list-group" style="margin-bottom: 15px;">
                <a class="list-group-item list-group-item-action" v-for="roleName in roleNames" :class="roleName===currentRole?'active':''" :href="'?r='+roleName">
                    {{roleName}}
                </a>
            </div>

            <!-- Add Role -->
            <div class="input-group mb-1">
                <input v-model="addRoleName" type="text" class="form-control" placeholder="Add Role" aria-label="Add Role">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2" @click="addRole()">
                        <span class="fa fa-plus"></span>
                    </button>
                </div>
            </div>
            <!-- Remove Role -->
            <div class="input-group mb-3">
                <input v-model="removeRoleName" type="text" class="form-control" placeholder="Remove Role" aria-label="Remove Role">
                <div class="input-group-append">
                    <button @click="removeRole()" class="btn btn-outline-primary" type="button" id="button-addon2">
                        <span class="fa fa-minus"></span>
                    </button>
                </div>
            </div>
            <div class="text-primary">
                warning: will remove all permissions which related.
            </div>
        </div>

        <div class="col-md-12 add-permission" style="margin-top: 70px">
            <!-- Add Permission -->
            <div class="text-success" style="width: 100%;">Add Permission</div>
            <div class="input-group mb-3">
                <input v-model="addPermissionName" type="text" class="form-control text-success">
                <div class="input-group-append">
                    <button @click="addPermission()" class="btn btn-outline-success" type="button">
                        <span class="fa fa-plus"></span>
                    </button>
                </div>
            </div>
            <!-- Remove Permission -->
            <div class="text-success" style="width: 100%;">Delete Permission</div>
            <div class="input-group mb-3">
                <input v-model="removePermissionName" type="text" class="form-control text-success">
                <div class="input-group-append">
                    <button @click="removePermission()" class="btn btn-outline-success" type="button">
                        <span class="fa fa-minus"></span>
                    </button>
                </div>
            </div>
        </div>

        <?php
            if (Yii::$app->user->identity->isAdmin()) {
                echo '<div class="col-md-12" style="margin-top: 10px;"><a class="btn btn-success btn-outline" href="/permission/log">Log</a></div>';
            }
        ?>
    </div>

    <div class="col-md-10 tab-content">
        <div class="col-md-12 checkbox checkbox-primary">
            <div class="col-md-12" style="top: 11px;">
                <!-- SL/CL Update Permission -->
                <span>
                    <button class="btn btn-outline-secondary btn-sm" @click="onGlobalSelectAll()">Select All</button>
                </span>
                <span>
                    <button class="btn btn-outline-secondary btn-sm" @click="onGlobalClearAll()">Clear All</button>
                </span>
                <span v-if="currentRole!==admin">
                    <a href="javascript:void(0);" class="btn btn-success btn-sm" @click="updatePermission()" :disabled="updateBtn">Update</a> <span class="text-success">{{updateMessage}}</span>
                </span>

                <!-- Add/Remove User Role -->
                <div class="input-group" style="float: right;width: 150px;top: -10px;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu">
                            <a v-for="(name, index) in userNames" class="dropdown-item" href="javascript:void(0);" @click="addUserToInput(name,index)">{{name}}</a>
                        </div>
                    </div>

                    <input type="text" class="form-control border border-warning" v-model="inputUserName">
                    <span class="input-group-btn" v-if="currentRole!==admin">
                        <button class="btn btn-outline-warning" type="button"><i class="fa fa-plus" id="addUserIcon" @click="addUser()"></i></button>
                    </span>
                </div>

                <div style="float: right;margin-right: 10px" id="userList">
                    <template v-for="userId in userList">
                        <span class="badge badge-warning" style="padding: 5px;">
                            <a class="text-white" style="cursor: text;font-size: larger">{{userNames[userId]}}
                                <i class="fa fa-times" style="cursor: pointer;" @click="removeUser(userId)" v-if="userId!=1"></i>
                            </a>
                        </span>
                    </template>
                </div>

            </div>
            <div class="col-md-12"><hr /></div>
        </div>

        <!-- Permission List -->
        <div v-for="(permission, role) in rolePermission" class="active tab-pane tet-style permission" :id="'tab-'+role">
            <div v-for="(items, group) in permission" class="col-md-5">
                <div class="text-muted">
                    <span class="permission-group">{{group}}</span>
                    <span class="text-primary sl-cl"><a href="javascript:void(0);" @click="onGroupSelectAll(group)">SL</a></span>
                    <span class="text-primary sl-cl"><a href="javascript:void(0);" @click="onGroupClearAll(group)">CL</a></span>
                </div>
                <div>
                    <div v-for="item in items" style="display: flex">
                        <div class="custom-control custom-switch">
                            <input :id="'cb-'+group+item['name']" :checked="item['isChecked']" :value="group+'/'+item['name']" v-model="cbList" type="checkbox" class="custom-control-input">
                            <label class="custom-control-label" :for="'cb-'+group+item['name']">{{item['name']}}</label>
                        </div>
                        <div v-if="item['isAbleLog']==='1'" :id="'able-log-'+group+item['name']" class="fa fa-bookmark text-success" @click="onAbleLog(group, item['name'])" style="cursor: pointer;margin: 5px 0 0 6px;"></div>
                        <div v-else :id="'able-log-'+group+item['name']" @click="onAbleLog(group, item['name'])" class="fa fa-bookmark-o" style="cursor: pointer;margin: 5px 0 0 6px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->render('_js', [
    'admin' => $admin,
    'rolePermission' => $rolePermission,
    'roleNames' => $roleNames,
    'currentRole' => $currentRole,
    'cbList' => $cbList,
    'allList' => $allList,
    'userNames' => $userNames,
    'userList' => $userList,
]); ?>
