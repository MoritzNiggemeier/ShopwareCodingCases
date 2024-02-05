const { Component } = Shopware;

Component.extend('team-create', 'team-detail', {

	methods: {

		getTeam(){
			this.team = this.repository.create( Shopware.Context.api );
		},

		onClickSave(){
			this.isLoading = true;
			this.repository.save( this.team, Shopware.Context.api ).then(() => {
				this.isLoading = false;
				this.$router.push({ name: 'team.admin.detail', params: { id: this.team.id }});
			}).catch(( exception ) => {
				this.isLoading = false;
				this.createNotificationError({
					title: this.$tc('team.errorTitle'),
					message: exception
				});
			});
		}
	}
});