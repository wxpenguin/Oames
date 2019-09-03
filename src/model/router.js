import Left from './../components/commonality/left'
import basicDictionaryManagement_new from './../components/customerManager/basicData/basicDictionaryManagement_new'
import basicDictionaryManagement from './../components/customerManager/basicData/basicDictionaryManagement'
import AM_PasswordMaintenance from './../components/customerManager/authorityManagement/AM_PasswordMaintenance'
import peopleManagement from './../components/customerManager/authorityManagement/peopleManagement'
import peopleManagement_post from './../components/customerManager/authorityManagement/peopleManagement_post'
import peopleManagement_section from './../components/customerManager/authorityManagement/peopleManagement_section'
import peopleManagement_add from './../components/customerManager/authorityManagement/peopleManagement_add'
import groupManagement from './../components/customerManager/authorityManagement/groupManagement'
import navigation from './../components/commonality/navigation'
import emailManagement from './../components/systemAdministrator/emailManagement/emailManagement'

//营销管理----销售机会管理
import salesLeads_management from './../components/systemAdministrator/salesManagement/salesLeads_management'
import salesLeads_newConstruction from './../components/systemAdministrator/salesManagement/salesLeads_newConstruction'
import salesLeads_editConstruction from '../components/systemAdministrator/salesManagement/salesLeads_editConstruction'
//营销管理----客户开发计划
import cd_plan from './../components/systemAdministrator/salesManagement/cd_plan'
import cdp_execute from './../components/systemAdministrator/salesManagement/cdp_execute'
import cdp_formulate from './../components/systemAdministrator/salesManagement/cdp_formulate'
//服务管理
import serviceInnovate from './../components/systemAdministrator/serviceManagement/serviceInnovate'
import serviceAllocation from './../components/systemAdministrator/serviceManagement/serviceAllocation'
import serviceAllocation_examine from './../components/systemAdministrator/serviceManagement/serviceAllocation_examine'
import serviceProcessing from './../components/systemAdministrator/serviceManagement/serviceProcessing'
import ServiceProcessing_goDispose from './../components/systemAdministrator/serviceManagement/serviceProcessing_goDispose'
import serviceFeedback from './../components/systemAdministrator/serviceManagement/serviceFeedback'
import serviceFeedback_coupleBack from './../components/systemAdministrator/serviceManagement/serviceFeedback_coupleBack'
import serviceArchive from './../components/systemAdministrator/serviceManagement/serviceArchive'
import serviceArchive_examine from './../components/systemAdministrator/serviceManagement/serviceArchive_examine'

import customerService_analyze from './../components/systemAdministrator/statisticalStatement/customerService_analyze'
import customerContributionAnalysis from './../components/systemAdministrator/statisticalStatement/customerContributionAnalysis'
import customerCompositionAnalysis from './../components/systemAdministrator/statisticalStatement/customerCompositionAnalysis'
import customerChurnAnalysis from './../components/systemAdministrator/statisticalStatement/customerChurnAnalysis'
//客户管理
import customerChurn_management from './../components/systemAdministrator/clientManagement/customerChurn_management'

let routes = [
    {
      path: "/",
      component: Left,
      exact:true
    },
    {
      path: "/basicDictionaryManagement",
      component: basicDictionaryManagement,
      exact:''
    },
    {
      path: "/basicDictionaryManagement_new",
      component: basicDictionaryManagement_new,
      exact:''
    },
    {
      path:'/AM_PasswordMaintenance',
      component:AM_PasswordMaintenance
    },
    {
      path:'/peopleManagement',
      component:peopleManagement
    },
    {
      path:'/peopleManagement_post',
      component:peopleManagement_post
    },
    {
      path:'/peopleManagement_section',
      component:peopleManagement_section
    },
    {
      path:'/peopleManagement_add',
      component:peopleManagement_add
    },
    {
      path:'/navigation',
      component:navigation
    },
    {
      path:'/groupManagement',
      component:groupManagement
    },
    {
      path:'/emailManagement',
      component:emailManagement
    },
   
    //营销管理--销售机会管理
    {
      path:'/salesLeads_management',
      component:salesLeads_management
    },
    {
      path:'/salesLeads_newConstruction',
      component:salesLeads_newConstruction
    },
    {
      path:'/salesLeads_editConstruction',
      component:salesLeads_editConstruction
    },
    //营销管理--客户开发机会
    {
      path:'/cd_plan',
      component:cd_plan
    },
    {
      path:'/cdp_execute',
      component:cdp_execute
    },
    {
      path:'/cdp_formulate',
      component:cdp_formulate
    },
    //服务管理
    {
      path:'/serviceInnovate',
      component:serviceInnovate
    },
    {
      path:'/serviceAllocation',
      component:serviceAllocation
    },
    {
      path:'/serviceAllocation_examine',
      component:serviceAllocation_examine
    },
    {
      path:'/serviceProcessing',
      component:serviceProcessing
    },
    {
      path:'/ServiceProcessing_goDispose',
      component:ServiceProcessing_goDispose
    },
    {
      path:'/serviceFeedback',
      component:serviceFeedback
    },
    {
      path:'/serviceFeedback_coupleBack',
      component:serviceFeedback_coupleBack
    },   
    {
      path:'/serviceArchive',
      component:serviceArchive
    }, 
    {
      path:'/serviceArchive_examine',
      component:serviceArchive_examine
    }, 
    
    
    {
      path:'/customerService_analyze',
      component:customerService_analyze
    },
    {
      path:'/customerContributionAnalysis',
      component:customerContributionAnalysis
    },
    {
      path:'/customerCompositionAnalysis',
      component:customerCompositionAnalysis
    },
    {
      path:'/customerChurnAnalysis',
      component:customerChurnAnalysis
    },
    //客户管理
    {
      path:'/customerChurn_management',
      component:customerChurn_management
    },
    
    
];

export default routes;
