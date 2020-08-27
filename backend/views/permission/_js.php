<?php
use common\components\View;
use common\assets\VueAsset;

/* @var $this View */
/** @var $admin string */
/** @var $currentRole string */
/** @var $roleNames array */
/** @var $rolePermission array */
/** @var $cbList array */
/** @var $allList array */
/** @var $userNames array */
/** @var $userList array */

?>
<?php VueAsset::register($this); ?>
<script>
    new Vue({
        el: '#permission',
        data: {
            admin: '<?= $admin ?>',
            rolePermission: <?= json_encode($rolePermission) ?>,
            currentRole: '<?= $currentRole ?>',
            roleNames: <?= json_encode($roleNames) ?>,
            cbList: <?= json_encode($cbList) ?>,
            allList: <?= json_encode($allList) ?>,
            updateBtn: false,
            updateMessage: '',
            userNames: <?= json_encode($userNames) ?>,
            inputUserName: '',
            inputUserIndex: '',
            userList: <?= json_encode($userList) ?>,
            addPermissionName: '',
            removePermissionName: '',
            addRoleName: '',
            removeRoleName: ''
        },
        mounted: function () {
        },
        methods: {
            onGlobalSelectAll: function () {
                this.cbList = this.allList;
            },
            onGlobalClearAll: function () {
                this.cbList = [];
            },
            onGroupSelectAll: function (group) {
                let permissions = this.rolePermission[this.currentRole][group];
                permissions.forEach(item => {
                    let permission = group + '/' + item['name'];
                    if (typeof (this.cbList[permission]) === 'undefined') {
                        this.cbList.push(permission);
                    }
                });
            },
            onGroupClearAll: function (group) {
                this.cbList = this.cbList.filter(item => {
                    return item.split('/')[0] !== group;
                });
            },
            onAbleLog: function (group, name) {
                let dom = $('#able-log-' + group + name);
                dom.removeClass().addClass('fa fa-spinner');
                $.post('/permission/able-log', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    name: group + '/' + name
                }).done(function (res) {
                    dom.html('');
                    if (res.status === 'success') {
                        dom.removeClass();
                        if (res.isAbleLog === 1) {
                            dom.addClass('fa fa-bookmark text-success');
                        } else {
                            dom.addClass('fa fa-bookmark-o');
                        }
                    }
                });
            },
            updatePermission: function () {
                this.updateBtn = true;
                this.updateMessage = 'updating...';
                let that = this;
                $.post('/permission/update-permission', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    role: this.currentRole,
                    permission: this.cbList
                }).done(function (res) {
                    that.updateBtn = false;
                    that.updateMessage = 'done!'
                });
            },
            addUserToInput: function (name, index) {
                this.inputUserName = name;
                this.inputUserIndex = index;
            },
            addUser: function () {
                $('#addUserIcon').removeClass();
                $('#addUserIcon').attr('class', 'fa fa-user');
                let that = this;
                $.post('/permission/add-user', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    adminId: that.inputUserIndex,
                    role: that.currentRole
                }).done(function (res) {
                    if (res.status === 'success') {
                        that.userList.push(that.inputUserIndex);
                    } else {
                        alert('user name exist or wrong.');
                    }
                    $('#addUserIcon').removeClass();
                    $('#addUserIcon').attr('class', 'fa fa-plus');
                });

            },
            removeUser: function (adminId) {
                let that = this;
                $.post('/permission/remove-user', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    adminId: adminId,
                    role: that.currentRole
                }).done(function (res) {
                    if (res.status === 'success') {
                        for(let i = 0; i < that.userList.length; i++){
                            if (that.userList[i] === adminId) {
                                that.userList.splice(i, 1);
                                i--;
                            }
                        }
                    }
                });
            },
            addPermission: function () {
                let that = this;
                if (that.addPermissionName === '') {
                    alert('please enter a permission name');
                    return false;
                }
                $.post('/permission/add-permission', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    permissionName: that.addPermissionName
                }).done(function (res) {
                    if (res.status === 'success') {
                        alert('success');
                        location.reload();
                    } else {
                        alert('failed. check the format.')
                    }
                });
            },
            removePermission: function () {
                let that = this;
                if (that.removePermissionName === '') {
                    alert('please enter a permission name');
                    return false;
                }
                $.post('/permission/remove-permission', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    permissionName: that.removePermissionName
                }).done(function (res) {
                    if (res.status === 'success') {
                        alert('success');
                        location.reload();
                    } else {
                        alert('failed. check the format.')
                    }
                });
            },
            addRole: function () {
                let that = this;
                if (that.addRoleName.trim() === '') {
                    alert('please enter a role name');
                    return false;
                }
                $.post('/permission/add-role', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    roleName: that.addRoleName
                }).done(function (res) {
                    if (res.status === 'success') {
                        alert('success');
                        location.reload();
                    } else {
                        alert('failed.')
                    }
                });
            },
            removeRole: function () {
                let that = this;
                if (that.removeRoleName.trim() === '') {
                    alert('please enter a role name');
                    return false;
                }
                $.post('/permission/remove-role', {
                    '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>',
                    roleName: that.removeRoleName
                }).done(function (res) {
                    if (res.status === 'success') {
                        alert('success');
                        location.reload();
                    } else {
                        alert('failed.')
                    }
                });
            }
        }
    });
</script>