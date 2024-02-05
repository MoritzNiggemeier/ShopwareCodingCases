import './component';
import './preview';

Shopware.Service('cmsService').registerCmsBlock({
    name: 'team-cms-block',
    label: 'sw-cms.elements.team.blockLabel',
    category: 'text-image',
    component: 'sw-cms-block-team-cms-block',
    previewComponent: 'sw-cms-preview-team-cms-block',
    defaultConfig: {
        marginBottom: '20px',
        marginTop: '20px',
        marginLeft: '20px',
        marginRight: '20px',
        sizingMode: 'boxed'
    },
    slots: {
        teamElement: 'team-cms-element'
    }
});