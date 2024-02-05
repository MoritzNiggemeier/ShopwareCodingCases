import template from './team-detail.html.twig';

const { Component, Mixin } = Shopware;

Component.register('team-detail', {

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
			team: null,
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
			this.repository = this.repositoryFactory.create('team');
			this.getTeam();
		},

		getTeam(){
			this.criteria = new Shopware.Data.Criteria();
			this.repository.get( this.$route.params.id, Shopware.Context.api )
			.then((entity) => { this.team = entity })
			.catch(( exception ) => {
				this.createNotificationError({
					title: this.$tc('team.errorTitle'),
					message: exception
				});
			});
		},

		onClickSave(){
			this.isLoading = true;
			this.repository.save( this.team, Shopware.Context.api ).then(() => {
				this.getTeam();
				this.isLoading = false;
				this.processSuccess = true;
			}).catch(( exception ) => {
				this.isLoading = false;
				this.createNotificationError({
					title: this.$tc('team.errorTitle'),
					message: exception
				});
			});
		},

		onDropMedia(dragData, type) {
			this.setMediaItem({ targetId: dragData.id }, type);
		},

		onUnlinkMedia(type) {
			this.team[`${type}_id`] = null;
		},

		mediaUploadTag(type) {
			return `team-${type}--${this.team.id}`;
		},

		setMediaItem(event, type) {
			this.team[`${type}_id`] = event.targetId;
		},

		openMediaSidebar() {
			this.$refs.mediaSidebarItem.openContent();
		},

		setMediaFromSidebar(media) {
			this.team.image_id = media.id;
		},

		updateTeamText(value) {
			this.team.text = value;
		},

		saveFinish(){
			this.processSuccess = false;
		}

	}
});