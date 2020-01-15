import Vue from 'vue';
import VueRouter from 'vue-router';

import BrandList from './components/Brand/List.vue';
import BrandCreate from './components/Brand/Create.vue';
import BrandUpdate from './components/Brand/Update.vue';

import TypeList from './components/Type/List.vue';
import TypeCreate from './components/Type/Create.vue';
import TypeUpdate from './components/Type/Update.vue';

import TypePurchaseConfigList from './components/TypePurchaseConfig/List.vue';
import TypePurchaseConfigUpdate from './components/TypePurchaseConfig/Update.vue';

import ModelList from './components/Model/List.vue';

import NewModelList from './components/NewModel/List.vue';
import NewModelCreate from './components/NewModel/Create.vue';
import ModelMarketerUpdate from './components/NewModel/MarketerUpdate.vue';

import Dashboard from './components/Dashboard.vue';

import Login from './components/Auth/Login.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        { path: '/', name: 'dashboard', component: Dashboard},

        { path: '/type', name: 'types_list', component: TypeList },
        { path: '/type/create', name: 'type_create', component: TypeCreate },
        { path: '/type/update/:id', name: 'type_update', component: TypeUpdate },

        { path: '/type-purchase-config', name: 'typesPurchaseConfig_list', component: TypePurchaseConfigList },
        { path: '/type-purchase-config/update/:id', name: 'typePurchaseConfig_update', component: TypePurchaseConfigUpdate },

        { path: '/brand', name: 'brands_list', component: BrandList },
        { path: '/brand/create', name: 'brand_create', component: BrandCreate },
        { path: '/brand/update/:id', name: 'brand_update', component: BrandUpdate },

        { path: '/model', name: 'models_list', component: ModelList },
        { path: '/model/update/:id', name: 'models_update', component: ModelList },

        { path: '/new-model', name: 'new_models_list', component: NewModelList },
        { path: '/new-model/create', name: 'new_model_create', component: NewModelCreate },
        { path: '/new-model/marketer_update/:id', name: 'new_model_marketer_update', component: ModelMarketerUpdate },

        { path: '/login', name: 'login', component: Login },
    ]
});

export default router;
