const { Component } = Shopware;

Component.extend('faq-create', 'faq-detail', {

	methods: {

		getFAQ(){
			this.faq = this.repository.create( Shopware.Context.api );
			this.criteria = new Shopware.Data.Criteria();
			this.criteria.addFilter(
				Shopware.Data.Criteria.not( 'AND',
					[Shopware.Data.Criteria.equals('product.active', null)]));
		},

		onClickSave(){
			this.isLoading = true;
			this.repository.save( this.faq, Shopware.Context.api ).then(() => {
				this.isLoading = false;
				this.$router.push({ name: 'faq.admin.detail', params: { id: this.faq.id }});
			}).catch(( exception ) => {
				this.isLoading = false;
				this.createNotificationError({
					title: this.$tc('faq.errorTitle'),
					message: exception
				});
			});
		}
	}
});