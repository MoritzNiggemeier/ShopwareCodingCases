import template from './sw-cms-el-config-team.html.twig';

const { Component, Mixin } = Shopware;

Component.register('sw-cms-el-config-team-cms-element', {
    template,

    mixins: [
        Mixin.getByName('cms-element'),
    ],

    inject: ['repositoryFactory'],

    data() {
        return {
            teamMembers: [],
            teamMemberRepo: null,
            isLoading: true
        };
    },

    methods: {
        createdComponent() {
            this.initElementConfig('team-cms-element');
            this.loadTeamMembers();
        },

        loadTeamMembers() {
            if (this.element.config.teamMembers.value) {
                this.teamMembers = this.element.config.teamMembers.value;
                this.isLoading = false;
            }
        },

        columns() {
            return [
                {
                    property: 'name',
                    label: 'Name',
                    primary: true
                }
            ];
        },

        addMember(name, entity) {
            if (!this.teamMembers.some((teamMember) => teamMember.name === entity.name)) {
                this.teamMembers.push({
                    id: entity.id,
                    name: entity.name,
                });
            
                this.updateElementConfig();
            }
        },
        
        removeMember(id) {
            this.teamMembers = this.teamMembers.filter((m) => m.id !== id);
            this.updateElementConfig();
        },

        updateElementConfig() {
            this.element.config.teamMembers.value = this.teamMembers;
            this.$emit('element-update', this.element);
        }
    },

    created() {
        this.createdComponent();
    }

});