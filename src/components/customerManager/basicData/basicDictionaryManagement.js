//数据字典管理

import React from 'react';
import Left from './../../commonality/left';
import { Menu, Dropdown, Button,Breadcrumb,Select,Form,Input,Table, Divider} from 'antd';
import './../../../assets/css/pc/right.css';
import './../../../assets/css/pc/basicDictionaryManagement.css'
import axios from 'axios';

class basicDictionaryManagement extends React.Component{
    constructor(){
        super()
        this.state={
            list:[]
        };
    
    }
    
    componentWillMount() {
        var that=this;
        axios({
            method:'get',
            url:'api/index/index',
        })
        .then(function(response){
            var list1 = response.data.data;
            list1.forEach(element => {
                element.key=element.key
            });
            that.setState({
                list:list1
            })
            console.log(that.state.list)
        })
        .catch(function(err){
         console.log(err)
        })
    } 

    
    render(){
        //下来菜单
        const menu = (
            <Menu>
              <Menu.Item>
                <a target="_blank" rel="noopener noreferrer" href="http://www.alipay.com/">个人信息</a>
              </Menu.Item>
              <Menu.Item>
                <a target="_blank" rel="noopener noreferrer" href="http://www.taobao.com/">切换账号</a>
              </Menu.Item>
              <Menu.Item>
                <a target="_blank" rel="noopener noreferrer" href="http://www.tmall.com/">退出</a>
              </Menu.Item>
              
            </Menu>
          );
          const Option = Select.Option;

          function handleChange(value) {
            console.log(value); 
          }
          function handleChange1(value) {
            console.log(value);
          }
          
        //table

        const columns = [
            {
                title: '人员编号',
                dataIndex: 'id',
                key: 'id',
            }, 
            {
                title: '用户姓名',
                dataIndex: 'username',
                key: 'username',
            }, 
            {
                title: '所属部门',
                dataIndex: 'nickname',
                key: 'nickname',
            }, 
            {
                title: '岗位',
                dataIndex: 'level',
                key: 'level',
            }, 
            {
                title: '登录账号',
                dataIndex: 'email',
                key: 'email',
            },
            {
                title: '登录密码',
                dataIndex: 'password',
                key: 'password',
            },
            {
                title: '联系电话',
                dataIndex: 'mobile',
                key: 'mobile',
            },
            {
                title: '操作',
                key: 'action',
                render: (text, record) => (
                <span>
                    <a href="./">编辑</a>
                    <Divider type="vertical" />
                    <a href="./">删除</a>
                </span>
                ),
          }
        ];

        
        
        return(
            <div>
                <Left></Left>
                <div className="oa-common-right-box">
                    <div className="oa-cright-header">
                        <div>12313</div>
                        <Dropdown overlay={menu} placement="bottomCenter">
                            <Button>admin</Button>
                        </Dropdown>
                    </div>
                    <div className="oa-crumbs-box">
                        <Breadcrumb separator=">">
                            <Breadcrumb.Item href="">基础数据</Breadcrumb.Item>
                            <Breadcrumb.Item >数据字典</Breadcrumb.Item>
                        </Breadcrumb>
                    </div>
                    <Form>
                        <ul className="oa-bdm-queryFrom-box">
                            <li className="oa-bdm-select-layer1">
                                <span>类别:</span>
                                <Select labelInValue defaultValue={{ key: '1' }} style={{ width: 120 }} onChange={handleChange}>
                                    <Option value="1">普通客户</Option>
                                    <Option value="2">重点开发客户</Option>
                                    <Option value="3">大客户</Option>
                                    <Option value="4">合作伙伴</Option>
                                    <Option value="5">战略合作伙伴</Option>
                                    <Option value="6">投诉</Option>
                                    <Option value="7">咨询</Option>
                                    <Option value="8">建议</Option>
                                </Select>
                            </li>
                            <li className="oa-bdm-select-layer2">
                                <span>条目:</span>
                                <Select labelInValue defaultValue={{ key: '1' }} style={{ width: 120 }} onChange={handleChange1}>
                                    <Option value="1">普通客户</Option>
                                    <Option value="2">重点开发客户</Option>
                                    <Option value="3">大客户</Option>
                                    <Option value="4">合作伙伴</Option>
                                    <Option value="5">战略合作伙伴</Option>
                                    <Option value="6">投诉</Option>
                                    <Option value="7">咨询</Option>
                                    <Option value="8">建议</Option>
                                </Select>
                            </li>
                            <li className="oa-bdm-select-layer3">
                                <span>值:</span>
                                <Input placeholder="" />
                            </li>
                            <li className="oa-bdm-select-layer4">
                                <Button type="primary">查询</Button>
                            </li>
                            <li className="oa-bdm-select-layer4">
                                <Button type="primary" href="basicDictionaryManagement_new">新建</Button>
                            </li>
                        </ul>
                    </Form>
                    <div className="oa-bdm-table-box">
                         <Table columns={columns} dataSource={this.state.list} />
                    </div>
                </div>
            </div>
        )
    }
}

export default basicDictionaryManagement;