import './page/team-list';
import './page/team-detail';
import './page/team-create';
import enGB from './snippet/en-GB';
import deDE from './snippet/de-DE';

const { Module } = Shopware;

Shopware.Module.register('team-admin', {
	type: 'plugin',
	name: 'Team',
	title: 'team.name',
	description: 'team.nameFull',
	color: '#57d9a3',
	icon: 'solid-users',

	snippets: {
		'de-DE': deDE,
		'en-GB': enGB
	},

	routes: {
		index: {
			component: 'team-list',
			path: 'index'
		},
		detail: {
			component: 'team-detail',
			path: 'detail/:id',
			meta: {
				parentPath: 'team.admin.index'
			}
		},
		create: {
			component: 'team-create',
			path: 'create',
			meta: {
				parentPath: 'team.admin.index'
			}
		}
	},

	settingsItem: [{
		group: 'shop',
		to: 'team.admin.index',
		icon: 'solid-users',
	}],
	
	navigation: [{
		label: 'team.nameFull',
		color: '#57d9a3',
		path: 'team.admin.index',
		icon: 'solid-users',
		parent: 'sw-catalogue',		
		position: 100
	}]
});