import './page/faq-list';
import './page/faq-detail';
import './page/faq-create';
import enGB from './snippet/en-GB';
import deDE from './snippet/de-DE';

const { Module } = Shopware;

Shopware.Module.register('faq-admin', {
	type: 'plugin',
	name: 'FAQ',
	title: 'faq.name',
	description: 'faq.nameFull',
	color: '#ff3d58',
	icon: 'regular-question-circle-s',

	snippets: {
		'de-DE': deDE,
		'en-GB': enGB
	},

	routes: {
		index: {
			component: 'faq-list',
			path: 'index'
		},
		detail: {
			component: 'faq-detail',
			path: 'detail/:id',
			meta: {
				parentPath: 'faq.admin.index'
			}
		},
		create: {
			component: 'faq-create',
			path: 'create',
			meta: {
				parentPath: 'faq.admin.index'
			}
		}
	},

	settingsItem: [{
		group: 'shop',
		to: 'faq.admin.index',
		icon: 'regular-question-circle-s',
	}],
	
	navigation: [{
		label: 'faq.nameFull',
		color: '#ff3d58',
		path: 'faq.admin.index',
		icon: 'regular-question-circle-s',
		parent: 'sw-catalogue',		
		position: 100
	}]
});