//客户流失管理
import React from 'react'
import Left  from './../../commonality/left'
import Navigation from './../../commonality/navigation'
import {Link} from 'react-router-dom'
import {Button,Breadcrumb,Select,Table,Tag} from 'antd';
class customerChurn_management extends React.Component{
    constructor(){
        super()
        this.state={

        }
    }
    render(){
         // selcet
         const Option = Select.Option;

         function handleChange(value) {
             console.log(`selected ${value}`);
         }
         //table
        const dataSource = [
            {
                key: '1',
                number: '1',
                clientName: '北京铭科科技有限公司',
                lastOrderTime: '2017-11-12',
                clientManager:'张震',
                confirmLoss:'2018-10-1',
                tags: ['暂缓流失', '确定流失'],
                status:'确认流失'
            },
            {
                key: '2',
                number: '2',
                clientName: '北京铭科科技有限公司',
                lastOrderTime: '2017-11-12',
                clientManager:'张震',
                confirmLoss:'2018-10-1',
                tags: ['暂缓流失', '确定流失'],
                status:'确认流失'
            },
            {
                key: '3',
                number: '3',
                clientName: '北京铭科科技有限公司',
                lastOrderTime: '2017-11-12',
                clientManager:'张震',
                confirmLoss:'2018-10-1',
                tags: ['暂缓流失', '确定流失'],
                status:'预警流失'
            },
        ];
          
        const columns = [
            {
                title: '编号',
                dataIndex: 'number',
                key: 'number',
            },  
            {
                title: '客户名称',
                dataIndex: 'clientName',
                key: 'clientName',
            },
            {
                title: '客户经理',
                dataIndex: 'clientManager',
                key: 'clientManager',
            },
            {
                title:'上次下单时间',
                dataIndex:'lastOrderTime',
                key:'lastOrderTime'
            },
            {
                title:'确认流失时间',
                dataIndex:'confirmLoss',
                key:'confirmLoss'
            },
            { 
                title:'状态',
                dataIndex:'status',
                key:'status'
            },
            {
                title: '操作',
                key: 'tags',
                dataIndex: 'tags',
                render: tags => (
                  <Link to=''>
                    {tags.map(tag => {
                      let color = tag.length > 5 ? 'geekblue' : 'green';
                      if (tag === 'loser') {
                        color = 'volcano';
                      }
                      return <Tag color={color} key={tag}>{tag.toUpperCase()}</Tag>;
                    })}
                  </Link>
                ),
            }
        ];
        return(
            <div>
                <Left></Left>
                <div className="oa-common-right-box">
                    <Navigation></Navigation>
                    <div className="oa-crumbs-box">
                        <Breadcrumb separator=">">
                            <Breadcrumb.Item href="">统计报表</Breadcrumb.Item>
                            <Breadcrumb.Item >客户贡献分析</Breadcrumb.Item>
                        </Breadcrumb>
                    </div>
                    <div className='oa-cca-top-layer'>
                        <div className="oa-cca-top-layer-left">
                            <span>客户名称</span>
                            <input></input>
                        </div>
                        <div className="oa-cca-top-layer-left">
                            <span>客户经理</span>
                            <input></input>
                        </div>
                        <Select defaultValue="lucy" style={{ width: 120 }} onChange={handleChange}>
                            <Option value="jack">Jack</Option>
                            <Option value="lucy">Lucy</Option>
                            <Option value="disabled">Disabled</Option>
                            <Option value="Yiminghe">yiminghe</Option>
                        </Select>
                        <Button style={{marginLeft:'50px',backgroundColor:'#1798DC',color:'#fff'}}>查询</Button>
                    </div>
                    <div className="oa-cca-bodybox">
                        <Table dataSource={dataSource} columns={columns} />
                    </div>
                </div>
            </div>
        )
    }
}
export default customerChurn_management