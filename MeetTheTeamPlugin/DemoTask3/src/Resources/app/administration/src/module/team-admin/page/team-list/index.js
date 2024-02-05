import template from './team-list.html.twig';

const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('team-list', {

	template,
	
	inject: [
		'repositoryFactory'
	],

	data(){
		return {
			repository: null,
			team: null
		};
	},

	metaInfo(){
		return {
			title: 'this.$createTitle()'
		};
	},

	computed: {
		columns() {
			return this.getColumns();
		}
	},

	created(){
		this.createdComponent();
	},

	methods: {
		createdComponent(){
			this.repository = this.repositoryFactory.create('team');
			this.repository
				.search( new Criteria(), Shopware.Context.api )
				.then((result => { this.team = result; }));
		},
		
		getColumns() {
			return [{
				property: 'name',
				dataIndex: 'name',
				label: this.$tc('team.nameLabel'),
				routerLink: 'team.admin.detail',
				inlineEdit: 'string',
				allowResize: true,
				primary: true
			}, {
				property: 'position',
				dataIndex: 'position',
				label: this.$tc('team.positionLabel'),
				routerLink: 'team.admin.detail',
				inlineEdit: 'string',
				allowResize: true,
			}];
		}
	}

});