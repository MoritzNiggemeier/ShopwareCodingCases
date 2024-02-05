import './component';
import './config';
import './preview';

const { Criteria } = Shopware.Data;

Shopware.Service('cmsService').registerCmsElement({
    name: 'team-cms-element',
    label: 'sw-cms.elements.team.elementLabel',
    component: 'sw-cms-el-team-cms-element',
    configComponent: 'sw-cms-el-config-team-cms-element',
    previewComponent: 'sw-cms-el-preview-team-cms-element',
    defaultConfig: {
        teamMembers: {
            source: 'static',
            value: [],
            required: true,
            entity: {
                name: 'team',
                criteria: new Criteria()
            }
        }
    }
});