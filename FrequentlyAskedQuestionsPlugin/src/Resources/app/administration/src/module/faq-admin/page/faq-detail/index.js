import template from './faq-detail.html.twig';

const { Component, Mixin } = Shopware;

Component.register('faq-detail', {

	template,
	
	inject: [
		'repositoryFactory'
	],

	mixins: [
		Mixin.getByName('notification')
	],

	metaInfo(){
		return {
			title: this.$createTitle()
		};
	},

	data(){
		return {
			faq: null,
			isLoading: false,
			processSuccess: false,
			repository: null,
			criteria: null
		};
	},

	created(){
		this.createdComponent();
	},

	computed: {
	},

	methods: {

		createdComponent(){
			this.repository = this.repositoryFactory.create('faq');
			this.getFAQ();
		},

		getFAQ(){
			this.criteria = new Shopware.Data.Criteria();
			this.criteria.addFilter(
				Shopware.Data.Criteria.not( 'AND',
					[Shopware.Data.Criteria.equals('product.active', null)]));
			this.repository.get( this.$route.params.id, Shopware.Context.api )
			.then((entity) => { this.faq = entity })
			.catch(( exception ) => {
				this.createNotificationError({
					title: this.$tc('faq.errorTitle'),
					message: exception
				});
			});
		},

		onClickSave(){
			this.isLoading = true;
			this.repository.save( this.faq, Shopware.Context.api ).then(() => {
				this.getFAQ();
				this.isLoading = false;
				this.processSuccess = true;
			}).catch(( exception ) => {
				this.isLoading = false;
				this.createNotificationError({
					title: this.$tc('faq.errorTitle'),
					message: exception
				});
			});
		},

		saveFinish(){
			this.processSuccess = false;
		}

	}
});