import template from './sw-cms-el-team.html.twig';
import './sw-cms-el-team.scss';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('sw-cms-el-team-cms-element', {
    template,

    mixins: [
        Mixin.getByName('cms-element'),
    ],

    inject: [
        'repositoryFactory'
    ],

    data() {
        return {};
    },

    created() {
        this.initElementConfig('team-cms-element');
        this.getTeamData();
    },

    computed: {
        teamMemberRepo() {
            return this.repositoryFactory.create('team');
        },

        teamMemberCriteria() {
            return new Criteria();
        }
    },

    methods: {
        async getTeamData() {
            if( !this.element.config.teamMembers.value.length ){ return; }

            const teamMemberIds = this.element.config.teamMembers.value.map(member => member.id);

            const criteria = this.teamMemberCriteria;
            criteria.addFilter( Criteria.equalsAny( 'id', teamMemberIds ));
            criteria.limit = this.element.config.teamMembers.value.length;

            const results = await this.teamMemberRepo.search(criteria, Shopware.Context.api);

            const existing = this.element.config.teamMembers.value
                .filter(member => ! results.some(result => result.id === member.id))
                .map(deletedMember => deletedMember.id);

            this.element.config.teamMembers.value = this.element.config.teamMembers.value
                .map((member, index) => {
                    const entry = results.find(result => result.id === member.id);
                    if (entry) {
                        member.name = entry.name;
                        member.position = entry.position;
                        member.text = entry.text;
                        member.image = entry.image_id;
                        member.imageBG = entry.imageBG_id;
                    }
                    return member;
                })
                .filter(member => ! existing.includes(member.id));
        },
    }

});