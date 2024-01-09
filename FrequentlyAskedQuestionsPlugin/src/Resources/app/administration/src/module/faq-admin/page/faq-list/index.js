import template from './faq-list.html.twig';

const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('faq-list', {

	template,
	
	inject: [
		'repositoryFactory'
	],

	data(){
		return {
			repository: null,
			faq: null
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
			this.repository = this.repositoryFactory.create('faq');
			this.repository
				.search( new Criteria(), Shopware.Context.api )
				.then((result => { this.faq = result; }))
				.catch(( exception ) => {
					this.createNotificationError({
						title: this.$tc('faq.errorTitle'),
						message: exception
					});
				});
		},
		
		getColumns() {
			return [{
				property: 'question',
				dataIndex: 'question',
				label: this.$tc('faq.questionLabel'),
				routerLink: 'faq.admin.detail',
				inlineEdit: 'string',
				allowResize: true,
				primary: true
			}, {
				property: 'answer',
				dataIndex: 'answer',
				label: this.$tc('faq.answerLabel'),
				inlineEdit: 'string',
				allowResize: true,
			}];
		}
	},

});