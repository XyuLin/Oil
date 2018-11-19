define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'apply/record/index',
                    add_url: 'apply/record/add',
                    edit_url: 'apply/record/edit',
                    del_url: 'apply/record/del',
                    multi_url: 'apply/record/multi',
                    table: 'apply_record',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'user_id', title: __('User_id'),visible:false},
                        {field: 'user_text', title: __('User_id'),operate:false},
                        {field: 'user_phone_text', title: __('手机号'),operate:false},
                        {field: 'agent_id', title: __('Agent_id'),visible:false},
                        {field: 'agent_name', title: __('Agent_name')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
                        {field: 'type', title: __('Type'), searchList: {"1":__('Type 1'),"2":__('Type 2'),"3":__('Type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'voucher', title: __('Voucher')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'),buttons: [
                                {name: 'detail', text: '通过', title: '通过',hidden:function(row, value, index){
                                    console.log(row);
                                        return row.status == 0 ? false : true;
                                    } ,icon: 'fa fa-check', classname: 'btn btn-xs btn-success btn-ajax', url: 'apply/record/operation?type=1',success:function(){ $(".btn-refresh").trigger("click");}},
                                {name: 'detail', text: '否决', title: '否决',hidden:function(row, value, index){
                                        return row.status == 0 ? false : true;
                                    } ,icon: 'fa fa-close', classname: 'btn btn-xs btn-warning btn-ajax', url: 'apply/record/operation?type=2',success:function(){ $(".btn-refresh").trigger("click");}},
                            ], table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});